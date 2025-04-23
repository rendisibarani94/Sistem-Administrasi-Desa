<div>
    <x-slot:judul>
        Edit Kegiatan Pembangunan
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Kegiatan Pembangunan</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="update">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="nama_kegiatan" class="block mb-2 text-sm font-semibold text-gray-950">Nama Kegiatan Pembangunan</label>
                    <input type="text" id="nama_kegiatan" wire:model.live="nama_kegiatan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_kegiatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Kegiatan Pembangunan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_kegiatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="pelaksana" class="block mb-2 text-sm font-semibold text-gray-950">Nama Pelaksana</label>
                    <input type="text" id="pelaksana" wire:model.live="pelaksana" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('pelaksana') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Pelaksana" autocomplete="off" />
                    <div class="h-0.25">
                        @error('pelaksana') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <x-rupiah-input label="Jumlah Dana Pemerintah" name="biaya_pemerintah" id="biaya_pemerintah" wireModel="biaya_pemerintah" />
                </div>
                <div class="input-component">
                    <x-rupiah-input label="Jumlah Dana Provinsi" name="biaya_provinsi" id="biaya_provinsi" wireModel="biaya_provinsi" />
                </div>
                <div class="input-component">
                    <x-rupiah-input label="Jumlah Dana Kabupaten/Kota" name="biaya_kabupaten_kota" id="biaya_kabupaten_kota" wireModel="biaya_kabupaten_kota" />
                </div>
                <div class="input-component">
                    <x-rupiah-input label="Jumlah Dana Swadaya" name="biaya_swadaya" id="biaya_swadaya" wireModel="biaya_swadaya" />
                </div>
                <div class="input-component">
                    <label for="lokasi" class="block mb-2 text-sm font-semibold text-gray-950">Lokasi Kegiatan</label>
                    <input type="text" id="lokasi" wire:model.live="lokasi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('lokasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Lokasi Kegiatan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('lokasi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <x-textarea-input label="Manfaat Kegiatan" name="manfaat" id="manfaat" wireModel="manfaat" placeholder="Manfaat Kegiatan" />
                </div>
                <div class="input-component">
                    <label for="tanggal_mulai" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Mulai Kegiatan</label>
                    <input type="date" id="tanggal_mulai" wire:model.live="tanggal_mulai" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_mulai') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-blue-500 @enderror" placeholder="Masukan Tanggal Mulai Kegiatan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_mulai')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_selesai" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Selesai Kegiatan</label>
                    <input type="date" id="tanggal_selesai" wire:model.live="tanggal_selesai" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_selesai') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-blue-500 @enderror" placeholder="Masukan Tanggal Selesai Kegiatan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_selesai')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="sifat_proyek" class="block mb-2 text-sm font-semibold text-gray-950">Sifat Proyek</label>
                    <div class="flex">
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-1" name="sifat_proyek" type="radio" value="Baru" wire:model.live="sifat_proyek" class="w-4 h-4 text-blue-600 cursor-pointer bg-gray-100 focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-1" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Baru</label>
                            </div>
                        </div>
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-2" name="sifat_proyek" type="radio" value="Lanjutan" wire:model.live="sifat_proyek" class="w-4 h-4 text-blue-600 cursor-pointer bg-gray-100 focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-2" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Lanjutan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-component">
                    <label for="Selesai" class="block mb-2 text-sm font-semibold text-gray-950">Status Proyek</label>
                    <div class="flex">
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-1" name="Selesai" type="radio" value="Belum Dimulai" wire:model.live="Selesai" class="w-4 h-4 text-blue-600 cursor-pointer bg-gray-100 focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-1" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Belum Dimulai</label>
                            </div>
                        </div>
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-2" name="Selesai" type="radio" value="Sedang Dikerjakan" wire:model.live="Selesai" class="w-4 h-4 text-blue-600 cursor-pointer bg-gray-100 focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-2" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Sedang Dikerjakan</label>
                            </div>
                        </div>
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-3" name="Selesai" type="radio" value="Selesai" wire:model.live="Selesai" class="w-4 h-4 text-blue-600 cursor-pointer bg-gray-100 focus:ring-blue-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-3" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Selesai</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-component">
                    <x-textarea-input label="Keterangan" name="keterangan" id="keterangan" wireModel="keterangan" placeholder="Keterangan Tambahan" />
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('Pembangunan') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Kegiatan</button>
            </div>
        </form>
    </div>
</div>
