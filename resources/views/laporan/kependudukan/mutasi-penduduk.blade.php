@extends('components.layouts.laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/app-DnvfNtza.css') }}">
@endpush

@section('content')
<div class="mx-5">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU MUTASI PENDUDUK {{ $settings['nama_desa'] }}</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">NOMOR URUT</th>
                <th class="border px-2" rowspan="2">NAMA LENGKAP / PANGGILAN</th>
                <th class="border px-2" colspan="2">TEMPAT & TANGGAL LAHIR</th>
                <th class="border px-2" rowspan="2">JENIS KELAMIN</th>
                <th class="border px-2" rowspan="2">KEWARGANEGARAAN</th>
                <th class="border px-2" colspan="2">PENAMBAHAN</th>
                <th class="border px-2" colspan="4">PENGURANGAN</th>
                <th class="border px-2" rowspan="2">KET</th>
            </tr>
            <tr>
                <th class="border px-2">TEMPAT</th>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">DATANG DARI</th>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">PINDAH</th>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">MENINGGAL</th>
                <th class="border px-2">TANGGAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indukPendudukData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_lengkap }}</td>
                <td class="border px-4">{{ $item->tempat_lahir }}</td>
                <td class="border px-4">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
                <td class="border px-4">{{ $item->jenis_kelamin }}</td>
                <td class="border px-4">{{ $item->kewarganegaraan }}</td>
                <td class="border px-4">{{ $item->asal_penduduk }}</td>
                <td class="border px-4">{{ $item->tanggal_penambahan }}</td>
                <td class="border px-4">{{ $item->tujuan_pindah }}</td>
                <td class="border px-4">
                    @if (!empty($item->tujuan_pindah))
                    {{ $item->tanggal_pengurangan }}
                    @else
                    {{ '-' }}
                    @endif
                </td>
                <td class="border px-4">{{ $item->tempat_meninggal ?? '-' }}</td>
                <td class="border px-4">
                    @if (!empty($item->tempat_meninggal))
                    {{ $item->tanggal_pengurangan }}
                    @else
                    {{ '-' }}
                    @endif
                </td>
                <td class="border px-4">{{ $item->keterangan ?? '-' }}</td>
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
