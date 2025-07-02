@extends('components.layouts.laporan')

@section('content')
<div class="mx-5">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU INDUK PENDUDUK {{ $settings['nama_desa'] }} TAHUN 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">NOMOR URUT</th>
                <th class="border px-2" rowspan="2">NAMA LENGKAP / PANGGILAN</th>
                <th class="border px-2" rowspan="2">JENIS KELAMIN</th>
                <th class="border px-2" rowspan="2">STATUS PERKAWINAN</th>
                <th class="border px-2" colspan="2">TEMPAT & TANGGAL LAHIR</th>
                <th class="border px-2" rowspan="2">AGAMA</th>
                <th class="border px-2" rowspan="2">PENDIDIKAN TERAKHIR</th>
                <th class="border px-2" rowspan="2">PEKERJAAN</th>
                <th class="border px-2" rowspan="2">DAPAT MEMBACA HURUF</th>
                <th class="border px-2" rowspan="2">KEWARGANEGARAAN</th>
                <th class="border px-2" rowspan="2">ALAMAT LENGKAP</th>
                <th class="border px-2" rowspan="2">KEDUDUKAN DLM KELUARGA</th>
                <th class="border px-2" rowspan="2">NIK</th>
                <th class="border px-2" rowspan="2">NOMOR KK</th>
                <th class="border px-2" rowspan="2">KET</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indukPendudukData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
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
