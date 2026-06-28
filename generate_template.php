<?php

/**
 * Script untuk generate Template_Import_Data_Penduduk.xlsx
 * Jalankan: php generate_template.php
 */

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

// -------------------------------------------------------
// Helper: apply header style
// -------------------------------------------------------
function applyHeaderStyle($sheet, string $range): void
{
    $sheet->getStyle($range)->applyFromArray([
        'font' => [
            'bold'  => true,
            'color' => ['argb' => 'FFFFFFFF'],
            'size'  => 11,
        ],
        'fill' => [
            'fillType'   => Fill::FILL_SOLID,
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
                'color'       => ['argb' => 'FF93C5FD'],
            ],
        ],
    ]);
}

// -------------------------------------------------------
// Helper: auto-size columns
// -------------------------------------------------------
function autoSizeColumns($sheet, int $count): void
{
    for ($i = 0; $i < $count; $i++) {
        $col = getColumnLetter($i);
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    $sheet->getRowDimension(1)->setRowHeight(30);
}

// -------------------------------------------------------
// Helper: column letter (A, B, ..., Z, AA, AB, ...)
// -------------------------------------------------------
function getColumnLetter(int $index): string
{
    $letter = '';
    while ($index >= 0) {
        $letter = chr(65 + ($index % 26)) . $letter;
        $index  = (int)($index / 26) - 1;
    }
    return $letter;
}

// -------------------------------------------------------
// Helper: add dropdown validation
// -------------------------------------------------------
function addDropdownValidation($sheet, string $column, string $formula, int $startRow, int $endRow): void
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

// -------------------------------------------------------
// CREATE SPREADSHEET
// -------------------------------------------------------
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

// Header row
foreach ($kkHeaders as $colIndex => $header) {
    $col = chr(65 + $colIndex);
    $kkSheet->setCellValue($col . '1', $header);
}

// Example data row (guidance for user)
$kkExample = [
    '3301012345670001',
    '01/01/2024',
    'Jl. Contoh No. 1',
    '001',
    '001',
    'Desa Contoh',
    'Kecamatan Contoh',
    '12345',
    'Kabupaten Contoh',
    'Jawa Tengah',
];
foreach ($kkExample as $colIndex => $val) {
    $col = chr(65 + $colIndex);
    $kkSheet->setCellValue($col . '2', $val);
    $kkSheet->getStyle($col . '2')->applyFromArray([
        'font' => ['italic' => true, 'color' => ['argb' => 'FF6B7280']],
    ]);
}

applyHeaderStyle($kkSheet, 'A1:J1');
autoSizeColumns($kkSheet, count($kkHeaders));

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
    $col = getColumnLetter($colIndex);
    $pendudukSheet->setCellValue($col . '1', $header);
}

// Example data row
$pendudukExample = [
    '3301011234560001',
    'Budi Santoso',
    'Laki-laki',
    'Jl. Contoh No. 1',
    'Ahmad Santoso',
    'Siti Rahayu',
    '3301012345670001',
    'Purwokerto',
    '01/01/1990',
    'WNI',
    '1234567890',
    'O',
    'Islam',
    '01/01/2020',
    'Indonesia',
    'Kawin',
    'S1',
    'Pegawai Swasta',
    'Bisa',
    'Kepala Keluarga',
    'Dusun Contoh',
    'Jl. Asal No. 1',
    'Jawa',
    '01/01/2024',
    '',
];

foreach ($pendudukExample as $colIndex => $val) {
    $col = getColumnLetter($colIndex);
    $pendudukSheet->setCellValue($col . '2', $val);
    $pendudukSheet->getStyle($col . '2')->applyFromArray([
        'font' => ['italic' => true, 'color' => ['argb' => 'FF6B7280']],
    ]);
}

$lastCol = getColumnLetter(count($pendudukHeaders) - 1);
applyHeaderStyle($pendudukSheet, 'A1:' . $lastCol . '1');
autoSizeColumns($pendudukSheet, count($pendudukHeaders));

// =====================================================================
// SHEET 2: DROPDOWN (reference data)
// =====================================================================
$dropdownSheet = $spreadsheet->createSheet(2);
$dropdownSheet->setTitle('Dropdown');

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
applyHeaderStyle($dropdownSheet, 'A1:I1');

// Jenis Kelamin (A)
$jenisKelamin = ['Laki-laki', 'Perempuan'];
foreach ($jenisKelamin as $i => $val) {
    $dropdownSheet->setCellValue('A' . ($i + 2), $val);
}

// Kewarganegaraan (B)
$kewarganegaraan = ['WNI', 'WNA'];
foreach ($kewarganegaraan as $i => $val) {
    $dropdownSheet->setCellValue('B' . ($i + 2), $val);
}

// Golongan Darah (C) - hanya nilai yang ada di DB ENUM
$golDarah = ['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
foreach ($golDarah as $i => $val) {
    $dropdownSheet->setCellValue('C' . ($i + 2), $val);
}

// Agama (D)
$agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];
foreach ($agama as $i => $val) {
    $dropdownSheet->setCellValue('D' . ($i + 2), $val);
}

// Status Perkawinan (E)
$statusPerkawinan = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
foreach ($statusPerkawinan as $i => $val) {
    $dropdownSheet->setCellValue('E' . ($i + 2), $val);
}

// Pendidikan Terakhir (F)
$pendidikan = ['Tidak/Belum Sekolah', 'Tidak Tamat SD', 'Tamat SD', 'SLTP', 'SLTA', 'Diploma I/II', 'Diploma III', 'S1', 'S2', 'S3'];
foreach ($pendidikan as $i => $val) {
    $dropdownSheet->setCellValue('F' . ($i + 2), $val);
}

// Kedudukan Keluarga (G)
$kedudukanKeluarga = ['Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'];
foreach ($kedudukanKeluarga as $i => $val) {
    $dropdownSheet->setCellValue('G' . ($i + 2), $val);
}

// Kemampuan Baca Huruf (H)
$bacaHuruf = ['Bisa', 'Tidak Bisa'];
foreach ($bacaHuruf as $i => $val) {
    $dropdownSheet->setCellValue('H' . ($i + 2), $val);
}

// Dusun (I) - placeholder, will be filled dynamically by app
$dropdownSheet->setCellValue('I2', '(diisi otomatis oleh aplikasi)');
$dropdownSheet->getStyle('I2')->applyFromArray([
    'font' => ['italic' => true, 'color' => ['argb' => 'FF9CA3AF']],
]);

autoSizeColumns($dropdownSheet, 9);

// =====================================================================
// ADD DATA VALIDATIONS to Penduduk Sheet
// =====================================================================
addDropdownValidation($pendudukSheet, 'C', 'Dropdown!$A$2:$A$3', 2, 1000);    // Jenis Kelamin
addDropdownValidation($pendudukSheet, 'J', 'Dropdown!$B$2:$B$3', 2, 1000);    // Kewarganegaraan
addDropdownValidation($pendudukSheet, 'L', 'Dropdown!$C$2:$C$14', 2, 1000);   // Golongan Darah
addDropdownValidation($pendudukSheet, 'M', 'Dropdown!$D$2:$D$8', 2, 1000);    // Agama
addDropdownValidation($pendudukSheet, 'P', 'Dropdown!$E$2:$E$5', 2, 1000);    // Status Perkawinan
addDropdownValidation($pendudukSheet, 'Q', 'Dropdown!$F$2:$F$11', 2, 1000);   // Pendidikan Terakhir
addDropdownValidation($pendudukSheet, 'T', 'Dropdown!$G$2:$G$11', 2, 1000);   // Kedudukan Keluarga
addDropdownValidation($pendudukSheet, 'S', 'Dropdown!$H$2:$H$3', 2, 1000);    // Kemampuan Baca Huruf
addDropdownValidation($pendudukSheet, 'U', 'Dropdown!$I$2:$I$100', 2, 1000);  // Dusun

// =====================================================================
// SAVE FILE
// =====================================================================
$spreadsheet->setActiveSheetIndex(0);

$outputPath = __DIR__ . '/storage/excel/Template_Import_Data_Penduduk.xlsx';

// Ensure directory exists
if (!is_dir(dirname($outputPath))) {
    mkdir(dirname($outputPath), 0755, true);
}

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save($outputPath);

echo "✅ Template berhasil dibuat: $outputPath" . PHP_EOL;
