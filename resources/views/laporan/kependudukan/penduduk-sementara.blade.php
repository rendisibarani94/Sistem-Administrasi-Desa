@extends('components.layouts.laporan')

@section('content')
<div class="mx-5">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU PENDUDUK SEMENTARA {{ $settings['nama_desa'] }} TAHUN 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-xs">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">NOMOR URUT</th>
                <th class="border px-2" rowspan="2">NAMA LENGKAP</th>
                <th class="border px-2" colspan="2">JENIS KELAMIN</th>
                <th class="border px-2" rowspan="2">NOMOR IDENTITAS / TANDA PENGENAL</th>
                <th class="border px-2" rowspan="2">TEMPAT DAN TANGGAL LAHIR </th>
                <th class="border px-2" rowspan="2">PEKERJAAN</th>
                <th class="border px-2" colspan="2">KEWARGANEGARAAN</th>
                <th class="border px-2" rowspan="2">DATANG DARI</th>
                <th class="border px-2" rowspan="2">MAKSUD DAN TUJUAN KEDATANGAN</th>
                <th class="border px-2" rowspan="2">NAMA DAN ALAMAT YG DIDATANGI</th>
                <th class="border px-2" rowspan="2">DATANG TANGGAL</th>
                <th class="border px-2" rowspan="2">PERGI TANGGAL</th>
                <th class="border px-2" rowspan="2">KET</th>
            </tr>
            <tr>
                <th class="border px-2">L</th>
                <th class="border px-2">P</th>
                <th class="border px-2">KEBANGSAAN</th>
                <th class="border px-2">KETURUNAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendudukSementaraData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_lengkap }}</td>
                <td class="border px-4">{{ $item->jenis_kelamin == 'Laki-laki' ? 'L' : '-' }}</td>
                <td class="border px-4">{{ $item->jenis_kelamin == 'Perempuan' ? 'P' : '-' }}</td>
                <td class="border px-4">{{ $item->nomor_pengenal }}</td>
                <td class="border px-4">{{ $item->tempat_lahir.', '. $item->tanggal_lahir }}</td>
                <td class="border px-4">{{ $item->nama_pekerjaan }}</td>
                <td class="border px-4">{{ $item->kewarganegaraan }}</td>
                <td class="border px-4">{{ $item->keturunan }}</td>
                <td class="border px-4">{{ $item->asal }}</td>
                <td class="border px-4">{{ $item->maksud_kedatangan }}</td>
                <td class="border px-4">{{ $item->tokoh_tujuan . ', '. $item->alamat_tujuan }}</td>
                <td class="border px-4">{{ $item->tanggal_kedatangan }}</td>
                <td class="border px-4">{{ $item->tanggal_kepulangan }}</td>
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
