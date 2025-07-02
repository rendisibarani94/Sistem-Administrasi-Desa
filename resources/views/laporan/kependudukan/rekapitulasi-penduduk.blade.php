@extends('components.layouts.laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/app-DnvfNtza.css') }}">
@endpush

@section('content')
<div class="mx-5">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU REKAPITULASI PENDUDUK {{ $settings['nama_desa'] }} TAHUN {{ $year }}</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="4">NO</th>
                <th class="border px-2" rowspan="4">DUSUN</th>
                <th class="border px-2" colspan="7">JUMLAH PENDUDUK AWAL BULAN</th>
                <th class="border px-2" colspan="8">TAMBAHAN BULAN INI</th>
                <th class="border px-2" colspan="8">PENGURANGAN BULAN INI</th>
                <th class="border px-2" colspan="7">JUMLAH PENDUDUK AKHIR BULAN</th>
                <th class="border px-2" rowspan="4">KET</th>
            </tr>
            <tr>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" rowspan="3">JLH KK</th>
                <th class="border px-2" rowspan="3">JML ANGGOTA</th>
                <th class="border px-2" rowspan="3">JML JIWA</th>
                <th class="border px-2" colspan="4">LAHIR</th>
                <th class="border px-2" colspan="4">DATANG</th>
                <th class="border px-2" colspan="4">MENINGGAL</th>
                <th class="border px-2" colspan="4">PINDAH</th>
                <th class="border px-2" colspan="2">WNA</th>
                <th class="border px-2" colspan="2">WNI</th>
                <th class="border px-2" rowspan="3">JLH KK</th>
                <th class="border px-2" rowspan="3">JML ANGGOTA</th>
                <th class="border px-2" rowspan="3">JML JIWA</th>
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
                <th class="border px-2" rowspan="2">L</th>
                <th class="border px-2" rowspan="2">P</th>
                <th class="border px-2" rowspan="2">L</th>
                <th class="border px-2" rowspan="2">P</th>
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
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $dusun)
            <tr>
                <td class="border px-2 text-center">{{ $index + 1 }}</td>
                <td class="border px-2">{{ $dusun['dusun'] }}</td>

                <!-- Awal Bulan -->
                <td class="border px-2 text-center">{{ $dusun['awal']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['awal']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['awal']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['awal']['WNI_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['kk_awal'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['jiwa_awal'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['jiwa_awal'] }}</td>

                <!-- Tambahan: Lahir -->
                <td class="border px-2 text-center">{{ $dusun['lahir']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['lahir']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['lahir']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['lahir']['WNI_P'] }}</td>

                <!-- Tambahan: Datang -->
                <td class="border px-2 text-center">{{ $dusun['datang']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['datang']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['datang']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['datang']['WNI_P'] }}</td>

                <!-- Pengurangan: Meninggal -->
                <td class="border px-2 text-center">{{ $dusun['meninggal']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['meninggal']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['meninggal']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['meninggal']['WNI_P'] }}</td>

                <!-- Pengurangan: Pindah -->
                <td class="border px-2 text-center">{{ $dusun['pindah']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['pindah']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['pindah']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['pindah']['WNI_P'] }}</td>

                <!-- Akhir Bulan -->
                <td class="border px-2 text-center">{{ $dusun['akhir']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['akhir']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['akhir']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['akhir']['WNI_P'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['kk_akhir'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['jiwa_akhir'] }}</td>
                <td class="border px-2 text-center">{{ $dusun['jiwa_akhir'] }}</td>

                <td class="border px-2"></td>
            </tr>
            @endforeach

            <!-- Baris Total -->
            <tr class="font-bold">
                <td class="border px-2 text-center" colspan="2">TOTAL</td>

                <!-- Awal Bulan -->
                <td class="border px-2 text-center">{{ $total['awal_per_kategori']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['awal_per_kategori']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['awal_per_kategori']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['awal_per_kategori']['WNI_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['kk_awal'] }}</td>
                <td class="border px-2 text-center">{{ $total['awal'] }}</td>
                <td class="border px-2 text-center">{{ $total['awal'] }}</td>

                <!-- Tambahan: Lahir -->
                <td class="border px-2 text-center">{{ $total['lahir']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['lahir']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['lahir']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['lahir']['WNI_P'] }}</td>

                <!-- Tambahan: Datang -->
                <td class="border px-2 text-center">{{ $total['datang']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['datang']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['datang']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['datang']['WNI_P'] }}</td>

                <!-- Pengurangan: Meninggal -->
                <td class="border px-2 text-center">{{ $total['meninggal']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['meninggal']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['meninggal']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['meninggal']['WNI_P'] }}</td>

                <!-- Pengurangan: Pindah -->
                <td class="border px-2 text-center">{{ $total['pindah']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['pindah']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['pindah']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['pindah']['WNI_P'] }}</td>

                <!-- Akhir Bulan -->
                <td class="border px-2 text-center">{{ $total['akhir_per_kategori']['WNA_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['akhir_per_kategori']['WNA_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['akhir_per_kategori']['WNI_L'] }}</td>
                <td class="border px-2 text-center">{{ $total['akhir_per_kategori']['WNI_P'] }}</td>
                <td class="border px-2 text-center">{{ $total['kk_akhir'] }}</td>
                <td class="border px-2 text-center">{{ $total['akhir'] }}</td>
                <td class="border px-2 text-center">{{ $total['akhir'] }}</td>

                <td class="border px-2"></td>
            </tr>
        </tbody>
    </table>

    <div class="mengetahui flex justify-around mt-10">
        <div class="p-10 text-center">
            <h5 class="font-semibold">MENGETAHUI</h5>
            <h5 class="mb-10">KEPALA DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $kepala_desa }}</h5>
        </div>
        <div class="p-10 text-center">
            <h5 class="font-semibold">{{ $date }}</h5>
            <h5 class="mb-10">SEKRETARIS DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $sekretaris }}</h5>
        </div>
    </div>
</div>
@endsection
