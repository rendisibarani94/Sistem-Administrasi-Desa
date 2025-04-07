<div>
    <x-slot:judul>
        Tambah Tanah Kas Desa
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Tanah Kas Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="asal_tkd" class="block mb-2 text-sm font-semibold text-gray-950">Asal Tanah Kas Desa</label>
                        <input type="text" id="asal_tkd" wire:model.live="asal_tkd" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('asal_tkd') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Asal Tanah Kas Desa" autocomplete="off" />
                        <div class="h-0.25">
                            @error('asal_tkd') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <label for="letter_c" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Letter C Tanah</label>
                        <input type="text" id="letter_c" wire:model.live="letter_c" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('letter_c') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nomor Letter C Tanah" autocomplete="off" />
                        <div class="h-0.25">
                            @error('letter_c') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <label for="persil" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Persil Tanah</label>
                        <input type="text" id="persil" wire:model.live="persil" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('persil') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nomor Persil Tanah" autocomplete="off" />
                        <div class="h-0.25">
                            @error('persil') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="kelas" class="block mb-2 text-sm font-semibold text-gray-950">Kelas Tanah Desa</label>
                    <select id="kelas" wire:model.live="kelas" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Kelas Tanah</option>
                        @foreach ($kelasTanahData as $kelas)
                        <option value="{{ $kelas->id_kelas_tanah }}">{{ $kelas->kelas_tanah }}</option>
                        @endforeach
                    </select>
                    <div class="h-0.25">
                        @error('kelas') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_perolehan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Perolehan Tanah Kas Daerah</label>
                    <input type="date" id="tanggal_perolehan" wire:model.live="tanggal_perolehan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_perolehan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_perolehan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="lokasi" class="block mb-2 text-sm font-semibold text-gray-950">Lokasi Tanah Kas Desa</label>
                    <input type="text" id="lokasi" wire:model.live="lokasi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('lokasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Lokasi Tanah Kas Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('lokasi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="peruntukan" class="block mb-2 text-sm font-semibold text-gray-950">Peruntukan Tanah Kas Desa</label>
                    <input type="text" id="peruntukan" wire:model.live="peruntukan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('peruntukan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Peruntukan Tanah Kas Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('peruntukan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                <!-- Input 1: Asli Desa -->
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_desa" class="block mb-2 text-sm font-semibold text-gray-950">Luas TKD Asli Desa</label>
                        <input type="number" id="oleh_desa" wire:model.live="oleh_desa" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_desa') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_desa') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 2: Pemerintah -->
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_pemerintah" class="block mb-2 text-sm font-semibold text-gray-950">Luas TKD Asal Pemerintah</label>
                        <input type="number" id="oleh_pemerintah" wire:model.live="oleh_pemerintah" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_pemerintah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_pemerintah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 3: Provinsi -->
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_provinsi" class="block mb-2 text-sm font-semibold text-gray-950">Luas TKD Asal Provinsi</label>
                        <input type="number" id="oleh_provinsi" wire:model.live="oleh_provinsi" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_provinsi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_provinsi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 4: Kabupaten -->
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_kabupaten" class="block mb-2 text-sm font-semibold text-gray-950">Luas TKD Asal Kabupaten</label>
                        <input type="number" id="oleh_kabupaten" wire:model.live="oleh_kabupaten" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_kabupaten') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_kabupaten') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 5: Lainnya -->
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_lain_lain" class="block mb-2 text-sm font-semibold text-gray-950">Luas TKD Asal Lainnya</label>
                        <input type="number" id="oleh_lain_lain" wire:model.live="oleh_lain_lain" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_lain_lain') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_lain_lain') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 6: Sawah -->
                <div class="input-component">
                    <div class="relative">
                        <label for="sawah" class="block mb-2 text-sm font-semibold text-gray-950">Sawah</label>
                        <input type="number" id="sawah" wire:model.live="sawah" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('sawah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('sawah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 7: Tegal -->
                <div class="input-component">
                    <div class="relative">
                        <label for="tegal" class="block mb-2 text-sm font-semibold text-gray-950">Tegal</label>
                        <input type="number" id="tegal" wire:model.live="tegal" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tegal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('tegal') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 8: Kebun -->
                <div class="input-component">
                    <div class="relative">
                        <label for="kebun" class="block mb-2 text-sm font-semibold text-gray-950">Kebun</label>
                        <input type="number" id="kebun" wire:model.live="kebun" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('kebun') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('kebun') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 9: Tombak/Kolam -->
                <div class="input-component">
                    <div class="relative">
                        <label for="tombak" class="block mb-2 text-sm font-semibold text-gray-950">Tombak/Kolam</label>
                        <input type="number" id="tombak" wire:model.live="tombak" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tombak') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('tombak') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <!-- Input 10: Tanah Kering -->
                <div class="input-component">
                    <div class="relative">
                        <label for="tanah_kering" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Kering</label>
                        <input type="number" id="tanah_kering" wire:model.live="tanah_kering" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanah_kering') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('tanah_kering') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="patok" class="block mb-2 text-sm font-semibold text-gray-950">Luas Tanah Dengan Patok</label>
                        <input type="number" id="patok" wire:model.live="patok" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('patok') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('patok') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="tanpa_patok" class="block mb-2 text-sm font-semibold text-gray-950">Luas Tanah Tanpa Patok</label>
                        <input type="number" id="tanpa_patok" wire:model.live="tanpa_patok" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanpa_patok') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('tanpa_patok') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                        <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                        <div class="h-0.25">
                            @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <div class="relative">
                            <label for="papan_nama" class="block mb-2 text-sm font-semibold text-gray-950">Luas Tanah Dengan Papan Nama</label>
                            <input type="number" id="papan_nama" wire:model.live="papan_nama" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('papan_nama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                            <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                        </div>
                        <div class="h-0.25">
                            @error('papan_nama') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <div class="relative">
                            <label for="tanpa_papan_nama" class="block mb-2 text-sm font-semibold text-gray-950">Luas Tanah Tanpa Papan Nama</label>
                            <input type="number" id="tanpa_papan_nama" wire:model.live="tanpa_papan_nama" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanpa_papan_nama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                            <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                        </div>
                        <div class="h-0.25">
                            @error('tanpa_papan_nama') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="flex justify-between mt-6">
                <a href="{{ route('TanahKasDesa') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Tanah Kas Desa</button>
            </div>
        </form>
    </div>
</div>
