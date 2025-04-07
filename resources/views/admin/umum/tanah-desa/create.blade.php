<div>
    <x-slot:judul>
        Tambah Tanah Desa
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tanah Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="nama_pemegang_hak_tanah" class="block mb-2 text-sm font-semibold text-gray-950">Nama Perorangan Pemegang Hak Tanah</label>
                    <input type="text" id="nama_pemegang_hak_tanah" wire:model.live="nama_pemegang_hak_tanah" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_pemegang_hak_tanah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Perorangan Pemegang Hak Tanah" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_pemegang_hak_tanah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="nama_badan_hukum" class="block mb-2 text-sm font-semibold text-gray-950">Nama Badan Hukum Pemegang Hak Tanah</label>
                    <input type="text" id="nama_badan_hukum" wire:model.live="nama_badan_hukum" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_badan_hukum') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Badan Hukum Pemegang Hak Tanah" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_badan_hukum') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hm" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Milik</label>
                        <input type="number" id="luas_hm" wire:model.live="luas_hm" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hm') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hm') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hgb" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Guna Bangunan </label>
                        <input type="number" id="luas_hgb" wire:model.live="luas_hgb" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hgb') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hgb') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hp" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Pakai </label>
                        <input type="number" id="luas_hp" wire:model.live="luas_hp" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hp') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hp') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hgu" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Guna Usaha </label>
                        <input type="number" id="luas_hgu" wire:model.live="luas_hgu" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hgu') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hgu') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hpl" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Pengelolaan </label>
                        <input type="number" id="luas_hpl" wire:model.live="luas_hpl" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hpl') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hpl') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hpl" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Pengelolaan </label>
                        <input type="number" id="luas_hpl" wire:model.live="luas_hpl" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hpl') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hpl') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_ma" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Milik Adat </label>
                        <input type="number" id="luas_ma" wire:model.live="luas_ma" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_ma') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_ma') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_vi" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hak Verponding Indonesia </label>
                        <input type="number" id="luas_vi" wire:model.live="luas_vi" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_vi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_vi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_tn" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Negara </label>
                        <input type="number" id="luas_tn" wire:model.live="luas_tn" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_tn') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_tn') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_perumahan" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Perumahan</label>
                        <input type="number" id="luas_perumahan" wire:model.live="luas_perumahan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_perumahan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_perumahan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_perdagangan" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Perdagangan</label>
                        <input type="number" id="luas_perdagangan" wire:model.live="luas_perdagangan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_perdagangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_perdagangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_perkantoran" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Perkantoran</label>
                        <input type="number" id="luas_perkantoran" wire:model.live="luas_perkantoran" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_perkantoran') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_perkantoran') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_industri" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Usaha Industri</label>
                        <input type="number" id="luas_industri" wire:model.live="luas_industri" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_industri') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_industri') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_fasilitas_umum" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Fasilitas Umum</label>
                        <input type="number" id="luas_fasilitas_umum" wire:model.live="luas_fasilitas_umum" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_fasilitas_umum') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_fasilitas_umum') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_sawah" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Sawah</label>
                        <input type="number" id="luas_sawah" wire:model.live="luas_sawah" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_sawah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_sawah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_tegalan" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Tegalan</label>
                        <input type="number" id="luas_tegalan" wire:model.live="luas_tegalan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_tegalan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_tegalan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_perkebunan" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Perkebunan</label>
                        <input type="number" id="luas_perkebunan" wire:model.live="luas_perkebunan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_perkebunan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_perkebunan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_peternakan_perikanan" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Peternakan / Perikanan</label>
                        <input type="number" id="luas_peternakan_perikanan" wire:model.live="luas_peternakan_perikanan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_peternakan_perikanan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_peternakan_perikanan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hutan_belukar" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hutan Belukar</label>
                        <input type="number" id="luas_hutan_belukar" wire:model.live="luas_hutan_belukar" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hutan_belukar') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hutan_belukar') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_hutan_lebat" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Hutan Lebat / Lindung</label>
                        <input type="number" id="luas_hutan_lebat" wire:model.live="luas_hutan_lebat" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_hutan_lebat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_hutan_lebat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="mutasi" class="block mb-2 text-sm font-semibold text-gray-950">Mutasi Tanah</label>
                        <input type="text" id="mutasi" wire:model.live="mutasi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('mutasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Keterangan Mutasi Tanah" autocomplete="off" />
                        <div class="h-0.25">
                            @error('mutasi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_tanah_kosong" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Kosong</label>
                        <input type="number" id="luas_tanah_kosong" wire:model.live="luas_tanah_kosong" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_tanah_kosong') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_tanah_kosong') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="luas_tanah_lain" class="block mb-2 text-sm font-semibold text-gray-950">Tanah Lain-lain</label>
                        <input type="number" id="luas_tanah_lain" wire:model.live="luas_tanah_lain" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('luas_tanah_lain') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Luas" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">m<sup>2</sup></span>
                    </div>
                    <div class="h-0.25">
                        @error('luas_tanah_lain') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                        <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                        <div class="h-0.25">
                            @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('TanahDesa') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Tanah Desa</button>
            </div>
        </form>
    </div>
</div>