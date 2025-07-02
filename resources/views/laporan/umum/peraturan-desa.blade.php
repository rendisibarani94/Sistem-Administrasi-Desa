@extends('components.layouts.laporan')


@section('content')
<div class="mx-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU PERATURAN DESA {{ $settings['nama_desa'] }} 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">Nomor Urut</th>
                <th class="border px-2" rowspan="2">JENIS PERATURAN DI DESA</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL DITETAPKAN</th>
                <th class="border px-2" rowspan="2">TENTANG</th>
                <th class="border px-2" rowspan="2">URAIAN SINGKAT</th>
                <th class="border px-2" rowspan="2">Tanggal Kesepakatan Peraturan Desa</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL DILAPORKAN</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL DIUNDANGKAN DALAM LEMBARAN DESA</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL DIUNDANGKAN DALAM BERITA DESA</th>
                <th class="border px-2" rowspan="2">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peraturanDesaData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->jenis_peraturan }}</td>
                <td class="border px-4">Nomor {{ $index + 1 }} dan {{ $item->tanggal_ditetapkan }}</td>
                <td class="border px-4">{{ $item->tentang }}</td>
                <td class="border px-4">{{ $item->uraian_singkat }}</td>
                <td class="border px-4">{{ $item->tanggal_kesepakatan }}</td>
                <td class="border px-4">{{ $item->tanggal_dilaporkan }}</td>
                <td class="border px-4">Nomor {{ $index + 1 }} dan {{ $item->tanggal_diundangkan_berita_desa }}</td>
                <td class="border px-4">Nomor {{ $index + 1 }} dan {{ $item->tanggal_diundangkan_berita_desa }}</td>
                <td class="border px-4">{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mengetahui flex justify-around ">
        <div class="p-10 text-center">
            <h5 class="font-semibold">MENGETAHUI</h5>
            <h5 class="mb-10 ">KEPALA DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $kepala_desa }}</h5>
        </div>
        <div class="p-10 text-center">
            <h5 class="font-semibold">{{ $date }}</h5>
            <h5 class="mb-10 ">SEKRETARIS DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $sekretaris }}</h5>
        </div>
    </div>
</div>
@endsection
