<div>
    <x-slot:judul>
        Penduduk Pindah / Mutasi
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Pindah / Mutasi Penduduk </h5>
    </div>

    <div class="mx-6 mt-8">
        <form action="">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="tanggal_pengurangan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Pengurangan</label>
                    <input type="date" id="tanggal_pengurangan" wire:model.live="tanggal_pengurangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_pengurangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_pengurangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tujuan_pindah" class="block mb-2 text-sm font-semibold text-gray-950">Tujuan Pindah</label>
                    <input type="text" id="tujuan_pindah" wire:model.live="tujuan_pindah" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tujuan_pindah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tujuan Pindah " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tujuan_pindah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Keterangan Tambahan (apabila ada)" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tempat_meninggal" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Meningal <span class="text-xs font-semibold text-gray-500">*Apabila Meninggal</span></label>
                    <input type="text" id="tempat_meninggal" wire:model.live="tempat_meninggal" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tempat_meninggal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tempat Meningal " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tempat_meninggal') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>