@extends('Components.layouts.laporan')


@section('content')
<div class="mx-2">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">BUKU TANAH DESA {{ $settings['nama_desa'] }} 2025</h1>
    <table class="table-auto mx-auto border mb-4 text-[9px]">
        <thead>
            <tr>
                <th class="border px-2" rowspan="3">NOMOR URUT</th>
                <th class="border px-2" rowspan="3">Nama PERORANGAN / BADAN HUKUM</th>
                <th class="border px-2" rowspan="3">JML(M<sup>2</sup>)</th>
                <th class="border px-2" colspan="8">STATUS HAK MILIK TANAH (M<sup>2</sup>)</th>
                <th class="border px-2" colspan="14">PENGGUNAAN TANAH (M<sup>2</sup>)</th>
                <th class="border px-2" rowspan="3">KET</th>
            </tr>
            <tr>
                <th class="border px-2" colspan="5">SUDAH BERSERTIFIKAT</th>
                <th class="border px-2" colspan="3">BELUM BERSERTIFIKAT</th>
                <th class="border px-2" colspan="5">NON PERTANIAN</th>
                <th class="border px-2" colspan="6">PERTANIAN</th>
                <th class="border px-2" colspan="3">LAINNYA</th>
            </tr>
            <tr>
                <th class="border px-2">HM</th>
                <th class="border px-2">HGB</th>
                <th class="border px-2">HP</th>
                <th class="border px-2">HGU</th>
                <th class="border px-2">HPL</th>
                <th class="border px-2">MA</th>
                <th class="border px-2">VI</th>
                <th class="border px-2">TN</th>
                <th class="border px-2">PERUMAHAN</th>
                <th class="border px-2">PERDAGANGAN DAN JASA</th>
                <th class="border px-2">PERKANTORAN</th>
                <th class="border px-2">INDUSTRI</th>
                <th class="border px-2">FASILITAS UMUM</th>
                <th class="border px-2">SAWAH</th>
                <th class="border px-2">TEGALAN</th>
                <th class="border px-2">PERKEBUNAN</th>
                <th class="border px-2">PETERNAKAN / PERIKANAN</th>
                <th class="border px-2">HUTAN BELUKAR</th>
                <th class="border px-2">HUTAN LEBAT / LINDUNG</th>
                <th class="border px-2">MUTASI TANAH</th>
                <th class="border px-2">TANAH KOSONG</th>
                <th class="border px-2">LAIN-LAIN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tanahDesaData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_pemegang_hak_tanah }}</td>
                <td class="border px-4">{{ $item->volume }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hm }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hgb }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hp }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hgu }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hpl }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_ma }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_vi }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_tn }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_perumahan }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_perdagangan }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_perkantoran }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_industri }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_fasilitas_umum }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_sawah }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_tegalan }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_perkebunan }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_peternakan_perikanan }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hutan_belukar }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_hutan_lebat }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_tanah_kosong }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->luas_tanah_lain }}m<sup>2</sup></td>
                <td class="border px-4">{{ $item->mutasi }}</td>
                <td class= "border px-4">{{ $item->keterangan }}</td>
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
