@extends('Components.layouts.laporan')


@section('content')
<div class="mx-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU LEMBARAN DESA DAN BERITA DESA {{ $settings['nama_desa'] }} 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">NOMOR URUT</th>
                <th class="border px-2" rowspan="2">JENIS PERATURAN DI DESA</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL DITETAPKAN</th>
                <th class="border px-2" rowspan="2">TENTANG</th>
                <th class="border px-2" colspan="2">DIUNDANGKAN</th>
                <th class="border px-2" rowspan="2">KETERANGAN</th>
            </tr>
            <tr>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">NOMOR</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lembaranBeritaDesaData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->jenis_peraturan }}</td>
                <td class="border px-4">Nomor {{ $index + 1 }} dan {{ $item->tanggal_ditetapkan }}</td>
                <td class="border px-4">{{ $item->tentang }}</td>
                <td class="border px-4">{{ $item->tanggal_diundangkan_berita_desa }}</td>
                <td class="border px-4">Nomor {{ $index + 1 }}</td>
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
