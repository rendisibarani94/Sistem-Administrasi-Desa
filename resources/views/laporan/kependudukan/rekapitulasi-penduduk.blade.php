@extends('Components.layouts.laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/app-DnvfNtza.css') }}">
@endpush

@section('content')
<div class="mx-5">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU REKAPITULASI PENDUDUK TAHUN 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="4">NOMOR URUT</th>
                <th class="border px-2" rowspan="4">NAMA DUSUN / LINGKUNGAN</th>
                <th class="border px-2" colspan="7">JUMLAH PENDUDUK AWAL BULAN</th>
                <th class="border px-2" colspan="8">TAMBAHAN BULAN INI</th>
                <th class="border px-2" colspan="8">PENGURANGAN BULAN INI</th>
                <th class="border px-2" colspan="7" rowspan="2">JUMLAH PENDUDUK AWAL BULAN</th>
                <th class="border px-2" rowspan="4">KET</th>
            </tr>
            <tr>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" rowspan="3">JLH KK</th>
                <th class="border px-2" rowspan="3">JUMLAH ANGGOTA KELUARGA</th>
                <th class="border px-2" rowspan="3">JML JIWA</th>
                <th class="border px-2" colspan="4">LAHIR</th>
                <th class="border px-2" colspan="4">DATANG</th>
                <th class="border px-2" colspan="4">MENINGGAL</th>
                <th class="border px-2" colspan="4">PINDAH</th>
            </tr>
            <tr>
                <th class="border px-2" rowspan="2">L</th>
                <th class="border px-2" rowspan="2">P</th>
                <th class="border px-2" rowspan="2">L</th>
                <th class="border px-2" rowspan="2">P</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" rowspan="2">JML KK</th>
                <th class="border px-2" rowspan="2">JML ANGGOTA KELUARGA</th>
                <th class="border px-2" rowspan="2">JML JIWA</th>
            </tr>
            <tr>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($indukPendudukData as $index => $item) --}}
            <tr>
                {{-- <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_lengkap }}</td>
                <td class="border px-4">{{ $item->jenis_kelamin }}</td>
                <td class="border px-4">{{ $item->status_perkawinan }}</td>
                <td class="border px-4">{{ $item->tempat_lahir }}</td>
                <td class="border px-4"> {{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
                <td class="border px-4">{{ $item->agama }}</td>
                <td class="border px-4">{{ $item->pendidikan_terakhir }}</td>
                <td class="border px-4">{{ $item->pekerjaan }}</td>
                <td class="border px-4">{{ $item->baca_huruf }}</td>
                <td class="border px-4">{{ $item->kewarganegaraan ?? '-' }}</td>
                <td class="border px-4">{{ $item->alamat }}</td>
                <td class="border px-4">{{ $item->kedudukan_keluarga }}</td>
                <td class="border px-4">{{ $item->nik }}</td>
                <td class="border px-4">{{ $item->nomor_kartu_keluarga }}</td>
                <td class="border px-4">{{ $item->keterangan ?? '-' }}</td> --}}
            </tr>
            {{-- @endforeach --}}
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
