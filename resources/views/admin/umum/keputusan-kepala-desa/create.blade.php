<div>
    <x-slot:judul>
        Tambah Keputusan Kepala Desa
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Keputusan Kepala Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="tanggal_keputusan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Keputusan Kepala Desa</label>
                    <input type="date" id="tanggal_keputusan " wire:model.live="tanggal_keputusan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_keputusan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Perihal Tentang Keputusan Kepala Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_keputusan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tentang" class="block mb-2 text-sm font-semibold text-gray-950">Perihal Keputusan Kepala Desa</label>
                    <input type="text" id="tentang" wire:model.live="tentang" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tentang') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Perihal Tentang Keputusan Kepala Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tentang') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_dilaporkan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Dilaporkan</label>
                    <input type="date" id="tanggal_dilaporkan" wire:model.live="tanggal_dilaporkan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_dilaporkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Perihal Tentang Keputusan Kepala Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_dilaporkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="tujuan_dilaporkan" class="block mb-2 text-sm font-semibold text-gray-950">Tujuan Pelaporan</label>
                    <input type="text" id="tujuan_dilaporkan" wire:model.live="tujuan_dilaporkan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tujuan_dilaporkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Instansi Tujuan Pelaporan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tujuan_dilaporkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="uraian" class="block mb-2 text-sm font-semibold text-gray-950">Uraian</label>
                    <textarea id="uraian" wire:model.live="uraian" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('uraian') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Uraian " autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('uraian') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Keterangan Tambahan (apabila ada)" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('keputusanKepalaDesa') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-2 focus:outline-none focus:ring-sky-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Keputusan Kepala Desa</button>
            </div>
        </form>
    </div>


</div>
