@extends('Components.layouts.laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/app-DnvfNtza.css') }}">
@endpush

@section('content')
<div class="rounded-sm">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU RENCANA KERJA PEMBANGUNAN TAHUN 2025</h1>
    <table class="table-auto mx-auto border mb-4">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">Nomor Urut</th>
                <th class="border px-2" rowspan="2">JENIS/NAMA HASIL PEMBANGUNAN</th>
                <th class="border px-2" rowspan="2">VOLUME</th>
                <th class="border px-2" rowspan="2">BIAYA</th>
                <th class="border px-2" rowspan="2">LOKASI</th>
                <th class="border px-2" rowspan="2">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembangunanData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_kegiatan }}</td>
                <td class="border px-4">-</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_pemerintah + $item->biaya_provinsi + $item->biaya_kabupaten_kota + $item->biaya_swadaya, 0, ',', '.') }},00</td>
                <td class="border px-4">{{ $item->lokasi }}</td>
                <td class="border px-4">{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mengetahui flex justify-around ">
        <div class="p-10 text-center">
            <h5 class="font-semibold">MENGETAHUI</h5>
            <h5 class="mb-10 ">KEPALA DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">Nama Kepala Desa </h5>
        </div>
        <div class="p-10 text-center">
            <h5 class="font-semibold">{{ $date }}</h5>
            <h5 class="mb-10 ">SEKRETARIS DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">Nama Sekertaris</h5>
        </div>
    </div>
</div>
@endsection
