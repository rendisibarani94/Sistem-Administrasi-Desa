<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }} - {{ $pengajuanSurat->nomor_surat ?? 'Draft' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif !important; }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            color: #000;
            background: #fff;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 15mm 20mm 20mm 25mm;
            background: white;
            position: relative;
        }

        /* ===== KOP SURAT ===== */
        .kop {
            padding-bottom: 6px;
            margin-bottom: 6px;
        }

        .kop-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .kop-logo-placeholder {
            width: 80px;
            height: 80px;
            border: 2px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            text-align: center;
            flex-shrink: 0;
        }

        .kop-text {
            flex: 1;
            text-align: center;
            line-height: 1.3;
        }

        .kop-text .instansi-atas {
            font-size: 11pt;
            font-weight: normal;
        }

        .kop-text .instansi-tengah {
            font-size: 11pt;
            font-weight: normal;
        }

        .kop-text .nama-desa {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text .alamat-desa {
            font-size: 8.5pt;
            font-weight: normal;
            color: #000;
        }

        .garis-kop {
            border: none;
            border-top: 3px solid #000;
            margin: 0;
        }

        .garis-kop-tipis {
            border: none;
            border-top: 1.5px solid #000;
            margin-top: 2px;
        }

        /* ===== JUDUL SURAT ===== */
        .judul-surat {
            text-align: center;
            margin: 18px 0 6px;
        }

        .judul-surat h2 {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nomor-surat {
            text-align: center;
            font-size: 12pt;
            margin-bottom: 14px;
        }

        /* ===== BODY ===== */
        .pembuka, .penutup {
            text-align: justify;
            text-indent: 40px;
            line-height: 1.6;
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 12pt;
        }

        p.isi-surat, .isi-surat p {
            text-align: left; /* Changed from justify to left to prevent spacing/colon misalignment */
            line-height: 1.6;
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 12pt;
            white-space: pre-wrap;
        }

        /* Prevent text-indent on aligned paragraphs inside the letter content */
        .isi-surat p.ql-align-center,
        .isi-surat p.ql-align-right {
            text-indent: 0 !important;
        }
        .isi-surat p.ql-align-justify {
            text-indent: 0 !important;
            text-align: justify !important;
        }

        /* List and Table formatting for custom content */
        .isi-surat ul, .isi-surat ol {
            margin-bottom: 12px;
            padding-left: 25px;
        }
        .isi-surat li p {
            text-indent: 0 !important;
            margin-bottom: 4px;
        }
        .isi-surat table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
        }
        .isi-surat table td, .isi-surat table th {
            padding: 4px 6px;
            vertical-align: top;
            font-size: 12pt;
            white-space: pre-wrap;
        }
        .isi-surat table p {
            text-indent: 0 !important;
            margin-bottom: 0 !important;
            white-space: normal !important;
        }

        /* Quill Editor Formatting Support */
        .ql-align-center { text-align: center !important; }
        .ql-align-right { text-align: right !important; }
        .ql-align-justify { text-align: justify !important; }
        .ql-indent-1 { padding-left: 30px !important; }
        .ql-indent-2 { padding-left: 60px !important; }
        .ql-indent-3 { padding-left: 90px !important; }
        .ql-indent-4 { padding-left: 120px !important; }
        .ql-indent-5 { padding-left: 150px !important; }
        .ql-indent-6 { padding-left: 180px !important; }
        .ql-indent-7 { padding-left: 210px !important; }
        .ql-indent-8 { padding-left: 240px !important; }

        .data-pemohon {
            margin: 12px 0 12px 40px;
        }

        .data-pemohon table {
            border-collapse: collapse;
            width: 100%;
        }

        .data-pemohon table td {
            padding: 4px 4px;
            vertical-align: top;
            font-size: 12pt;
            line-height: 1.5;
        }

        .data-pemohon table td:first-child {
            width: 150px;
            font-weight: normal;
        }

        .data-pemohon table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .data-pemohon table td:last-child {
            font-weight: normal;
            text-align: justify;
        }

        .isi-surat {
            margin: 12px 0;
        }

        /* ===== TANDA TANGAN ===== */
        .ttd-section {
            margin-top: 16px;
        }

        .ttd-box {
            text-align: center;
            min-width: 220px;
        }

        .ttd-info {
            text-align: left;
            margin-bottom: 8px;
        }

        .ttd-info p {
            line-height: 1.6;
            font-size: 12pt;
        }

        .ttd-ruang {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ttd-nama {
            font-weight: bold;
            font-size: 12pt;
            border-top: 1px solid #000;
            padding-top: 4px;
            display: inline-block;
            min-width: 180px;
        }

        .ttd-jabatan {
            font-size: 11pt;
            margin-top: 2px;
        }

        /* ===== PRINT CONTROLS (tidak ikut tercetak) ===== */
        .no-print {
            display: block;
            background: #1e40af;
            color: white;
            text-align: center;
            padding: 12px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .no-print button {
            background: white;
            color: #1e40af;
            border: none;
            padding: 8px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            margin: 0 8px;
        }

        .no-print button.btn-back {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.5);
        }

        .no-print button:hover { opacity: 0.85; }

        /* ===== PRINT STYLES ===== */
        @media print {
            @page {
                margin: 0;
            }
            .no-print { display: none !important; }
            body {
                background: white;
                margin: 0 !important;
                padding: 15mm 20mm 20mm 25mm !important;
            }
            .page {
                width: auto !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }
        }

        @media screen {
            body { background: #e5e7eb; padding-top: 60px; }
            .page {
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                margin: 20px auto;
            }
        }
    </style>
    @if(isset($isPdf) && $isPdf)
    <style>
        @page {
            margin: 0;
        }
        body {
            background: white !important;
            margin: 0 !important;
            padding: 15mm 20mm 20mm 25mm !important;
        }
        .page {
            width: auto !important;
            height: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
        }
        .no-print {
            display: none !important;
        }
    </style>
    @endif
    @if ($pengajuanSurat->status !== 'selesai')
    <style>
        @media print {
            body {
                display: none !important;
            }
        }
    </style>
    @endif
</head>
<body>

{{-- ===== TOMBOL PRINT (tidak ikut tercetak) ===== --}}
<div class="no-print" style="{{ $pengajuanSurat->status !== 'selesai' ? 'background: #005FA3;' : '' }}">
    @if ($pengajuanSurat->status === 'selesai')
        <span>Preview Surat — Siap Cetak</span>
        <button onclick="window.print()">Cetak Sekarang</button>
    @else
        <span>PRATINJAU SURAT PENGAJUAN</span>
    @endif
</div>

@php
    // ===== Base64 Images for PDF generation (prevents Artisan Serve deadlocks) =====
    $logoTobaBase64 = null;
    $logoDesaBase64 = null;
    $ttdBase64 = null;

    // ===== Settings Desa =====
    $settingsArr = DB::table('settings')->get()->pluck('value', 'key')->toArray();
    $namaDesa    = $settingsArr['nama_desa'] ?? 'Hutabulu Mejan';
    $logoPath    = $settingsArr['logo'] ?? null;

    if (isset($isPdf) && $isPdf) {
        // Encode Logo Toba (use PNG for DomPDF to preserve color and scaling)
        $tobaPath = public_path('images/logo_toba.png');
        if (file_exists($tobaPath)) {
            $logoTobaBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($tobaPath));
        }

        // Encode Logo Desa
        if ($logoPath) {
            $desaPath = file_exists(public_path($logoPath)) ? public_path($logoPath) : storage_path('app/public/' . $logoPath);
            if (file_exists($desaPath)) {
                $ext = pathinfo($desaPath, PATHINFO_EXTENSION);
                $mime = ($ext === 'svg') ? 'image/svg+xml' : 'image/' . $ext;
                $logoDesaBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($desaPath));
            }
        }
    }

    // ===== Parse data_form =====
    $df = $pengajuanSurat->data_form;
    if (is_string($df)) { $df = json_decode($df, true) ?? []; }
    if (!is_array($df)) { $df = []; }

    // ===== Eager-load relasi EAV & KK jika belum ter-load =====
    if (!$pengajuanSurat->relationLoaded('detailPengajuanSurat')) {
        $pengajuanSurat->load('detailPengajuanSurat.persyaratanSurat');
    }

    // Robust Lookup Pemohon: cari relasi penduduk, atau cari user pemohon lalu relasi penduduknya
    $pemohon = $pengajuanSurat->penduduk;
    $userPemohon = null;
    if (!$pemohon) {
        $userPemohon = \App\Models\User::where('id_penduduk', $pengajuanSurat->id_penduduk)
            ->orWhere('id', $pengajuanSurat->id_penduduk)
            ->first();
        if ($userPemohon) {
            $pemohon = $userPemohon->penduduk;
        }
    }

    // ===== Load Kartu Keluarga dari relasi Penduduk =====
    $kk = null;
    if ($pemohon) {
        if (!$pemohon->relationLoaded('kartuKeluarga')) {
            $pemohon->load('kartuKeluarga');
        }
        $kk = $pemohon->kartuKeluarga;
    }

    // ===== Helper: ambil nilai dari data_form (edited/form value), fallback ke penduduk profile =====
    $nama       = $df['nama'] ?? $df['nama_lengkap'] ?? $pemohon?->nama_lengkap ?? $userPemohon?->name ?? '-';
    $nik        = $df['nik'] ?? $pemohon?->nik           ?? $userPemohon?->nik ?? '-';
    // Ambil No KK dari relasi Kartu Keluarga (bukan kolom penduduk)
    $noKk       = $df['no_kk'] ?? $df['nomor_kk'] ?? $kk?->nomor_kartu_keluarga ?? '-';
    $jk         = $df['jk'] ?? $df['jenis_kelamin'] ?? $pemohon?->jenis_kelamin ?? '-';
    $pekerjaan  = $df['pekerjaan'] ?? $pemohon?->pekerjaan ?? '-';

    // Cari alamat spesifik yang diinput oleh masyarakat di form pengajuan (EAV atau data_form)
    $inputtedAlamat = null;
    if ($pengajuanSurat->relationLoaded('detailPengajuanSurat')) {
        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
            $fieldName = strtolower($detail->persyaratanSurat?->nama_field ?? '');
            if (str_contains($fieldName, 'alamat')) {
                $inputtedAlamat = $detail->value;
                break;
            }
        }
    }
    $alamat     = $inputtedAlamat ?? $df['alamat'] ?? $df['alamat_lengkap'] ?? $pemohon?->alamat ?? '-';
    $keperluan  = $df['keperluan'] ?? '-';
    $penghasilan= $df['penghasilan'] ?? '-';
    $namaAnak   = $df['nama_anak'] ?? '-';
    $ttlAnak    = $df['ttl_anak'] ?? '-';
    $namaUsaha  = $df['nama_usaha'] ?? $df['jenis_usaha'] ?? '-';

    // ===== Data Kependudukan Krusial dari profil Penduduk & KK =====
    // Cari tempat lahir spesifik yang diinput masyarakat (EAV)
    $inputtedTempatLahir = null;
    if ($pengajuanSurat->relationLoaded('detailPengajuanSurat')) {
        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
            $fieldName = strtolower($detail->persyaratanSurat?->nama_field ?? '');
            if (str_contains($fieldName, 'tempat lahir') || str_contains($fieldName, 'tmp lahir')) {
                if (!str_contains($fieldName, 'tanggal') && !str_contains($fieldName, 'tgl')) {
                    $inputtedTempatLahir = $detail->value;
                    break;
                }
            }
        }
    }
    $tempatLahir      = $inputtedTempatLahir ?? $df['tempat_lahir'] ?? $df['tmp_lahir'] ?? $pemohon?->tempat_lahir ?? '-';
    
    // Cari tanggal lahir dari data_form / detail pengajuan (EAV)
    $inputtedTanggalLahir = null;
    if ($pengajuanSurat->relationLoaded('detailPengajuanSurat')) {
        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
            $fieldName = strtolower($detail->persyaratanSurat?->nama_field ?? '');
            if ((str_contains($fieldName, 'tanggal lahir') || str_contains($fieldName, 'tgl lahir')) &&
                !str_contains($fieldName, 'tempat') &&
                !str_contains($fieldName, 'tmp')) {
                $inputtedTanggalLahir = $detail->value;
                break;
            }
        }
    }
    $tanggalLahirRaw  = $inputtedTanggalLahir ?? $df['tanggal_lahir'] ?? $df['tgl_lahir'] ?? $pemohon?->tanggal_lahir ?? null;
    
    $namaAyah         = $df['nama_ayah'] ?? $pemohon?->nama_ayah ?? '-';
    $namaIbu          = $df['nama_ibu'] ?? $pemohon?->nama_ibu ?? '-';
    $agama            = $df['agama'] ?? $pemohon?->agama ?? '-';
    $statusPerkawinan = $df['status_perkawinan'] ?? $pemohon?->status_perkawinan ?? '-';
    $pendidikan       = $df['pendidikan'] ?? $df['pendidikan_terakhir'] ?? $pemohon?->pendidikan_terakhir ?? '-';
    $kewarganegaraan  = $df['kewarganegaraan'] ?? $pemohon?->kewarganegaraan ?? 'WNI';
    $golDarah         = $df['golongan_darah'] ?? $df['gol_darah'] ?? $pemohon?->golongan_darah ?? '-';
    $suku             = $df['suku'] ?? $pemohon?->suku ?? '-';
    $rtKk             = $df['rt'] ?? $kk?->rt ?? '-';
    $rwKk             = $df['rw'] ?? $kk?->rw ?? '-';

    // ===== Helper: Format Tempat/Tanggal Lahir =====
    $bulanId = [
        1  => 'Januari',  2  => 'Februari', 3  => 'Maret',
        4  => 'April',    5  => 'Mei',       6  => 'Juni',
        7  => 'Juli',     8  => 'Agustus',   9  => 'September',
        10 => 'Oktober',  11 => 'November',  12 => 'Desember',
    ];

    // Helper function: format tanggal YYYY-MM-DD ke format Indonesia
    $formatTanggalIndonesia = function($dateValue) use ($bulanId) {
        if (!$dateValue) return '-';
        try {
            $dt = \Carbon\Carbon::parse($dateValue);
            return $dt->day . ' ' . $bulanId[$dt->month] . ' ' . $dt->year;
        } catch (\Exception $e) {
            return (string) $dateValue; // Kembalikan apa adanya jika gagal parse
        }
    };

    // Cari apakah ada field TTL gabungan yang diinput masyarakat (EAV atau data_form)
    $inputtedTtl = null;
    if ($pengajuanSurat->relationLoaded('detailPengajuanSurat')) {
        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
            $fieldName = strtolower($detail->persyaratanSurat?->nama_field ?? '');
            if ($fieldName === 'ttl' ||
                $fieldName === 'tmpttl' ||
                (str_contains($fieldName, 'tempat') && (str_contains($fieldName, 'tanggal') || str_contains($fieldName, 'tgl'))) ||
                str_contains($fieldName, 'tempat, tgl') ||
                str_contains($fieldName, 'tempat/tgl')) {
                $inputtedTtl = $detail->value;
                break;
            }
        }
    }

    if (!$inputtedTtl) {
        foreach ($df as $k => $v) {
            $kLower = strtolower($k);
            if ($kLower === 'ttl' ||
                $kLower === 'tmpttl' ||
                (str_contains($kLower, 'tempat') && (str_contains($kLower, 'tanggal') || str_contains($kLower, 'tgl'))) ||
                str_contains($kLower, 'tempat_tgl') ||
                str_contains($kLower, 'tempat/tgl')) {
                $inputtedTtl = $v;
                break;
            }
        }
    }

    $tanggalLahirFormatted = $tanggalLahirRaw ? $formatTanggalIndonesia($tanggalLahirRaw) : '-';
    
    if ($inputtedTtl) {
        $ttl = $inputtedTtl;
    } else {
        $ttl = $tempatLahir . ($tanggalLahirFormatted !== '-' ? ', ' . $tanggalLahirFormatted : '');
    }
    if ($ttl === '-' || $ttl === '-, -' || $ttl === '-,') {
        $ttl = $df['ttl'] ?? $df['tempat_lahir'] ?? '-';
    }

    // Logo Desa URL (for web view)
    if ($logoPath) {
        if (file_exists(public_path($logoPath))) {
            $logoUrl = asset($logoPath);
        } else {
            $logoUrl = asset('storage/' . $logoPath);
        }
    } else {
        $logoUrl = null;
    }

    // Info kop surat (bisa disesuaikan)
    $kabupaten   = 'KABUPATEN TOBA';
    $kecamatan   = 'KECAMATAN BALIGE';
    $alamatDesa  = 'Jl. Hutabulu Mejan';
    $emailDesa   = 'hutabulumejan01@gmail.com';
    $websiteDesa = '';

    // ===== Tanggal Cetak =====
    $tanggalCetak = $pengajuanSurat->tanggal_selesai ?? now();
    $tgl = \Carbon\Carbon::parse($tanggalCetak);
    $tanggalFormatted = $tgl->day . ' ' . $bulanId[$tgl->month] . ' ' . $tgl->year;

    // ===== Jenis Surat =====
    $namaJenisSurat = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';
    $nomorSurat     = $pengajuanSurat->nomor_surat ?? '...... / ........';

    // ===== Penandatangan =====
    $namaKepalaDesa = null;
    $nipKepalaDesa = null;
    $fileTtdKepalaDesa = null;
    try {
        // Gunakan kepala desa yang memproses surat ini
        $kepalaDesa = $pengajuanSurat->diprosesOleh;
        
        // Jika belum diproses/tidak ada, gunakan kepala desa aktif
        if (!$kepalaDesa) {
            $kepalaDesa = \App\Models\KepalaDesa::where('is_active', true)->first();
        }
        
        if ($kepalaDesa) {
            $namaKepalaDesa = $kepalaDesa->nama;
            $nipKepalaDesa = $kepalaDesa->nip;
            $fileTtdKepalaDesa = $kepalaDesa->file_ttd;
            
            if (isset($isPdf) && $isPdf && $fileTtdKepalaDesa) {
                $ttdPath = storage_path('app/public/' . $fileTtdKepalaDesa);
                if (file_exists($ttdPath)) {
                    $ext = pathinfo($ttdPath, PATHINFO_EXTENSION);
                    $mime = ($ext === 'svg') ? 'image/svg+xml' : 'image/' . $ext;
                    $ttdBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($ttdPath));
                }
            }
        }
    } catch (\Throwable $e) {}

    // Fallback: cek settings
    if (!$namaKepalaDesa) {
        $namaKepalaDesa = $settingsArr['kepala_desa_nama'] ?? null;
    }

    // Fallback akhir: nama admin yang approve
    $penandatangan  = $namaKepalaDesa ?? ($pengajuanSurat->diprosesOleh->name ?? 'Kepala Desa ' . $namaDesa);
    $jabatanTtd     = 'Kepala Desa ' . $namaDesa;

    // ===== Custom Template Parser =====
    $bodyTemplate = $pengajuanSurat->jenisSurat->body_template ?? null;
    $renderedContent = null;
    if ($bodyTemplate && trim(strip_tags($bodyTemplate)) !== '') {
        // ── A. Placeholder Statis dari Profil Penduduk & KK ──
        $placeholders = [
            // Data Utama Penduduk
            '{nama}'              => '<strong>' . strtoupper($nama) . '</strong>',
            '{nama_lengkap}'      => '<strong>' . strtoupper($nama) . '</strong>',
            '{nama lengkap}'      => '<strong>' . strtoupper($nama) . '</strong>',
            '{Nama Lengkap}'      => '<strong>' . strtoupper($nama) . '</strong>',
            '{nik}'               => $nik,
            '{NIK}'               => $nik,
            '{no_kk}'             => $noKk,
            '{nomor_kk}'          => $noKk,
            '{nomor kk}'          => $noKk,
            '{Nomor KK}'          => $noKk,
            '{ttl}'               => $ttl,
            '{TTL}'               => $ttl,
            '{tempat/tgl_lahir}'  => $ttl,
            '{tempat/tgl lahir}'  => $ttl,
            '{Tempat/Tgl Lahir}'  => $ttl,
            '{tempat/tanggal_lahir}' => $ttl,
            '{tempat}'            => ucfirst($tempatLahir),
            '{tempat_lahir}'      => ucfirst($tempatLahir),
            '{tempat lahir}'      => ucfirst($tempatLahir),
            '{Tempat Lahir}'      => ucfirst($tempatLahir),
            '{tanggal_lahir}'     => $tanggalLahirFormatted,
            '{tanggal lahir}'     => $tanggalLahirFormatted,
            '{Tanggal Lahir}'     => $tanggalLahirFormatted,
            '{tgl_lahir}'         => $tanggalLahirFormatted,
            '{jenis_kelamin}'     => strtoupper($jk),
            '{jenis kelamin}'     => strtoupper($jk),
            '{Jenis Kelamin}'     => strtoupper($jk),
            '{jk}'                => strtoupper($jk),
            '{JK}'                => strtoupper($jk),
            '{pekerjaan}'         => strtoupper($pekerjaan),
            '{Pekerjaan}'         => strtoupper($pekerjaan),
            '{alamat}'            => ucfirst($alamat),
            '{Alamat}'            => ucfirst($alamat),

            // Data Kependudukan Krusial
            '{nama_ayah}'         => strtoupper($namaAyah),
            '{nama ayah}'         => strtoupper($namaAyah),
            '{Nama Ayah}'         => strtoupper($namaAyah),
            '{nama_ibu}'          => '<strong>' . strtoupper($namaIbu) . '</strong>',
            '{nama ibu}'          => '<strong>' . strtoupper($namaIbu) . '</strong>',
            '{Nama Ibu}'          => '<strong>' . strtoupper($namaIbu) . '</strong>',
            '{agama}'             => ucfirst($agama),
            '{Agama}'             => ucfirst($agama),
            '{status_perkawinan}' => ucfirst($statusPerkawinan),
            '{status perkawinan}' => ucfirst($statusPerkawinan),
            '{Status Perkawinan}' => ucfirst($statusPerkawinan),
            '{pendidikan}'        => ucfirst($pendidikan),
            '{Pendidikan}'        => ucfirst($pendidikan),
            '{kewarganegaraan}'   => strtoupper($kewarganegaraan),
            '{Kewarganegaraan}'   => strtoupper($kewarganegaraan),
            '{golongan_darah}'    => strtoupper($golDarah),
            '{golongan darah}'    => strtoupper($golDarah),
            '{Golongan Darah}'    => strtoupper($golDarah),
            '{gol_darah}'         => strtoupper($golDarah),
            '{gol darah}'         => strtoupper($golDarah),
            '{Gol Darah}'         => strtoupper($golDarah),
            '{suku}'              => ucfirst($suku),
            '{Suku}'              => ucfirst($suku),
            '{rt}'                => $rtKk,
            '{RT}'                => $rtKk,
            '{rw}'                => $rwKk,
            '{RW}'                => $rwKk,

            // Data Surat Umum
            '{keperluan}'         => $keperluan,
            '{nama_desa}'         => $namaDesa,
            '{kecamatan}'         => $kecamatan,
            '{kabupaten}'         => $kabupaten,
            '{tanggal_cetak}'     => $tanggalFormatted,
            '{nomor_surat}'       => $nomorSurat,
            '{penghasilan}'       => $penghasilan != '-' ? '<strong>Rp. ' . number_format((int)$penghasilan, 0, ',', '.') . ',-</strong>' : '-',
            '{nama_usaha}'        => '<strong>' . strtoupper($namaUsaha) . '</strong>',
            '{nama_anak}'         => '<strong>' . strtoupper($namaAnak) . '</strong>',
            '{ttl_anak}'          => $ttlAnak,

            // Data Kepala Desa
            '{nip_kades}'         => $nipKepalaDesa,
            '{nip_kepala_desa}'   => $nipKepalaDesa,
            '{nama_kades}'        => $namaKepalaDesa,
            '{nama_kepala_desa}'  => $namaKepalaDesa,
        ];

        // ── B. Placeholder dari data_form (legacy/fallback) ──
        foreach ($df as $k => $v) {
            if (is_string($v) || is_numeric($v)) {
                $isFile = is_string($v) && (str_starts_with($v, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $v));
                if (!$isFile) {
                    $placeholders['{' . $k . '}'] = $v;
                }
            }
        }

        // ── C. DINAMIS: Placeholder dari EAV Detail Pengajuan Surat (Input Mobile) ──
        // Ini adalah bagian KRUSIAL: setiap field kustom yang dibuat admin
        // dan diisi oleh masyarakat di HP akan otomatis terisi di template PDF.
        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
            $fieldName = $detail->persyaratanSurat?->nama_field ?? null;
            $fieldType = $detail->persyaratanSurat?->tipe_field ?? 'text';
            $rawValue  = $detail->value;

            if (!$fieldName || is_null($rawValue)) continue;

            // Skip file/image fields (tidak bisa ditampilkan sebagai teks di surat)
            $isFile = is_string($rawValue) && (str_starts_with($rawValue, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $rawValue));
            if ($fieldType === 'file_image' || $isFile) continue;

            // Auto-format tanggal Indonesia jika tipe field = date
            $displayValue = $rawValue;
            if ($fieldType === 'date' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $rawValue)) {
                $displayValue = $formatTanggalIndonesia($rawValue);
            }

            // Petakan ke 3 variasi casing agar template admin selalu cocok:
            // 1. {Nama Field Asli} - persis seperti yang ditulis admin saat membuat persyaratan
            $placeholders['{' . $fieldName . '}'] = $displayValue;
            // 2. {nama field asli} - versi huruf kecil semua
            $placeholders['{' . strtolower($fieldName) . '}'] = $displayValue;
            // 3. {nama_field_asli} - versi snake_case
            $snakeKey = strtolower(str_replace(' ', '_', trim($fieldName)));
            $placeholders['{' . $snakeKey . '}'] = $displayValue;
        }

        // ── D. Render: ganti semua placeholder di template ──
        $renderedContent = str_replace(array_keys($placeholders), array_values($placeholders), $bodyTemplate);

        // ── E. Hapus baris/paragraf yang mengandung placeholder file/gambar (ktp, kk, upload, file, berkas) ──
        $renderedContent = preg_replace('/<p>[^<]*\{[^}]*(ktp|kk|upload|file|berkas)[^}]*\}[^<]*<\/p>/i', '', $renderedContent);
        $renderedContent = preg_replace('/[^<]*\{[^}]*(ktp|kk|upload|file|berkas)[^}]*\}[^<]*/i', '', $renderedContent);

        // ── F. Bersihkan placeholder lain yang tidak terisi (tag yang tidak cocok) dengan string kosong ──
        $renderedContent = preg_replace('/\{[^}]+\}/', '', $renderedContent);

        // ── G. Auto-align consecutive paragraphs containing ":" into a borderless table ──
        // Bersihkan whitespace/newline di antara tag agar preg_split tidak terganggu baris kosong
        $renderedContentClean = preg_replace('/>\s+</s', '><', $renderedContent);
        $paragraphs = preg_split('/(<p[^>]*>.*?<\/p>)/is', $renderedContentClean, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        
        $newContent = '';
        $tableRows = [];
        
        foreach ($paragraphs as $chunk) {
            if (preg_match('/^<p[^>]*>([^:]+?)(?:\s|&nbsp;)*:(?:\s|&nbsp;)*(.*?)<\/p>$/is', $chunk, $matches)) {
                $label = trim(str_replace('&nbsp;', '', strip_tags($matches[1])));
                $value = trim($matches[2]);
                
                if (strlen($label) > 0 && strlen($label) < 30 && $value !== '') {
                    $tableRows[] = [
                        'label' => $label,
                        'value' => $value
                    ];
                    continue;
                }
            }
            
            if (count($tableRows) > 0) {
                if (count($tableRows) >= 2) {
                    $newContent .= '<div class="data-pemohon" style="margin: 12px 0 12px 40px;"><table style="width: 100%; border-collapse: collapse; border: none;">';
                    foreach ($tableRows as $row) {
                        $newContent .= '<tr style="border: none;">';
                        $newContent .= '<td style="width: 180px; padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: left;">' . $row['label'] . '</td>';
                        $newContent .= '<td style="width: 20px; padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: center;">:</td>';
                        $newContent .= '<td style="padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: left; white-space: pre-wrap;">' . $row['value'] . '</td>';
                        $newContent .= '</tr>';
                    }
                    $newContent .= '</table></div>';
                } else {
                    foreach ($tableRows as $row) {
                        $newContent .= '<p>' . $row['label'] . ' &nbsp;: ' . $row['value'] . '</p>';
                    }
                }
                $tableRows = [];
            }
            
            $newContent .= $chunk;
        }
        
        if (count($tableRows) > 0) {
            if (count($tableRows) >= 2) {
                $newContent .= '<div class="data-pemohon" style="margin: 12px 0 12px 40px;"><table style="width: 100%; border-collapse: collapse; border: none;">';
                foreach ($tableRows as $row) {
                    $newContent .= '<tr style="border: none;">';
                    $newContent .= '<td style="width: 180px; padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: left;">' . $row['label'] . '</td>';
                    $newContent .= '<td style="width: 20px; padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: center;">:</td>';
                    $newContent .= '<td style="padding: 4px 0; border: none; font-size: 12pt; vertical-align: top; text-align: left; white-space: pre-wrap;">' . $row['value'] . '</td>';
                    $newContent .= '</tr>';
                }
                $newContent .= '</table></div>';
            } else {
                foreach ($tableRows as $row) {
                    $newContent .= '<p>' . $row['label'] . ' &nbsp;: ' . $row['value'] . '</p>';
                }
            }
        }
        
        $renderedContent = $newContent;

        // ── H. Ganti &nbsp; dengan spasi biasa agar DomPDF merender lebar spasi Arial secara konsisten dengan editor ──
        $renderedContent = str_replace('&nbsp;', ' ', $renderedContent);
    }
@endphp

<div class="page">

    {{-- ===== KOP SURAT ===== --}}
    <table class="kop" style="width: 100%; border-collapse: collapse; margin-bottom: 4px; border: none;">
        <tr style="border: none;">
            <td style="width: 100px; vertical-align: middle; padding: 0; border: none; text-align: left;">
                <img src="{{ $logoTobaBase64 ?? (isset($isPdf) && $isPdf ? public_path('images/logo_toba.png') : asset('images/logo_toba.png')) }}" alt="Logo Kab Toba" width="90" height="110" style="width: 90px; height: 110px; display: block; border: none;">
            </td>
            <td style="text-align: center; vertical-align: middle; padding: 0 10px; border: none; line-height: 1.3;">
                <div class="instansi-atas" style="font-family: Arial, sans-serif; font-size: 14pt; font-weight: normal; letter-spacing: 0.3px; text-transform: uppercase;">PEMERINTAH {{ $kabupaten }}</div>
                <div class="instansi-tengah" style="font-family: Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 0.3px; text-transform: uppercase;">{{ $kecamatan }}</div>
                <div class="nama-desa" style="font-family: Arial, sans-serif; font-size: 20pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px;">DESA {{ strtoupper($namaDesa) }}</div>
                <div class="alamat-desa" style="font-family: Arial, sans-serif; font-size: 11pt; margin-top: 4px; font-style: normal;">{{ $alamatDesa }}</div>
                <div class="alamat-desa" style="font-family: Arial, sans-serif; font-size: 11pt; font-style: normal;">e-mail : {{ $emailDesa ?? 'hutabulumejan01@gmail.com' }}</div>
            </td>
            <td style="width: 100px; vertical-align: middle; padding: 0; border: none; text-align: right;">
                <div style="width: 90px; height: 110px;"></div>
            </td>
        </tr>
    </table>
    <div style="border-top: 3.5px solid #000; border-bottom: 1.5px solid #000; height: 3.5px; margin: 8px 0 16px 0; padding: 0;"></div>

    {{-- ===== JUDUL SURAT ===== --}}
    <div class="judul-surat">
        <h2>{{ strtoupper($namaJenisSurat) }}</h2>
    </div>
    <div class="nomor-surat">
        Nomor : <u>&nbsp;&nbsp;{{ $nomorSurat }}&nbsp;&nbsp;</u>
    </div>
    @if ($renderedContent)
        <div class="isi-surat">
            {!! $renderedContent !!}
        </div>
    @else
        {{-- ===== PEMBUKA ===== --}}
        <p class="pembuka">
            Yang bertanda tangan dibawah ini, Kepala Desa {{ $namaDesa }},
            {{ $kecamatan }}, {{ $kabupaten }} menerangkan bahwa :
        </p>

        {{-- ===== DATA PEMOHON ===== --}}
        <div class="data-pemohon">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong>{{ strtoupper($nama) }}</strong></td>
                </tr>
                @if($noKk !== '-')
                <tr>
                    <td>No. KK</td>
                    <td>:</td>
                    <td>{{ $noKk }}</td>
                </tr>
                @endif
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $nik }}</td>
                </tr>
                <tr>
                    <td>Tempat/Tgl. Lahir</td>
                    <td>:</td>
                    <td>{{ $ttl }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ strtoupper($jk) }}</td>
                </tr>
                @if(in_array($namaJenisSurat, ['Surat Keterangan Tidak Mampu', 'Surat Keterangan Usaha']))
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ strtoupper($pekerjaan) }}</td>
                </tr>
                @endif
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ ucfirst($alamat) }}</td>
                </tr>
            </table>
        </div>

        {{-- ===== ISI SURAT (tergantung jenis) ===== --}}
        @switch($namaJenisSurat)

            @case('Surat Keterangan Domisili')
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili
                    di wilayah Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
                </p>
                <p class="isi-surat">
                    Surat Keterangan Domisili ini diberikan kepada yang bersangkutan untuk dipergunakan
                    sebagai {{ $keperluan !== '-' ? strtolower($keperluan) : 'keperluan yang dibutuhkan' }}.
                </p>
                @break

            @case('Surat Keterangan Tidak Mampu')
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar Penduduk Desa {{ $namaDesa }} dan nama
                    tersebut diatas merupakan keluarga <strong>Tidak Mampu</strong>.
                </p>
                @if($penghasilan !== '-')
                <p class="isi-surat">
                    Adapun penghasilan per bulan yang bersangkutan adalah kurang lebih
                    <strong>Rp. {{ number_format((int)$penghasilan, 0, ',', '.') }},-</strong>.
                </p>
                @endif
                <p class="isi-surat">
                    Surat Keterangan Tidak Mampu ini dibuat untuk dipergunakan sebagai
                    {{ $keperluan !== '-' ? strtolower($keperluan) : 'keperluan yang dibutuhkan' }}.
                </p>
                @break

            @case('Surat Keterangan Usaha')
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar merupakan masyarakat Desa {{ $namaDesa }} dan
                    benar-benar mempunyai usaha dengan jenis usaha
                    <strong>{{ strtoupper($namaUsaha) }}</strong> yang bertempat di
                    Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
                </p>
                <p class="isi-surat">
                    Surat Keterangan Usaha ini diberikan untuk keperluan
                    {{ $keperluan !== '-' ? strtolower($keperluan) : 'yang dibutuhkan' }}.
                </p>
                @break

            @case('Surat Pengantar')
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili
                    di Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
                </p>
                <p class="isi-surat">
                    Sehubungan dengan keperluan untuk <strong>{{ $keperluan }}</strong>,
                    maka dengan ini kami menerangkan bahwa yang bersangkutan adalah masyarakat kami dan
                    kami merekomendasikan untuk diproses lebih lanjut sesuai ketentuan yang berlaku.
                </p>
                @break

            @case('Surat Keterangan Kelahiran')
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili
                    di Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
                    Menerangkan bahwa telah lahir seorang anak :
                </p>
                <div class="data-pemohon" style="margin-left: 30px;">
                    <table>
                        <tr>
                            <td>Nama Anak</td>
                            <td>:</td>
                            <td><strong>{{ strtoupper($namaAnak) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tgl. Lahir</td>
                            <td>:</td>
                            <td>{{ $ttlAnak }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ strtoupper($df['jk_anak'] ?? $jk) }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td>:</td>
                            <td>{{ strtoupper($df['nama_ibu'] ?? $nama) }}</td>
                        </tr>
                    </table>
                </div>
                @break

            @default
                <p class="isi-surat">
                    Nama tersebut diatas adalah benar merupakan masyarakat / penduduk yang berdomisili
                    di wilayah Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
                </p>
                @if($keperluan !== '-')
                <p class="isi-surat">
                    Surat keterangan ini diberikan untuk keperluan
                    <strong>{{ strtolower($keperluan) }}</strong>.
                </p>
                @endif
        @endswitch

        {{-- ===== PENUTUP ===== --}}
        <p class="penutup">
            Demikianlah {{ $namaJenisSurat }} ini dibuat agar dapat dipergunakan sebagaimana mestinya.
        </p>
    @endif

    {{-- ===== TANDA TANGAN ===== --}}
    <table style="width: 100%; border-collapse: collapse; margin-top: 16px; border: none;">
        <tr style="border: none;">
            <td style="width: 60%; border: none;"></td>
            <td style="width: 40%; border: none; padding: 0; vertical-align: top;">
                <div class="ttd-box" style="text-align: left; min-width: 220px; float: right;">
                    <div class="ttd-info" style="text-align: left; margin-bottom: 8px;">
                        <p style="line-height: 1.6; font-size: 12pt;">Dikeluarkan di : Desa {{ $namaDesa }}</p>
                        <p style="line-height: 1.6; font-size: 12pt;">Pada Tanggal &nbsp;&nbsp;: {{ $tanggalFormatted }}</p>
                    </div>
                    <div style="width: 220px; text-align: center;">
                        <p style="margin-bottom: 4px; font-size: 12pt; line-height: 1.6;">{{ $jabatanTtd }},</p>
                        <div class="ttd-ruang" style="height: 70px; display: block; margin-bottom: 4px; text-align: center;">
                            @if($ttdBase64 || $fileTtdKepalaDesa)
                                <img src="{{ $ttdBase64 ?? (isset($isPdf) && $isPdf ? (file_exists(storage_path('app/public/' . $fileTtdKepalaDesa)) ? storage_path('app/public/' . $fileTtdKepalaDesa) : '') : asset('storage/' . $fileTtdKepalaDesa)) }}" alt="Tanda Tangan" style="max-height: 65px; max-width: 180px; object-fit: contain; display: inline-block;" />
                            @endif
                        </div>
                        <div>
                            <span class="ttd-nama" style="font-weight: bold; font-size: 12pt; border-top: 1px solid #000; padding-top: 4px; display: block; text-align: center;">{{ strtoupper($penandatangan) }}</span>
                        </div>
                        @if($nipKepalaDesa)
                        <div style="font-size: 11pt; text-align: center; margin-top: 2px; font-family: Arial, sans-serif;">
                            NIP. {{ $nipKepalaDesa }}
                        </div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>

</div>

<script>
    // Auto-print jika ada parameter ?print=1 di URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('print') === '1') {
        window.addEventListener('load', () => {
            setTimeout(() => window.print(), 300);
        });
    }
</script>

</body>
</html>
