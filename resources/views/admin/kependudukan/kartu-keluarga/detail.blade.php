<div>
    <x-slot:judul>
        Create Kartu Keluarga
    </x-slot:judul>


    <div class="header-kk">
        <h1 class="text-5xl font-bold text-center mb-2 mt-6">
            {{-- {{ $kartuKeluargaData->nomor_kartu_keluarga }} --}}
            Kartu Keluarga
        </h1>
        <h1 class="text-2xl font-bold text-center mb-2">
            No. {{ $kartuKeluargaData->nomor_kartu_keluarga }}
        </h1>
    </div>

    <div class="headline-kk px-6 mb-4">
        <div class="parent grid gap-6 mb-6 md:grid-cols-2">
            <div class="child-1 grid gap-6 mb-6 md:grid-cols-2">
                <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-sm overflow-hidden">
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Nama Kepala Keluarga</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->nama_kepala_keluarga }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Alamat</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->alamat_kk }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">RT/RW</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->rt }}/{{ $kartuKeluargaData->rw }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Desa/Kelurahan</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->desa_kelurahan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="child-2 grid gap-6 mb-6 md:grid-cols-2">
                <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-sm overflow-hidden">
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Kecamatan</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->kecamatan }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Kabupaten/Kota</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->kabupaten_kota }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Kode Pos</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->kode_pos }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 whitespace-nowrap w-1/3">Provinsi</td>
                            <td class="py-3 px-6 text-gray-900 whitespace-nowrap">: {{ $kartuKeluargaData->provinsi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto shadow-md border border-gray-500">
        <table class="min-w-full bg-white text-sm border-collapse">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">No</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Nama Lengkap</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">NIK</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Kedudukan Keluarga</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Tempat Lahir</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Tanggal Lahir</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Agama</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Pendidikan</th>
                    <th class="py-3 px-4 text-left font-semibold border border-gray-500">Jenis Pekerjaan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($anggotaKeluarga as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 whitespace-nowrap border border-gray-500">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->nama_lengkap }}</td>
                    <td class="py-3 px-4 whitespace-nowrap border border-gray-500">{{ $item->nik }}</td>
                    <td class="py-3 px-4 whitespace-nowrap border border-gray-500">{{ $item->kedudukan_keluarga }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->jenis_kelamin }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->tempat_lahir }}</td>
                    <td class="py-3 px-4 whitespace-nowrap border border-gray-500">{{ $item->tanggal_lahir }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->agama }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->pendidikan_terakhir }}</td>
                    <td class="py-3 px-4 border border-gray-500">{{ $item->pekerjaan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between mt-8">
        <a href="{{ route('kartuKeluarga') }}" type="button" class="bg-gray-500 text-white px-4 py-2 font-semibold border border-gray-300 rounded cursor-pointer">
            Kembali
        </a>
    </div>

</div>
