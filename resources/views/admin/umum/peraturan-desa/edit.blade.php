<div>
    <x-slot:judul>
        Edit Peraturan Desa
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Edit Peraturan Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="update">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="tentang" class="block mb-2 text-sm font-semibold text-gray-950">Perihal Peraturan Desa</label>
                    <input type="text" id="tentang" wire:model.live="tentang" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tentang') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Perihal Tentang Peraturan Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tentang') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="jenis_peraturan" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Peraturan</label>
                    <select id="jenis_peraturan" wire:model.live="jenis_peraturan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('jenis_peraturan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Jenis Peraturan</option>
                        <option value="Peraturan Desa">Peraturan Desa</option>
                        <option value="Peraturan Bersama">Peraturan Bersama</option>
                        <option value="Peraturan Kepala Desa">Peraturan Kepala Desa</option>
                    </select>
                    <div class="h-0.25">
                        @error('jenis_peraturan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_ditetapkan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Ditetapkan</label>
                    <input type="date" id="tanggal_ditetapkan" wire:model.live="tanggal_ditetapkan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_ditetapkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Perihal Tanggal Ditetapkan Peraturan Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_ditetapkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_kesepakatan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Kesepakatan</label>
                    <input type="date" id="tanggal_kesepakatan" wire:model.live="tanggal_kesepakatan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_kesepakatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_kesepakatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tujuan_dilaporkan" class="block mb-2 text-sm font-semibold text-gray-950">Tujuan Dilaporkan</label>
                    <input type="text" id="tujuan_dilaporkan" wire:model.live="tujuan_dilaporkan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tujuan_dilaporkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tujuan Peraturan Desa Dilaporkan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tujuan_dilaporkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_dilaporkan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Dilaporkan</label>
                    <input type="date" id="tanggal_dilaporkan" wire:model.live="tanggal_dilaporkan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_dilaporkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_dilaporkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="uraian_singkat" class="block mb-2 text-sm font-semibold text-gray-950">Uraian Singkat</label>
                    <textarea id="uraian_singkat" wire:model.live="uraian_singkat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('uraian_singkat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Uraian Singkat Peraturan Desa" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('uraian_singkat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_diundangkan_berita_desa" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Diundangkan Pada Lembaran & Berita Desa</label>
                    <input type="date" id="tanggal_diundangkan_berita_desa" wire:model.live="tanggal_diundangkan_berita_desa" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_diundangkan_berita_desa') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_diundangkan_berita_desa') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Keterangan Tambahan (apabila ada)" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('PeraturanDesa') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Peraturan Desa</button>
            </div>
        </form>
    </div>
</div>
