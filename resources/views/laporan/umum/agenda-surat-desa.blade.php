@extends('Components.layouts.laporan')


@section('content')
<div class="mx-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU AGENDA 2025</h1>

    <table class="table-auto mx-auto border mb-4 text-sm">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">NOMOR URUT</th>
                <th class="border px-2" colspan="6">SURAT MASUK</th>
                <th class="border px-2" colspan="6">SURAT KELUAR</th>
            </tr>
            <tr>
                <th class="border px-2">TANGGAL PENERIMAAN SURAT</th>
                <th class="border px-2">NOMOR</th>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">PENGIRIM</th>
                <th class="border px-2">ISI SINGKAT</th>
                <th class="border px-2">KETERANGAN</th>

                <th class="border px-2">TANGGAL PENGIRIMAN SURAT</th>
                <th class="border px-2">NOMOR</th>
                <th class="border px-2">TANGGAL</th>
                <th class="border px-2">PENGIRIM</th>
                <th class="border px-2">ISI SINGKAT</th>
                <th class="border px-2">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php
            $rowCount = max(count($agendaSuratMasukDesaData), count($agendaSuratKeluarDesaData));
        @endphp

            @foreach (range(0, $rowCount - 1) as $i)
            <tr>
                <td class="border px-4 text-center" >{{ $i + 1 }}</td>
                {{-- Surat Masuk --}}
                <td class="border px-4">{{ $agendaSuratMasukDesaData[$i]->tanggal_pengiriman_penerimaan ?? '-' }}</td>
                {{-- <td class="border px-4">{{ $agendaSuratMasukDesaData[$i] + 1 }}</td> --}}
                <td class="border px-4">{{ $i + 1 }}</td>
                <td class="border px-4">{{ $agendaSuratMasukDesaData[$i]->tanggal_pengiriman_penerimaan ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratMasukDesaData[$i]->pengirim_penerima ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratMasukDesaData[$i]->isi_singkat ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratMasukDesaData[$i]->keterangan ?? '-' }}</td>

                {{-- Surat Keluar --}}
                <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i]->tanggal_pengiriman_penerimaan ?? '-' }}</td>
                {{-- <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i] + 1 }}</td> --}}
                <td class="border px-4">{{ $i + 1 }}</td>
                <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i]->tanggal_pengiriman_penerimaan ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i]->pengirim_penerima ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i]->isi_singkat ?? '-' }}</td>
                <td class="border px-4">{{ $agendaSuratKeluarDesaData[$i]->keterangan ?? '-' }}</td>
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
