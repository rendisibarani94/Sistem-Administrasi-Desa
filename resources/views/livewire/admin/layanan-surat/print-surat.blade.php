<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }} - {{ $pengajuanSurat->nomor_surat ?? 'Draft' }}</title>
    <style>
        /* ===== RESET & BASE ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: "Times New Roman", Times, serif;
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
            display: flex;
            align-items: center;
            gap: 12px;
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
        .pembuka {
            text-align: justify;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .data-pemohon {
            margin: 10px 0 10px 10px;
        }

        .data-pemohon table {
            border-collapse: collapse;
            width: 100%;
        }

        .data-pemohon table td {
            padding: 2px 4px;
            vertical-align: top;
            font-size: 12pt;
        }

        .data-pemohon table td:first-child {
            width: 160px;
            font-weight: normal;
        }

        .data-pemohon table td:nth-child(2) {
            width: 10px;
            text-align: center;
        }

        .data-pemohon table td:last-child {
            font-weight: normal;
        }

        .isi-surat {
            text-align: justify;
            margin: 10px 0;
            line-height: 1.6;
        }

        .penutup {
            text-align: justify;
            margin: 10px 0;
            line-height: 1.6;
        }

        /* ===== TANDA TANGAN ===== */
        .ttd-section {
            margin-top: 16px;
            display: flex;
            justify-content: flex-end;
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
            .no-print { display: none !important; }
            body { background: white; }
            .page {
                width: 210mm;
                margin: 0;
                padding: 15mm 20mm 20mm 25mm;
                box-shadow: none;
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
</head>
<body>

{{-- ===== TOMBOL PRINT (tidak ikut tercetak) ===== --}}
<div class="no-print">
    <button class="btn-back" onclick="window.history.back()">← Kembali</button>
    <span>📄 Preview Surat — Siap Cetak</span>
    <button onclick="window.print()">🖨️ Cetak Sekarang</button>
</div>

@php
    // ===== Parse data_form =====
    $df = $pengajuanSurat->data_form;
    if (is_string($df)) { $df = json_decode($df, true) ?? []; }
    if (!is_array($df)) { $df = []; }

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

    // ===== Helper: ambil nilai dari data_form, fallback ke penduduk =====
    $nama       = $pemohon?->nama_lengkap ?? $userPemohon?->name ?? $df['nama'] ?? $df['nama_lengkap'] ?? '-';
    $nik        = $pemohon?->nik           ?? $userPemohon?->nik ?? $df['nik']  ?? '-';
    $noKk       = $df['no_kk'] ?? $df['nomor_kk'] ?? ($pemohon?->no_kk ?? '-');
    $ttl        = $df['ttl']   ?? $df['tempat_lahir'] ?? '-';
    $jk         = $df['jk']    ?? $df['jenis_kelamin'] ?? '-';
    $pekerjaan  = $df['pekerjaan'] ?? ($pemohon?->pekerjaan ?? '-');
    $alamat     = $df['alamat'] ?? ($pemohon?->alamat ?? '-');
    $keperluan  = $df['keperluan'] ?? '-';
    $penghasilan= $df['penghasilan'] ?? '-';
    $namaAnak   = $df['nama_anak'] ?? '-';
    $ttlAnak    = $df['ttl_anak'] ?? '-';
    $namaUsaha  = $df['nama_usaha'] ?? $df['jenis_usaha'] ?? '-';

    // ===== Settings Desa =====
    $settingsArr = DB::table('settings')->get()->pluck('value', 'key')->toArray();
    $namaDesa    = $settingsArr['nama_desa'] ?? 'Hutabulu Mejan';
    $logoPath    = $settingsArr['logo'] ?? null;
    // Logo bisa disimpan sebagai path public (images/logo/...) atau storage (storage/images/...)
    if ($logoPath) {
        // Cek apakah file ada di public path langsung
        if (file_exists(public_path($logoPath))) {
            $logoUrl = asset($logoPath);
        } else {
            // Coba storage path
            $logoUrl = asset('storage/' . $logoPath);
        }
    } else {
        $logoUrl = null;
    }

    // Info kop surat (bisa disesuaikan)
    $kabupaten   = 'KABUPATEN TOBA';
    $kecamatan   = 'KECAMATAN BALIGE';
    $alamatDesa  = 'Jl. Hutabulu Mejan, Kode Pos : 22312, Website : www.hutabulumejan.desa.id';
    $websiteDesa = 'www.desahutabulumejan.id';

    // ===== Tanggal =====
    $tanggalCetak = $pengajuanSurat->tanggal_selesai ?? now();
    $bulanId = [
        1  => 'Januari',  2  => 'Februari', 3  => 'Maret',
        4  => 'April',    5  => 'Mei',       6  => 'Juni',
        7  => 'Juli',     8  => 'Agustus',   9  => 'September',
        10 => 'Oktober',  11 => 'November',  12 => 'Desember',
    ];
    $tgl = \Carbon\Carbon::parse($tanggalCetak);
    $tanggalFormatted = $tgl->day . ' ' . $bulanId[$tgl->month] . ' ' . $tgl->year;

    // ===== Jenis Surat =====
    $namaJenisSurat = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';
    $nomorSurat     = $pengajuanSurat->nomor_surat ?? '...... / ........';

    // ===== Penandatangan =====
    $penandatangan  = $pengajuanSurat->diprosesOleh->name ?? 'Kepala Desa ' . $namaDesa;
    $jabatanTtd     = 'Kepala Desa ' . $namaDesa;
@endphp

<div class="page">

    {{-- ===== KOP SURAT ===== --}}
    <div class="kop">
        @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="Logo Desa" class="kop-logo">
        @else
            <div class="kop-logo-placeholder">LOGO<br>DESA</div>
        @endif
        <div class="kop-text">
            <div class="instansi-atas">PEMERINTAH {{ $kabupaten }}</div>
            <div class="instansi-tengah">{{ $kecamatan }}</div>
            <div class="nama-desa">DESA {{ strtoupper($namaDesa) }}</div>
            <div class="alamat-desa">{{ $alamatDesa }}</div>
            <div class="alamat-desa">{{ $websiteDesa }}</div>
        </div>
    </div>
    <hr class="garis-kop">
    <hr class="garis-kop-tipis">

    {{-- ===== JUDUL SURAT ===== --}}
    <div class="judul-surat">
        <h2>{{ strtoupper($namaJenisSurat) }}</h2>
    </div>
    <div class="nomor-surat">
        Nomor : <u>&nbsp;&nbsp;{{ $nomorSurat }}&nbsp;&nbsp;</u>
    </div>

    {{-- ===== PEMBUKA ===== --}}
    <p class="pembuka">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                <td>{{ ucfirst($alamat) }}, Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}</td>
            </tr>
        </table>
    </div>

    {{-- ===== ISI SURAT (tergantung jenis) ===== --}}
    @switch($namaJenisSurat)

        @case('Surat Keterangan Domisili')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar merupakan warga / penduduk yang berdomisili
                di wilayah Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
            </p>
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Surat Keterangan Domisili ini diberikan kepada yang bersangkutan untuk dipergunakan
                sebagai {{ $keperluan !== '-' ? strtolower($keperluan) : 'keperluan yang dibutuhkan' }}.
            </p>
            @break

        @case('Surat Keterangan Tidak Mampu')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar Penduduk Desa {{ $namaDesa }} dan nama
                tersebut diatas merupakan keluarga <strong>Tidak Mampu</strong>.
            </p>
            @if($penghasilan !== '-')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Adapun penghasilan per bulan yang bersangkutan adalah kurang lebih
                <strong>Rp. {{ number_format((int)$penghasilan, 0, ',', '.') }},-</strong>.
            </p>
            @endif
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Surat Keterangan Tidak Mampu ini dibuat untuk dipergunakan sebagai
                {{ $keperluan !== '-' ? strtolower($keperluan) : 'keperluan yang dibutuhkan' }}.
            </p>
            @break

        @case('Surat Keterangan Usaha')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar merupakan warga Desa {{ $namaDesa }} dan
                benar-benar mempunyai usaha dengan jenis usaha
                <strong>{{ strtoupper($namaUsaha) }}</strong> yang bertempat di
                Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
            </p>
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Surat Keterangan Usaha ini diberikan untuk keperluan
                {{ $keperluan !== '-' ? strtolower($keperluan) : 'yang dibutuhkan' }}.
            </p>
            @break

        @case('Surat Pengantar')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar merupakan warga / penduduk yang berdomisili
                di Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
            </p>
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Sehubungan dengan keperluan untuk <strong>{{ $keperluan }}</strong>,
                maka dengan ini kami menerangkan bahwa yang bersangkutan adalah warga kami dan
                kami merekomendasikan untuk diproses lebih lanjut sesuai ketentuan yang berlaku.
            </p>
            @break

        @case('Surat Keterangan Kelahiran')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar merupakan warga / penduduk yang berdomisili
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
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Nama tersebut diatas adalah benar merupakan warga / penduduk yang berdomisili
                di wilayah Desa {{ $namaDesa }}, {{ $kecamatan }}, {{ $kabupaten }}.
            </p>
            @if($keperluan !== '-')
            <p class="isi-surat">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Surat keterangan ini diberikan untuk keperluan
                <strong>{{ strtolower($keperluan) }}</strong>.
            </p>
            @endif
    @endswitch

    {{-- ===== PENUTUP ===== --}}
    <p class="penutup">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Demikianlah {{ $namaJenisSurat }} ini dibuat agar dapat dipergunakan sebagaimana mestinya.
    </p>

    {{-- ===== TANDA TANGAN ===== --}}
    <div class="ttd-section">
        <div class="ttd-box">
            <div class="ttd-info">
                <p>Dikeluarkan di : Desa {{ $namaDesa }}</p>
                <p>Pada Tanggal &nbsp;&nbsp;: {{ $tanggalFormatted }}</p>
            </div>
            <p style="margin-bottom:4px;">{{ $jabatanTtd }}</p>
            <div class="ttd-ruang"></div>
            <div>
                <span class="ttd-nama">{{ strtoupper($penandatangan) }}</span>
            </div>
        </div>
    </div>

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
