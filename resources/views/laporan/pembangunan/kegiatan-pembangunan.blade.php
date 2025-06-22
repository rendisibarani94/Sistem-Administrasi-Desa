@extends('Components.layouts.laporan')

@section('content')
<div class="m-20">
    <h1 class="font-semibold text-slate-700 text-xl text-center mb-10">Buku Rencana Kegiatan Pembangunan {{ $settings['nama_desa'] }}</h1>
    <table class="table-auto mx-auto border mb-4">
        <thead>
            <tr>
                <th class="border px-2" rowspan="2">Nomor Urut</th>
                <th class="border px-2" rowspan="2">NAMA PROYEK/KEGIATAN</th>
                <th class="border px-2" rowspan="2">VOLUME</th>
                <th class="border px-2" colspan="4">SUMBER BIAYA</th>
                <th class="border px-2" rowspan="2">JUMLAH</th>
                <th class="border px-2" rowspan="2">WAKTU</th>
                <th class="border px-2" colspan="2">SIFAT PROYEK</th>
                <th class="border px-2" rowspan="2">PELAKSANA</th>
                <th class="border px-2" rowspan="2">KETERANGAN</th>
            </tr>
            <tr>
                <th class="border px-2">PEMERINTAH</th>
                <th class="border px-2">PROVINSI</th>
                <th class="border px-2">KAB/KOTA</th>
                <th class="border px-2">SWADAYA</th>
                <th class="border px-2">BARU</th>
                <th class="border px-2">LANJUTAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembangunanData as $index => $item)
            <tr>
                <td class="border px-4 text-center">{{ $index + 1 }}</td>
                <td class="border px-4">{{ $item->nama_kegiatan }}</td>
                <td class="border px-4">-</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_pemerintah, 0, ',', '.') }},00</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_provinsi, 0, ',', '.') }},00</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_kabupaten_kota, 0, ',', '.') }},00</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_swadaya, 0, ',', '.') }},00</td>
                <td class="border px-4">Rp. {{ number_format($item->biaya_pemerintah + $item->biaya_provinsi + $item->biaya_kabupaten_kota + $item->biaya_swadaya, 0, ',', '.') }},00</td>
                {{-- <td class="border px-4">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->translatedFormat('d F Y')}}</td>  --}}
                <td class="border px-4">{{ $item->tanggal_mulai }} Sampai {{ $item->tanggal_selesai }}</td>
                <td class="border px-4">{{ $item->sifat_proyek === 'Baru' ? 'Baru' : '-' }}</td>
                <td class="border px-4">{{ $item->sifat_proyek === 'Lanjutan' ? 'Lanjutan' : '-' }}</td>
                <td class="border px-4">{{ $item->pelaksana }}</td>
                <td class="border px-4">{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mengetahui mx-60 flex justify-between ">
        <div class="p-10 text-center">
            <h5 class="font-semibold">MENGETAHUI</h5>
            <h5 class="mb-10 ">KEPALA DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $kepala_desa }}</h5>
        </div>
        <div class="p-10 text-center">
            {{-- <h5 class="text-center">.........., .........., ..........</h5> --}}
            <h5 class="font-semibold">{{ $date }}</h5>
            <h5 class="mb-10 ">SEKRETARIS DESA</h5>
            <h5 class="border-b-2 border-gray-900 pb-1 px-1">{{ $sekretaris }}</h5>
        </div>
    </div>
</div>
@endsection
