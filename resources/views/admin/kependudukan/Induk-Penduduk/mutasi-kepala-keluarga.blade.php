<div>
    <x-slot:judul>
        Penduduk Pindah / Mutasi
    </x-slot:judul>

    {{-- <h5 class="mb-5 font-bold text-xl">{{ $pendudukData->nama_lengkap }}</h5> --}}
    <div class="bg-sky-600 mt-4 mb-6 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Data Kepala Keluarga Pindah</h5>
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

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Pindah / Mutasi Penduduk </h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="pindah">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="tanggal_pengurangan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Pengurangan</label>
                    <input type="date" id="tanggal_pengurangan" wire:model.live="tanggal_pengurangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_pengurangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_pengurangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tujuan_pindah" class="block mb-2 text-sm font-semibold text-gray-950">Tujuan Pindah</label>
                    <input type="text" id="tujuan_pindah" wire:model.live="tujuan_pindah" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tujuan_pindah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tujuan Pindah " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tujuan_pindah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Keterangan Tambahan (apabila ada)" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tempat_meninggal" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Meningal <span class="text-xs font-semibold text-gray-500">*Apabila Meninggal</span></label>
                    <input type="text" id="tempat_meninggal" wire:model.live="tempat_meninggal" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tempat_meninggal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tempat Meningal " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tempat_meninggal') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
    </div>

            <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
                <h5 class="text-xl text-white font-semibold text-center">Formulir Mutasi Kartu Keluarga</h5>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="input-component">
                        <label for="newNomorKK" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Kartu Keluarga Baru</label>
                        <input type="text" id="newNomorKK" wire:model.live.debounce.500ms="newNomorKK" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('newNomorKK') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nomor Kartu Keluarga Baru" autocomplete="off" />
                        <div class="h-0.25">
                            @error('newNomorKK') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <div class="input-component">
                        <label for="newKepalaKeluarga" class="block mb-2 text-sm font-semibold text-gray-950">Kepala Keluarga Baru</label>
                        <select id="newKepalaKeluarga" wire:model.live="newKepalaKeluarga" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Kepala Keluarga Baru</option>
                            @foreach ($keluargaData as $keluarga)
                            <option value="{{ $keluarga->id_penduduk }}">{{ $keluarga->nama_lengkap }} | {{ $keluarga->kedudukan_keluarga }}</option>
                            @endforeach
                        </select>
                        <div class="h-0.25">
                            @error('newKepalaKeluarga') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('indukPenduduk') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-2 focus:outline-none focus:ring-orange-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Pindah Penduduk</button>
            </div>
        </form>

</div>
