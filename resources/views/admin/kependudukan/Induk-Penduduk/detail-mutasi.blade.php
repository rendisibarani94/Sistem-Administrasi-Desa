<div>
    <x-slot:judul>
        Penduduk Pindah / Mutasi
    </x-slot:judul>

    <div class="bg-sky-600 mt-4 mb-6 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Detail Penduduk Mutasi</h5>
    </div>

       <div class="px-8">
        <div class="border border-gray-400 rounded-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100 border-b border-gray-400">
                    <tr>
                        <th class="py-2 px-4 text-left font-semibold">Informasi</th>
                        <th class="py-2 px-4 text-left font-semibold">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Nama Lengkap</td>
                        <td class="py-2 px-4">{{ $pendudukData->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">NIK</td>
                        <td class="py-2 px-4">{{ $pendudukData->nik }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Nomor KK</td>
                        <td class="py-2 px-4">{{ $pendudukData->nomor_kartu_keluarga }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Jenis Kelamin</td>
                        <td class="py-2 px-4">{{ $pendudukData->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Tempat, Tanggal Lahir</td>
                        <td class="py-2 px-4">{{ $pendudukData->tempat_lahir.', ' }}{{ \Carbon\Carbon::parse($pendudukData->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Alamat</td>
                        <td class="py-2 px-4">{{ $pendudukData->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Nama Ayah</td>
                        <td class="py-2 px-4">{{ $pendudukData->nama_ayah}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Nama Ibu</td>
                        <td class="py-2 px-4">{{ $pendudukData->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Agama</td>
                        <td class="py-2 px-4">{{ $pendudukData->agama }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Pekerjaan</td>
                        <td class="py-2 px-4">{{ $pendudukData->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Status Perkawinan</td>
                        <td class="py-2 px-4">{{ $pendudukData->status_perkawinan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

                <div class="flex justify-between mt-6">
                <a href="{{ route('indukPenduduk.pindah') }}" class="text-white text-center bg-gray-500 hover:bg-gray-500 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
            </div>

</div>
