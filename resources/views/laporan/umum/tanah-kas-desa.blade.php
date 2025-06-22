@extends('Components.layouts.laporan')


@section('content')
<div class="mx-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU TANAH KAS {{ $settings['nama_desa'] }} 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-[10px]">
        <thead>
            <tr>
                <th class="border px-2" rowspan="3">NOMOR URUT</th>
                <th class="border px-2" rowspan="3">ASAL TANAH KAS DESA</th>
                <th class="border px-2" rowspan="3">NOMOR SERTIFIKAT BUKU LETTER C / PERSIL</th>
                <th class="border px-2" rowspan="3">LUAS (m)</th>
                <th class="border px-2" colspan="6">PEROLEHAN TKD</th>
                <th class="border px-2" colspan="5">JENIS TKD</th>
                <th class="border px-2" colspan="2">PATOK TANDA BATAS</th>
                <th class="border px-2" colspan="2">PAPAN NAMA</th>
                <th class="border px-2" rowspan="3">LOKASI</th>
                <th class="border px-2" rowspan="3">PERUNTUKAN</th>
                <th class="border px-2" rowspan="3">MUTASI</th>
                <th class="border px-2" rowspan="3">KET</th>
            </tr>
            <tr>
                <th class="border px-2" rowspan="2">ASLI MILIK DESA</th>
                <th class="border px-2" colspan="3">BANTUAN</th>
                <th class="border px-2" rowspan="2">LAIN-LAIN</th>
                <th class="border px-2" rowspan="2">TGL PEROLEHAN</th>
                <th class="border px-2" rowspan="2">SAWAH</th>
                <th class="border px-2" rowspan="2">TEGAL</th>
                <th class="border px-2" rowspan="2">KEBUN</th>
                <th class="border px-2" rowspan="2">TOMBAK / KOLAM</th>
                <th class="border px-2" rowspan="2">TANAH KERING / DARAT</th>
                <th class="border px-2" rowspan="2">ADA</th>
                <th class="border px-2" rowspan="2">TIDAK ADA</th>
                <th class="border px-2" rowspan="2">ADA</th>
                <th class="border px-2" rowspan="2">TIDAK ADA</th>
            </tr>
            <tr>
                <th class="border px-2">PEMERINTAH</th>
                <th class="border px-2">PROV</th>
                <th class="border px-2">KAB/KOTA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tanahKasDesaData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->asal_tkd }}</td>
                <td class="border px-4">{{ $item->letter_c }}</td>
                <td class="border px-4">{{ $item->oleh_desa + $item->oleh_pemerintah + $item->oleh_provinsi + $item->oleh_kabupaten + $item->oleh_lain_lain }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->oleh_desa }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->oleh_pemerintah }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->oleh_provinsi }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->oleh_kabupaten }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->oleh_lain_lain }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tanggal_perolehan }}</td>
                <td class="border px-4">{{ $item->sawah }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tegal }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->kebun }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tombak }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tanah_kering }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->patok }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tanpa_patok }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->papan_nama }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->tanpa_papan_nama }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->lokasi }}</td>
                <td class="border px-4">{{ $item->peruntukan }}</td>
                <td class="border px-4">{{ '-' }}</td>
                <td class="border px-4">{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mengetahui flex justify-around ">
        <div class="p-10 text-center">
            <h5 class="font-semibold">MENGETAHUI</h5>
            <h5 class="mb-10 ">KEPALA DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $kepala_desa }} </h5>
        </div>
        <div class="p-10 text-center">
            <h5 class="font-semibold">{{ $date }}</h5>
            <h5 class="mb-10 ">SEKRETARIS DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $sekretaris }}</h5>
        </div>
    </div>
</div>
@endsection
