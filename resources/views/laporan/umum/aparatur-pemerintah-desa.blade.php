@extends('Components.layouts.laporan')


@section('content')
<div class="mx-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU APARATUR PEMERINTAH {{ $settings['nama_desa'] }} 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">Nomor Urut</th>
                <th class="border px-2" rowspan="2">NAMA</th>
                <th class="border px-2" rowspan="2">NIPD</th>
                <th class="border px-2" rowspan="2">NIP</th>
                <th class="border px-2" rowspan="2">JENIS KELAMIN</th>
                <th class="border px-2" rowspan="2">TEMPAT DAN TANGGAL LAHIR</th>
                <th class="border px-2" rowspan="2">AGAMA</th>
                <th class="border px-2" rowspan="2">PANGKAT GOLONGAN</th>
                <th class="border px-2" rowspan="2">JABATAN</th>
                <th class="border px-2" rowspan="2">PENDIDIKAN TERAKHIR</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL KEPUTUSAN PENGANGKATAN</th>
                <th class="border px-2" rowspan="2">NOMOR DAN TANGGAL KEPUTUSAN PEMBERHENTIAN</th>
                <th class="border px-2" rowspan="2">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aparaturDesaData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_lengkap }}</td>
                <td class="border px-4">{{ empty($item->nip) ? '-' : $item->nip }}</td>
                <td class="border px-4">{{ empty($item->nipd) ? '-' : $item->nipd }}</td>
                <td class="border px-4">{{ $item->jenis_kelamin }}</td>
                <td class="border px-4">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</td>
                <td class="border px-4">{{ $item->agama }}</td>
                <td class="border px-4 text-center">{{ $item->golongan }}</td>
                <td class="border px-4">{{ $item->jabatan }}</td>
                <td class="border px-4">{{ $item->pendidikan}}</td>
                <td class="border px-4">
                    {{ empty($item->tanggal_pengangkatan) ? '-' : 'Nomor ' . ($index + 1) . ' dan ' . $item->tanggal_pengangkatan }}
                </td>
                <td class="border px-4">
                    {{ empty($item->tanggal_pemberhentian) ? '-' : 'Nomor ' . ($index + 1) . ' dan ' . $item->tanggal_pemberhentian }}
                </td>
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
