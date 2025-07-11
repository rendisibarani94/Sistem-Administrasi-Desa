<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

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
                    'Nomor Akta Kelahiran',
                    'Golongan Darah',
                    'Agama',
                    'Tanggal Keluar E-KTP',
                    'Negara Keturunan',
                    'Status Perkawinan',
                    'Pendidikan Terakhir',
                    'Pekerjaan',
                    'Kemampuan Baca Huruf',
                    'Keududukan Keluarga',
                    'Dusun',
                    'Alamat Asal Penduduk',
                    'Asal Suku Penduduk',
                    'Tanggal Penambahan Penduduk',
                    'Keterangan',
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
                    ->value('id_dusun');

                if (!$kkRecord) {
                    $this->importErrors[] = "KK number $kkNumber not found in database (sheet '$sheetName1' row " . ($rowIndex1 + 2) . ")";
                    continue;
                }

                if (!$dusunRecord) {
                    $this->importErrors[] = "KK number $dusunData not found in database (sheet '$sheetName1' row " . ($rowIndex1 + 2) . ")";
                    continue;
                }

                $insertDataPenduduk[] = [
                    'nik' => $rowData1['NIK'],
                    'nama_lengkap' => $rowData1['Nama Lengkap'],
                    'jenis_kelamin' => $rowData1['Jenis Kelamin'],
                    'alamat' => $rowData1['Alamat'],
                    'nama_ayah' => $rowData1['Nama Ayah'],
                    'nama_ibu' => $rowData1['Nama Ibu'],
                    'id_kartu_keluarga' => $kkRecord,
                    'tempat_lahir' => $rowData1['Tempat Lahir'],
                    'tanggal_lahir' => $formattedDateLahir,
                    'kewarganegaraan' => $rowData1['Kewarganegaraan'],
                    'nomor_akta_lahir' => $rowData1['Nomor Akta Kelahiran'],
                    'golongan_darah' => $rowData1['Golongan Darah'],
                    'agama' => $rowData1['Agama'],
                    'tanggal_keluar_ktp' => $formattedDateKTP,
                    'keturunan' => $rowData1['Negara Keturunan'],
                    'status_perkawinan' => $rowData1['Status Perkawinan'],
                    'pendidikan_terakhir' => $rowData1['Pendidikan Terakhir'],
                    'pekerjaan' => $rowData1['Pekerjaan'],
                    'baca_huruf' => $rowData1['Kemampuan Baca Huruf'],
                    'kedudukan_keluarga' => $rowData1['Keududukan Keluarga'],
                    'dusun' => $dusunRecord,
                    'asal_penduduk' => $rowData1['Alamat Asal Penduduk'],
                    'suku' => $rowData1['Asal Suku Penduduk'],
                    'tanggal_penambahan' => $formattedDateAdded,
                    'keterangan' => $rowData1['Keterangan'],
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
    // Load the template
    $templatePath = public_path('storage/excel/Template_Import_Data_Penduduk.xlsx');
    $spreadsheet = IOFactory::load($templatePath);

    // Get current dusun data from database
    $dusunNames = DB::table('dusun')->where('is_deleted', 0)->pluck('dusun')->toArray();

    // Process Dropdown Sheet (index 2)
    $dropdownSheet = $spreadsheet->getSheet(2);

    // Clear existing Dusun data (Column I, starting from row 2)
    $this->clearColumnData($dropdownSheet, 'I');

    // Update Dusun dropdown with current data
    $this->updateDusunDropdown($dropdownSheet, $dusunNames);

    // Update data validation in Penduduk sheet
    $this->updatePendudukValidation($spreadsheet, count($dusunNames));

    // Save modified template
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $tempFile = tempnam(sys_get_temp_dir(), 'template_') . '.xlsx';
    $writer->save($tempFile);

    // Download the file
    return response()->download($tempFile, 'Template_Import_Data_Penduduk.xlsx')->deleteFileAfterSend(true);
}

private function clearColumnData(Worksheet $sheet, string $column)
{
    $row = 2;
    while ($sheet->getCell($column . $row)->getValue() !== null) {
        $sheet->setCellValue($column . $row, null);
        $row++;
    }
}

private function updateDusunDropdown(Worksheet $sheet, array $dusunNames)
{
    // Add new Dusun data starting at row 2 (preserving header at row 1)
    foreach ($dusunNames as $index => $name) {
        $sheet->setCellValue('I' . ($index + 2), $name);
    }
}

private function updatePendudukValidation(\PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet, int $dusunCount)
{
    $pendudukSheet = $spreadsheet->getSheet(1);

    // Create data validation for column I (Dusun)
    $validation = new DataValidation();
    $validation->setType(DataValidation::TYPE_LIST);
    $validation->setErrorStyle(DataValidation::STYLE_STOP);
    $validation->setAllowBlank(false);
    $validation->setShowInputMessage(true);
    $validation->setShowErrorMessage(true);
    $validation->setShowDropDown(true);

    // Calculate range based on dusun count
    $endRow = $dusunCount > 0 ? (2 + $dusunCount - 1) : 2;
    $validation->setFormula1("Dropdown!I2:I$endRow");

    // Apply to column I (rows 2-1000)
    for ($row = 2; $row <= 1000; $row++) {
        $pendudukSheet->getCell('I' . $row)->setDataValidation(clone $validation);
    }
}

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.induk-penduduk.create-excel',
        );
    }
}
