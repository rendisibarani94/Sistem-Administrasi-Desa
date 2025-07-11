<div>
    <x-slot:judul>
        Edit Kartu Keluarga
    </x-slot:judul>

    <div class="bg-sky-600 my-4 border-2 border-gray-400 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Ubah Kartu Keluarga</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="update">
            {{-- Form Grid  --}}
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="nomor_kartu_keluarga" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Kartu Keluarga</label>
                    <input type="text" id="nomor_kartu_keluarga" wire:model.live.debounce.500ms="nomor_kartu_keluarga" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nomor_kartu_keluarga') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nomor Kartu Keluarga " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nomor_kartu_keluarga') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tanggal_keluar" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Keluar Kartu Keluarga</label>
                    <input type="date" id="tanggal_keluar" wire:model.live.debounce.500ms="tanggal_keluar" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tanggal_keluar') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Penambahan Penduduk " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_keluar') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label for="alamat_kk" class="block mb-2 text-sm font-semibold text-gray-950">Alamat</label>
                    <input type="text" id="alamat_kk" wire:model.live.debounce.500ms="alamat_kk" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('alamat_kk') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat " autocomplete="off" />
                    <div class="h-0.25">
                        @error('alamat_kk') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label for="rt" class="block mb-2 text-sm font-semibold text-gray-950">RT</label>
                    <input type="text" id="rt" wire:model.live.debounce.500ms="rt" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('rt') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan RT " autocomplete="off" />
                    <div class="h-0.25">
                        @error('rt') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label for="rw" class="block mb-2 text-sm font-semibold text-gray-950">RW</label>
                    <input type="text" id="rw" wire:model.live.debounce.500ms="rw" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('rw') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan RW " autocomplete="off" />
                    <div class="h-0.25">
                        @error('rw') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 grid-rows-1 gap-4">
                <div class="col-span-2">
                    <label for="desa_kelurahan" class="block mb-2 text-sm font-semibold text-gray-950">Desa/Kelurahan</label>
                    <input type="text" id="desa_kelurahan" wire:model.live.debounce.500ms="desa_kelurahan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('desa_kelurahan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Desa/Kelurahan " autocomplete="off" />
                    <div class="h-0.25">
                        @error('desa_kelurahan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-2 col-start-3">
                    <label for="kecamatan" class="block mb-2 text-sm font-semibold text-gray-950">Kecamatan</label>
                    <input type="text" id="kecamatan" wire:model.live.debounce.500ms="kecamatan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kecamatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kecamatan " autocomplete="off" />
                    <div class="h-0.25">
                        @error('kecamatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-2 col-start-5">
                    <label for="kode_pos" class="block mb-2 text-sm font-semibold text-gray-950">Kode Pos</label>
                    <input type="text" id="kode_pos" wire:model.live.debounce.500ms="kode_pos" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kode_pos') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kode Pos " autocomplete="off" />
                    <div class="h-0.25">
                        @error('kode_pos') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-3 col-start-7">
                    <label for="kabupaten_kota" class="block mb-2 text-sm font-semibold text-gray-950">Kabupaten/Kota</label>
                    <input type="text" id="kabupaten_kota" wire:model.live.debounce.500ms="kabupaten_kota" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kabupaten_kota') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kabupaten/Kota " autocomplete="off" />
                    <div class="h-0.25">
                        @error('kabupaten_kota') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-3 col-start-10">
                    <label for="provinsi" class="block mb-2 text-sm font-semibold text-gray-950">Provinsi</label>
                    <input type="text" id="provinsi" wire:model.live.debounce.500ms="provinsi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('provinsi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Provinsi " autocomplete="off" />
                    <div class="h-0.25">
                        @error('provinsi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('kartuKeluarga') }}" class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Kartu Keluarga</button>
            </div>
        </form>
    </div>
</div>
