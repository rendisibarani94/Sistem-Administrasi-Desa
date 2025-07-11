<div>
    <x-slot:judul>
        Edit Inventaris Desa
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Edit Inventaris Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="update">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="jenis_inventaris" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Barang Tanah Kas Desa</label>
                    <input type="text" id="jenis_inventaris" wire:model.live="jenis_inventaris" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('jenis_inventaris') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Jenis Barang Tanah Kas Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('jenis_inventaris') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_desa" class="block mb-2 text-sm font-semibold text-gray-950">Inventaris Dibeli Desa</label>
                        <input type="number" id="oleh_desa" wire:model.live="oleh_desa" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_desa') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_desa') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_pemerintah" class="block mb-2 text-sm font-semibold text-gray-950">Inventaris Bantuan Pemerintah</label>
                        <input type="number" id="oleh_pemerintah" wire:model.live="oleh_pemerintah" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_pemerintah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_pemerintah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_provinsi" class="block mb-2 text-sm font-semibold text-gray-950">Inventaris Bantuan Provinsi</label>
                        <input type="number" id="oleh_provinsi" wire:model.live="oleh_provinsi" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_provinsi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_provinsi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_kabupaten" class="block mb-2 text-sm font-semibold text-gray-950">Inventaris Bantuan Kabupaten/Kota</label>
                        <input type="number" id="oleh_kabupaten" wire:model.live="oleh_kabupaten" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_kabupaten') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_kabupaten') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="oleh_sumbangan" class="block mb-2 text-sm font-semibold text-gray-950">Inventaris Bantuan Sumbangan</label>
                        <input type="number" id="oleh_sumbangan" wire:model.live="oleh_sumbangan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('oleh_sumbangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('oleh_sumbangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                        <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                        <div class="h-0.25">
                            @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <div class="relative">
                            <label for="jumlah_baik" class="block mb-2 text-sm font-semibold text-gray-950">Jumlah Inventaris Dalam Keadaan Baik</label>
                            <input type="number" id="jumlah_baik" wire:model.live="jumlah_baik" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('jumlah_baik') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                            <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                        </div>
                        <div class="h-0.25">
                            @error('jumlah_baik') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <div class="relative">
                            <label for="jumlah_rusak" class="block mb-2 text-sm font-semibold text-gray-950">Jumlah Inventaris Dalam Keadaan Rusak</label>
                            <input type="number" id="jumlah_rusak" wire:model.live="jumlah_rusak" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('jumlah_rusak') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                            <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                        </div>
                        <div class="h-0.25">
                            @error('jumlah_rusak') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('InventarisDesa') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-sky-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Inventaris Desa</button>
            </div>
        </form>
    </div>
</div>
