@extends('Components.layouts.laporan')


@section('content')
<div class="mx-2">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU INVENTARIS DAN KEKAYAAN {{ $settings['nama_desa'] }}</h1>
    <table class="table-auto mx-auto border mb-4 text-[10px]">
        <thead>
            <tr>
                <th class="border px-2" rowspan="3">NOMOR URUT</th>
                <th class="border px-2" rowspan="3">JENIS BARANG/BANGUNAN</th>
                <th class="border px-2" colspan="5">ASAL BARANG/BANGUNAN</th>
                <th class="border px-2" colspan="2">KEADAAN BARANG/BANGUNAN AWAL TAHUN</th>
                <th class="border px-2" rowspan="3">KETERANGAN</th>
                <th class="border px-2" rowspan="3">JENIS BARANG/BANGUNAN</th>
                <th class="border px-2" colspan="4">PENGHAPUSAN BARANG DAN BANGUNAN</th>
                <th class="border px-2" colspan="2">KEADAAN BARANG/BANGUNAN AKHIR TAHUN</th>
                <th class="border px-2" rowspan="3">KETERANGAN</th>
            </tr>
            <tr>
                <th class="border px-2" rowspan="2">DIBELI SENDIRI</th>
                <th class="border px-2" colspan="3">BANTUAN</th>
                <th class="border px-2" rowspan="2">SUMBANGAN</th>
                <th class="border px-2" rowspan="2">BAIK</th>
                <th class="border px-2" rowspan="2">RUSAK</th>
                <th class="border px-2" rowspan="2">RUSAK</th>
                <th class="border px-2" rowspan="2">DIJUAL</th>
                <th class="border px-2" rowspan="2">DISUMBANGKAN</th>
                <th class="border px-2" rowspan="2">TGL PENGHAPUSAN</th>
                <th class="border px-2" rowspan="2">BAIK</th>
                <th class="border px-2" rowspan="2">RUSAK</th>
            </tr>
            <tr>
                <th class="border px-2">PEMERINTAH</th>
                <th class="border px-2">PROVINSI</th>
                <th class="border px-2">KAB/KOTA</th>
            </tr>
        </thead>
        <tbody>
            @php
            $rowCount = max(count($inventarisDesa), count($inventarisDesaDihapus));
            @endphp

            @foreach (range(0, $rowCount - 1) as $i)
            <tr>
                <td class="border px-4 text-center">{{ $i + 1 }}</td>
                <td class="border px-4">{{ $inventarisDesa[$i]->jenis_inventaris }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->oleh_desa }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->oleh_pemerintah }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->oleh_provinsi }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->oleh_kabupaten }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->oleh_sumbangan }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->awal_baik }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->awal_rusak }}</td>
                <td class="border px-4">{{$inventarisDesa[$i]->keterangan }}</td>

                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jenis_inventaris }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jumlah_rusak }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jumlah_dijual }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jumlah_disumbangkan }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->tanggal_penghapusan }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jumlah_baik }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->jumlah_rusak }}</td>
                <td class="border px-4">{{ $inventarisDesaDihapus[$i]->keterangan }}</td>
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
