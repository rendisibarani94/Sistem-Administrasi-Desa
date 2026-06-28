<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class IndukPendudukCreateExcelController extends Component
{
    use WithFileUploads;

    public $file;
    public $importSuccess = false;
    public $importedCount = 0;
    public $importedKKCount = 0;
    public $importedPendudukCount = 0;
    public $importErrors  = [];
    private $tempFilePath;

    public function import()
    {
        // Manual validation
        if (!$this->file) {
            $this->addError('file', 'Please select a file to upload');
            return;
        }

        $allowedExtensions = ['xlsx', 'xls', 'csv'];
        $extension = $this->file->getClientOriginalExtension();

        if (!in_array(strtolower($extension), $allowedExtensions)) {
            $this->addError('file', 'Invalid file type. Allowed types: ' . implode(', ', $allowedExtensions));
            return;
        }

        if ($this->file->getSize() > 10240 * 1024) { // 10MB
            $this->addError('file', 'File size exceeds 10MB limit');
            return;
        }

        $this->importErrors = [];
        $path = $this->file->getRealPath();
        $this->tempFilePath = $path;

        try {
            $spreadsheet = IOFactory::load($path);
            $this->file = null;

            // Ensure there are at least 2 sheets
            $sheetCount = $spreadsheet->getSheetCount();
            if ($sheetCount < 2) {
                $this->addError('file', 'Excel file must contain at least 2 sheets');
                return;
            }

            // =================================================================
            // PROCESS SHEET 0: KARTU KELUARGA
            // =================================================================
            $sheet0 = $spreadsheet->getSheet(0);
            $sheetName0 = $sheet0->getTitle();
            $rows0 = $sheet0->toArray();
            $header0 = array_shift($rows0);
            $insertDataKK = [];

            foreach ($rows0 as $rowIndex0 => $row0) {
                if (empty(array_filter($row0))) continue;

                try {
                    $rowData0 = array_combine($header0, $row0);
                } catch (\Exception $e) {
                    $this->importErrors[] = "Header/column mismatch in sheet '$sheetName0' row " . ($rowIndex0 + 2);
                    continue;
                }

                // Validation for KK sheet
                $requiredFieldsKK = [
                    'Nomor Kartu Keluarga',
                    'Tanggal Keluar',
                    'Alamat',
                    'RT',
                    'RW',
                    'Desa_Kelurahan',
                    'Kecamatan',
                    'Kode Pos',
                    'Kabupaten_Kota',
                    'Provinsi'
                ];

                $missingFields = [];
                foreach ($requiredFieldsKK as $field) {
                    $value = $rowData0[$field] ?? null;
                    if (empty(trim($value ?? ''))) {
                        $missingFields[] = $field;
                    }
                }

                if (!empty($missingFields)) {
                    $this->importErrors[] = "Missing required fields (" . implode(', ', $missingFields) . ") in sheet '$sheetName0' row " . ($rowIndex0 + 2);
                    continue;
                }

                // Date handling for KK sheet
                $rawDate = $rowData0['Tanggal Keluar'] ?? '';
                $formattedDate = null;

                if (!empty($rawDate)) {
                    try {
                        // Handle Excel date values (numeric timestamps)
                        if (is_numeric($rawDate)) {
                            $formattedDate = Carbon::createFromTimestamp((int) (($rawDate - 25569) * 86400))->format('Y-m-d');
                        }
                        // Handle string dates
                        else {
                            $dateParts = explode('/', $rawDate);
                            if (count($dateParts) === 3) {
                                $day = (int)$dateParts[0];
                                $month = (int)$dateParts[1];
                                $year = (int)$dateParts[2];

                                if (checkdate($month, $day, $year)) {
                                    $formattedDate = Carbon::createFromFormat('d/m/Y', $rawDate)->format('Y-m-d');
                                } else {
                                    throw new \Exception("Invalid date: $rawDate");
                                }
                            } else {
                                throw new \Exception("Invalid date format");
                            }
                        }
                    } catch (\Exception $e) {
                        $this->importErrors[] = "Invalid date in sheet '$sheetName0' row " . ($rowIndex0 + 2) . ": $rawDate";
                        continue;
                    }
                }

                $insertDataKK[] = [
                    'nomor_kartu_keluarga' => $rowData0['Nomor Kartu Keluarga'],
                    'tanggal_keluar' => $formattedDate,
                    'alamat_kk' => $rowData0['Alamat'],
                    'rt' => $rowData0['RT'],
                    'rw' => $rowData0['RW'],
                    'desa_kelurahan' => $rowData0['Desa_Kelurahan'],
                    'kecamatan' => $rowData0['Kecamatan'],
                    'kode_pos' => $rowData0['Kode Pos'],
                    'kabupaten_kota' => $rowData0['Kabupaten_Kota'],
                    'provinsi' => $rowData0['Provinsi'],
                ];

                // Batch insert for KK
                if (count($insertDataKK) >= 100) {
                    DB::table('kartu_keluarga')->insert($insertDataKK);
                    $this->importedKKCount += count($insertDataKK);
                    $insertDataKK = [];
                }
            }

            // Insert remaining KK records
            if (!empty($insertDataKK)) {
                DB::table('kartu_keluarga')->insert($insertDataKK);
                $this->importedKKCount += count($insertDataKK);
            }

            // =================================================================
            // PROCESS SHEET 1: PENDUDUK
            // =================================================================
            $sheet1 = $spreadsheet->getSheet(1);
            $sheetName1 = $sheet1->getTitle();
            $rows1 = $sheet1->toArray();
            $header1 = array_shift($rows1);
            $insertDataPenduduk = [];

            foreach ($rows1 as $rowIndex1 => $row1) {
                if (empty(array_filter($row1))) continue;

                try {
                    $rowData1 = array_combine($header1, $row1);
                } catch (\Exception $e) {
                    $this->importErrors[] = "Header/column mismatch in sheet '$sheetName1' row " . ($rowIndex1 + 2);
                    continue;
                }

                // Validation for Penduduk sheet
                $requiredFieldsPenduduk = [
                    'NIK',
                    'Nama Lengkap',
                    'Jenis Kelamin',
                    'Alamat',
                    'Nama Ayah',
                    'Nama Ibu',
                    'Nomor Kartu Keluarga',
                    'Tempat Lahir',
                    'Tanggal Lahir',
                    'Kewarganegaraan',
                    'Golongan Darah',
                    'Agama',
                    'Tanggal Keluar E-KTP',
                    'Status Perkawinan',
                    'Pendidikan Terakhir',
                    'Pekerjaan',
                    'Kemampuan Baca Huruf',
                    'Kedudukan Keluarga',
                    'Dusun',
                    'Alamat Asal Penduduk',
                    'Tanggal Penambahan Penduduk',
                    // nullable: 'Nomor Akta Kelahiran', 'Negara Keturunan', 'Asal Suku Penduduk', 'Keterangan'
                ];

                $missingFields = [];
                foreach ($requiredFieldsPenduduk as $field) {
                    $value = $rowData1[$field] ?? null;
                    if (empty(trim($value ?? ''))) {
                        $missingFields[] = $field;
                    }
                }

                if (!empty($missingFields)) {
                    $this->importErrors[] = "Missing required fields (" . implode(', ', $missingFields) . ") in sheet '$sheetName1' row " . ($rowIndex1 + 2);
                    continue;
                }

                // Date handling for Penduduk sheet
                $rawDateLahir = $rowData1['Tanggal Lahir'] ?? '';
                $rawDateKTP = $rowData1['Tanggal Keluar E-KTP'] ?? '';
                $rawDateAdded = $rowData1['Tanggal Penambahan Penduduk'] ?? '';
                $formattedDateLahir = null;
                $formattedDateKTP = null;
                $formattedDateAdded = null;

                if (!empty($rawDateLahir)) {
                    try {
                        // Handle Excel date values
                        if (is_numeric($rawDateLahir)) {
                            $formattedDateLahir = Carbon::createFromTimestamp((int) (($rawDateLahir - 25569) * 86400))->format('Y-m-d');
                        }
                        // Handle string dates
                        else {
                            $dateParts = explode('/', $rawDateLahir);
                            if (count($dateParts) === 3) {
                                $day = (int)$dateParts[0];
                                $month = (int)$dateParts[1];
                                $year = (int)$dateParts[2];

                                if (checkdate($month, $day, $year)) {
                                    $formattedDateLahir = Carbon::createFromFormat('d/m/Y', $rawDateLahir)->format('Y-m-d');
                                } else {
                                    throw new \Exception("Invalid date: $rawDateLahir");
                                }
                            } else {
                                throw new \Exception("Invalid date format");
                            }
                        }
                    } catch (\Exception $e) {
                        $this->importErrors[] = "Invalid date in sheet '$sheetName1' row " . ($rowIndex1 + 2) . ": $rawDateLahir";
                        continue;
                    }
                }

                if (!empty($rawDateKTP)) {
                    try {
                        // Handle Excel date values
                        if (is_numeric($rawDateKTP)) {
                            $formattedDateKTP = Carbon::createFromTimestamp((int) (($rawDateKTP - 25569) * 86400))->format('Y-m-d');
                        }
                        // Handle string dates
                        else {
                            $dateParts = explode('/', $rawDateKTP);
                            if (count($dateParts) === 3) {
                                $day = (int)$dateParts[0];
                                $month = (int)$dateParts[1];
                                $year = (int)$dateParts[2];

                                if (checkdate($month, $day, $year)) {
                                    $formattedDateKTP = Carbon::createFromFormat('d/m/Y', $rawDateKTP)->format('Y-m-d');
                                } else {
                                    throw new \Exception("Invalid date: $rawDateKTP");
                                }
                            } else {
                                throw new \Exception("Invalid date format");
                            }
                        }
                    } catch (\Exception $e) {
                        $this->importErrors[] = "Invalid date in sheet '$sheetName1' row " . ($rowIndex1 + 2) . ": $rawDateKTP";
                        continue;
                    }
                }

                if (!empty($rawDateAdded)) {
                    try {
                        // Handle Excel date values
                        if (is_numeric($rawDateAdded)) {
                            $formattedDateAdded = Carbon::createFromTimestamp((int) (($rawDateAdded - 25569) * 86400))->format('Y-m-d');
                        }
                        // Handle string dates
                        else {
                            $dateParts = explode('/', $rawDateAdded);
                            if (count($dateParts) === 3) {
                                $day = (int)$dateParts[0];
                                $month = (int)$dateParts[1];
                                $year = (int)$dateParts[2];

                                if (checkdate($month, $day, $year)) {
                                    $formattedDateAdded = Carbon::createFromFormat('d/m/Y', $rawDateAdded)->format('Y-m-d');
                                } else {
                                    throw new \Exception("Invalid date: $rawDateAdded");
                                }
                            } else {
                                throw new \Exception("Invalid date format");
                            }
                        }
                    } catch (\Exception $e) {
                        $this->importErrors[] = "Invalid date in sheet '$sheetName1' row " . ($rowIndex1 + 2) . ": $rawDateAdded";
                        continue;
                    }
                }

                // Get KK ID
                $kkNumber = $rowData1['Nomor Kartu Keluarga'];
                $kkRecord = DB::table('kartu_keluarga')
                    ->where('nomor_kartu_keluarga', $kkNumber)
                    ->value('id_kartu_keluarga');

                $dusunData = $rowData1['Dusun'];
                $dusunRecord = DB::table('dusun')
                    ->where('dusun', $dusunData)
                    ->where('is_deleted', 0)
                    ->value('id_dusun');

                if (!$kkRecord) {
                    $this->importErrors[] = "Nomor KK '$kkNumber' tidak ditemukan di database (sheet '$sheetName1' baris " . ($rowIndex1 + 2) . ")";
                    continue;
                }

                if (!$dusunRecord) {
                    $this->importErrors[] = "Dusun '$dusunData' tidak ditemukan di database (sheet '$sheetName1' baris " . ($rowIndex1 + 2) . ")";
                    continue;
                }

                // -------------------------------------------------------
                // MAPPING: template label → database ENUM value
                // -------------------------------------------------------

                // Agama: template "Islam" → DB "ISLAM"
                $agamaMap = [
                    'Islam'    => 'ISLAM',
                    'Kristen'  => 'KRISTEN',
                    'Katolik'  => 'KHATOLIK',
                    'Hindu'    => 'HINDU',
                    'Buddha'   => 'BUDHA',
                    'Konghucu' => 'KHONGHUCU',
                    'Lainnya'  => 'KEPERCAYAAN KEPADA TUHAN YME LAINNYA',
                ];

                // Status Perkawinan: template "Kawin" → DB "Kawin Tercatat"
                $statusPerkawinanMap = [
                    'Belum Kawin' => 'Belum Kawin',
                    'Kawin'       => 'Kawin Tercatat',
                    'Cerai Hidup' => 'Cerai Hidup',
                    'Cerai Mati'  => 'Cerai Mati',
                ];

                // Pendidikan: template readable → DB ENUM
                $pendidikanMap = [
                    'Tidak/Belum Sekolah' => 'TIDAK PERNAH SEKOLAH',
                    'Tidak Tamat SD'      => 'TK/KELOMPOK BERMAIN',
                    'Tamat SD'            => 'SD/SEDERAJAT',
                    'SLTP'                => 'SLTP/SEDERAJAT',
                    'SLTA'                => 'SLTA/SEDERAJAT',
                    'Diploma I/II'        => 'D-1/SEDERAJAT',
                    'Diploma III'         => 'D-3/SEDERAJAT',
                    'S1'                  => 'S-1/SEDERAJAT',
                    'S2'                  => 'S-2/SEDERAJAT',
                    'S3'                  => 'S-3/SEDERAJAT',
                ];

                // Baca Huruf: template "Bisa"/"Tidak Bisa" → DB enum D/A/L/I
                // D=Dapat, A=Tidak Dapat (standard BPS code)
                $bacaHurufMap = [
                    'Bisa'       => 'D',
                    'Tidak Bisa' => 'A',
                ];

                // Kedudukan Keluarga: template → DB ENUM
                $kedudukanMap = [
                    'Kepala Keluarga' => 'KEPALA KELUARGA',
                    'Istri'           => 'ISTRI',
                    'Anak'            => 'ANAK',
                    'Menantu'         => 'FAMILI LAIN',
                    'Cucu'            => 'FAMILI LAIN',
                    'Orang Tua'       => 'FAMILI LAIN',
                    'Mertua'          => 'FAMILI LAIN',
                    'Famili Lain'     => 'FAMILI LAIN',
                    'Pembantu'        => 'FAMILI LAIN',
                    'Lainnya'         => 'FAMILI LAIN',
                ];

                // Golongan Darah: remove "Tidak Tahu" (not in DB ENUM)
                $golDarahRaw = $rowData1['Golongan Darah'] ?? '';
                $validGolDarah = ['A', 'A+', 'A-', 'B', 'B+', 'B-', 'AB', 'AB+', 'AB-', 'O', 'O+', 'O-'];
                if (!in_array($golDarahRaw, $validGolDarah)) {
                    // Default to 'O' if unknown (most common / neutral)
                    $golDarahRaw = 'O';
                }

                $agamaRaw        = $rowData1['Agama'] ?? '';
                $statusNikahRaw  = $rowData1['Status Perkawinan'] ?? '';
                $pendidikanRaw   = $rowData1['Pendidikan Terakhir'] ?? '';
                $bacaHurufRaw    = $rowData1['Kemampuan Baca Huruf'] ?? '';
                $kedudukanRaw    = $rowData1['Kedudukan Keluarga'] ?? '';

                $agamaMapped        = $agamaMap[$agamaRaw] ?? strtoupper($agamaRaw);
                $statusNikahMapped  = $statusPerkawinanMap[$statusNikahRaw] ?? $statusNikahRaw;
                $pendidikanMapped   = $pendidikanMap[$pendidikanRaw] ?? strtoupper($pendidikanRaw);
                $bacaHurufMapped    = $bacaHurufMap[$bacaHurufRaw] ?? 'D';
                $kedudukanMapped    = $kedudukanMap[$kedudukanRaw] ?? 'FAMILI LAIN';

                $insertDataPenduduk[] = [
                    'nik'                 => $rowData1['NIK'],
                    'nama_lengkap'        => $rowData1['Nama Lengkap'],
                    'jenis_kelamin'       => $rowData1['Jenis Kelamin'],
                    'alamat'              => $rowData1['Alamat'],
                    'nama_ayah'           => $rowData1['Nama Ayah'],
                    'nama_ibu'            => $rowData1['Nama Ibu'],
                    'id_kartu_keluarga'   => $kkRecord,
                    'tempat_lahir'        => $rowData1['Tempat Lahir'],
                    'tanggal_lahir'       => $formattedDateLahir,
                    'kewarganegaraan'     => $rowData1['Kewarganegaraan'],
                    'nomor_akta_lahir'    => $rowData1['Nomor Akta Kelahiran'] ?: null,
                    'golongan_darah'      => $golDarahRaw,
                    'agama'               => $agamaMapped,
                    'tanggal_keluar_ktp'  => $formattedDateKTP,
                    'keturunan'           => $rowData1['Negara Keturunan'] ?: null,
                    'status_perkawinan'   => $statusNikahMapped,
                    'pendidikan_terakhir' => $pendidikanMapped,
                    'pekerjaan'           => $rowData1['Pekerjaan'],
                    'baca_huruf'          => $bacaHurufMapped,
                    'kedudukan_keluarga'  => $kedudukanMapped,
                    'dusun'               => $dusunRecord,
                    'asal_penduduk'       => $rowData1['Alamat Asal Penduduk'],
                    'suku'                => $rowData1['Asal Suku Penduduk'] ?: null,
                    'tanggal_penambahan'  => $formattedDateAdded,
                    'keterangan'          => $rowData1['Keterangan'] ?: null,
                    'is_deleted'          => 0,
                    'is_mutated'          => 0,
                ];

                // Batch insert for Penduduk
                if (count($insertDataPenduduk) >= 100) {
                    DB::table('penduduk')->insert($insertDataPenduduk);
                    $this->importedPendudukCount += count($insertDataPenduduk);
                    $insertDataPenduduk = [];
                }
            }

            // Insert remaining Penduduk records
            if (!empty($insertDataPenduduk)) {
                DB::table('penduduk')->insert($insertDataPenduduk);
                $this->importedPendudukCount += count($insertDataPenduduk);
            }

            // Calculate total imported records
            $this->importedCount = $this->importedKKCount + $this->importedPendudukCount;
            $this->importSuccess = true;
        } catch (\Exception $e) {
            $this->addError('file', 'Import failed: ' . $e->getMessage());
        } finally {
            $this->cleanupTempFile($path);
        }
    }

    private function cleanupTempFile($path)
    {
        try {
            if (file_exists($path)) {
                unlink($path); // Delete the temporary file
            }
        } catch (\Exception $e) {
            // Log error but don't break the import flow
            logger()->error('Failed to clean up temp file: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        // Load the static template from storage
        $templatePath = storage_path('excel/Template_Import_Data_Penduduk.xlsx');

        if (!file_exists($templatePath)) {
            $this->addError('file', 'File template tidak ditemukan. Hubungi administrator.');
            return;
        }

        $spreadsheet = IOFactory::load($templatePath);

        // Get current dusun data from database
        $dusunNames = DB::table('dusun')->where('is_deleted', 0)->pluck('dusun')->toArray();

        // Update Dropdown sheet (index 2): column I = Dusun
        $dropdownSheet = $spreadsheet->getSheet(2);

        // Clear old Dusun values starting from row 2
        $row = 2;
        while ($dropdownSheet->getCell('I' . $row)->getValue() !== null && $row <= 200) {
            $dropdownSheet->setCellValue('I' . $row, null);
            $row++;
        }

        // Write current dusun
        foreach ($dusunNames as $i => $name) {
            $dropdownSheet->setCellValue('I' . ($i + 2), $name);
        }

        // Update Dusun data validation range in Penduduk sheet (column U)
        $dusunEndRow = max(2, count($dusunNames) + 1);
        $this->addDropdownValidation(
            $spreadsheet->getSheet(1),
            'U',
            "Dropdown!\$I\$2:\$I\${$dusunEndRow}",
            2,
            1000
        );

        $spreadsheet->setActiveSheetIndex(0);

        // Save to temp and stream as download
        $writer   = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $tempFile = tempnam(sys_get_temp_dir(), 'template_') . '.xlsx';
        $writer->save($tempFile);

        return response()->download($tempFile, 'Template_Import_Data_Penduduk.xlsx')->deleteFileAfterSend(true);
    }

    // ---------------------------------------------------------------
    // Kept for use by downloadTemplate()
    // ---------------------------------------------------------------
    private function addDropdownValidation2($sheet, string $column, string $formula, int $startRow, int $endRow): void
    {
        $validation = new DataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_STOP);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1($formula);

        for ($row = $startRow; $row <= $endRow; $row++) {
            $sheet->getCell($column . $row)->setDataValidation(clone $validation);
        }
    }

    // ---------------------------------------------------------------
    // Programmatic template builder (fallback / unused after template exists)
    // ---------------------------------------------------------------
    private function buildTemplateFromScratch(array $dusunNames): \PhpOffice\PhpSpreadsheet\Spreadsheet
    {
        $spreadsheet = new Spreadsheet();

        // =====================================================================
        // SHEET 0: KARTU KELUARGA
        // =====================================================================
        $kkSheet = $spreadsheet->getActiveSheet();
        $kkSheet->setTitle('Kartu Keluarga');

        $kkHeaders = [
            'Nomor Kartu Keluarga',
            'Tanggal Keluar',
            'Alamat',
            'RT',
            'RW',
            'Desa_Kelurahan',
            'Kecamatan',
            'Kode Pos',
            'Kabupaten_Kota',
            'Provinsi',
        ];

        foreach ($kkHeaders as $colIndex => $header) {
            $col = chr(65 + $colIndex);
            $kkSheet->setCellValue($col . '1', $header);
        }

        $this->applyHeaderStyle($kkSheet, 'A1:J1');
        $this->autoSizeColumns($kkSheet, count($kkHeaders));

        // =====================================================================
        // SHEET 1: PENDUDUK
        // =====================================================================
        $pendudukSheet = $spreadsheet->createSheet(1);
        $pendudukSheet->setTitle('Penduduk');

        $pendudukHeaders = [
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Alamat',
            'Nama Ayah',
            'Nama Ibu',
            'Nomor Kartu Keluarga',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Kewarganegaraan',
            'Nomor Akta Kelahiran',
            'Golongan Darah',
            'Agama',
            'Tanggal Keluar E-KTP',
            'Negara Keturunan',
            'Status Perkawinan',
            'Pendidikan Terakhir',
            'Pekerjaan',
            'Kemampuan Baca Huruf',
            'Kedudukan Keluarga',
            'Dusun',
            'Alamat Asal Penduduk',
            'Asal Suku Penduduk',
            'Tanggal Penambahan Penduduk',
            'Keterangan',
        ];

        foreach ($pendudukHeaders as $colIndex => $header) {
            $col = $this->getColumnLetter($colIndex);
            $pendudukSheet->setCellValue($col . '1', $header);
        }

        $lastCol = $this->getColumnLetter(count($pendudukHeaders) - 1);
        $this->applyHeaderStyle($pendudukSheet, 'A1:' . $lastCol . '1');
        $this->autoSizeColumns($pendudukSheet, count($pendudukHeaders));

        // =====================================================================
        // SHEET 2: DROPDOWN (reference data)
        // =====================================================================
        $dropdownSheet = $spreadsheet->createSheet(2);
        $dropdownSheet->setTitle('Dropdown');

        // Dropdown column headers
        $dropdownHeaders = [
            'A' => 'Jenis Kelamin',
            'B' => 'Kewarganegaraan',
            'C' => 'Golongan Darah',
            'D' => 'Agama',
            'E' => 'Status Perkawinan',
            'F' => 'Pendidikan Terakhir',
            'G' => 'Kedudukan Keluarga',
            'H' => 'Kemampuan Baca Huruf',
            'I' => 'Dusun',
        ];

        foreach ($dropdownHeaders as $col => $header) {
            $dropdownSheet->setCellValue($col . '1', $header);
        }
        $this->applyHeaderStyle($dropdownSheet, 'A1:I1');

        // Jenis Kelamin
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        foreach ($jenisKelamin as $i => $val) {
            $dropdownSheet->setCellValue('A' . ($i + 2), $val);
        }

        // Kewarganegaraan
        $kewarganegaraan = ['WNI', 'WNA'];
        foreach ($kewarganegaraan as $i => $val) {
            $dropdownSheet->setCellValue('B' . ($i + 2), $val);
        }

        // Golongan Darah
        $golDarah = ['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Tidak Tahu'];
        foreach ($golDarah as $i => $val) {
            $dropdownSheet->setCellValue('C' . ($i + 2), $val);
        }

        // Agama
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];
        foreach ($agama as $i => $val) {
            $dropdownSheet->setCellValue('D' . ($i + 2), $val);
        }

        // Status Perkawinan
        $statusPerkawinan = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        foreach ($statusPerkawinan as $i => $val) {
            $dropdownSheet->setCellValue('E' . ($i + 2), $val);
        }

        // Pendidikan Terakhir
        $pendidikan = ['Tidak/Belum Sekolah', 'Tidak Tamat SD', 'Tamat SD', 'SLTP', 'SLTA', 'Diploma I/II', 'Diploma III', 'S1', 'S2', 'S3'];
        foreach ($pendidikan as $i => $val) {
            $dropdownSheet->setCellValue('F' . ($i + 2), $val);
        }

        // Kedudukan Keluarga
        $kedudukanKeluarga = ['Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'];
        foreach ($kedudukanKeluarga as $i => $val) {
            $dropdownSheet->setCellValue('G' . ($i + 2), $val);
        }

        // Kemampuan Baca Huruf
        $bacaHuruf = ['Bisa', 'Tidak Bisa'];
        foreach ($bacaHuruf as $i => $val) {
            $dropdownSheet->setCellValue('H' . ($i + 2), $val);
        }

        // Dusun (from database)
        foreach ($dusunNames as $i => $name) {
            $dropdownSheet->setCellValue('I' . ($i + 2), $name);
        }

        $this->autoSizeColumns($dropdownSheet, 9);

        // =====================================================================
        // ADD DATA VALIDATIONS to Penduduk Sheet
        // =====================================================================
        $this->addDropdownValidation($pendudukSheet, 'C', 'Dropdown!$A$2:$A$3', 2, 1000);    // Jenis Kelamin
        $this->addDropdownValidation($pendudukSheet, 'J', 'Dropdown!$B$2:$B$3', 2, 1000);    // Kewarganegaraan
        $this->addDropdownValidation($pendudukSheet, 'L', 'Dropdown!$C$2:$C$14', 2, 1000);   // Golongan Darah
        $this->addDropdownValidation($pendudukSheet, 'M', 'Dropdown!$D$2:$D$8', 2, 1000);    // Agama
        $this->addDropdownValidation($pendudukSheet, 'P', 'Dropdown!$E$2:$E$5', 2, 1000);    // Status Perkawinan
        $this->addDropdownValidation($pendudukSheet, 'Q', 'Dropdown!$F$2:$F$11', 2, 1000);   // Pendidikan Terakhir
        $this->addDropdownValidation($pendudukSheet, 'T', 'Dropdown!$G$2:$G$11', 2, 1000);   // Kedudukan Keluarga
        $this->addDropdownValidation($pendudukSheet, 'S', 'Dropdown!$H$2:$H$3', 2, 1000);    // Kemampuan Baca Huruf

        // Dusun validation (column U = index 20)
        $dusunEndRow = max(2, count($dusunNames) + 1);
        $this->addDropdownValidation($pendudukSheet, 'U', "Dropdown!\$I\$2:\$I\${$dusunEndRow}", 2, 1000);

        // Activate the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }

    private function applyHeaderStyle(Worksheet $sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF1D4ED8'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF93C5FD'],
                ],
            ],
        ]);
    }

    private function autoSizeColumns(Worksheet $sheet, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $col = $this->getColumnLetter($i);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getRowDimension(1)->setRowHeight(25);
    }

    private function addDropdownValidation(Worksheet $sheet, string $column, string $formula, int $startRow, int $endRow): void
    {
        $validation = new DataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_STOP);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1($formula);

        for ($row = $startRow; $row <= $endRow; $row++) {
            $sheet->getCell($column . $row)->setDataValidation(clone $validation);
        }
    }

    private function getColumnLetter(int $index): string
    {
        $letter = '';
        while ($index >= 0) {
            $letter = chr(65 + ($index % 26)) . $letter;
            $index  = (int)($index / 26) - 1;
        }
        return $letter;
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.induk-penduduk.create-excel',
        );
    }
}
