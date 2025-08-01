<div>
    <x-slot:judul>
        Tambah Surat Keluar Desa
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Agenda Surat Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label for="jenis_surat" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Surat Keluar</label>
                    <div class="flex">
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400 @error('jenis_surat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-sky-500 @enderror">
                                <input id="bordered-radio-1" name="jenis_surat" type="radio" value="Surat Masuk" wire:model.live="jenis_surat" class="w-4 h-4 text-sky-600 cursor-pointer bg-gray-100 focus:ring-sky-600 ring-offset-gray-800 focus:ring-2 border-gray-400 ">
                                <label for="bordered-radio-1" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Surat Masuk</label>
                            </div>
                        </div>
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400 @error('jenis_surat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-sky-500 @enderror">
                                <input id="bordered-radio-2" name="jenis_surat" type="radio" value="Surat Keluar" wire:model.live="jenis_surat" class="w-4 h-4 text-sky-600 cursor-pointer bg-gray-100 focus:ring-sky-600 ring-offset-gray-800 focus:ring-2 border-gray-400 ">
                                <label for="bordered-radio-2" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Surat Keluar</label>
                            </div>
                        </div>
                        <div class="input-component flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400 @error('jenis_surat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-sky-500 @enderror">
                                <input id="bordered-radio-3" name="jenis_surat" type="radio" value="Surat Ekspedisi" wire:model.live="jenis_surat" class="w-4 h-4 text-sky-600 cursor-pointer bg-gray-100 focus:ring-sky-600 ring-offset-gray-800 focus:ring-2 border-gray-400 ">
                                <label for="bordered-radio-3" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Surat Ekspedisi</label>
                            </div>
                        </div>
                    </div>
                    <div class="h-0.25">
                        @error('jenis_surat')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <label for="tanggal_pengiriman_penerimaan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Dikirim / Diterima</label>
                        <input type="date" id="tanggal_pengiriman_penerimaan" wire:model.live="tanggal_pengiriman_penerimaan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_pengiriman_penerimaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-sky-500 @enderror" autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_pengiriman_penerimaan')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <div class="input-component">
                        <label for="tanggal_surat" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" wire:model.live="tanggal_surat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_surat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:border-sky-500 @enderror" autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_surat')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="kode_surat" class="block mb-2 text-sm font-semibold text-gray-950">Kode Surat</label>
                    <input type="text" id="kode_surat" wire:model.live="kode_surat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('kode_surat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kode Surat" autocomplete="off" />
                    <div class="h-0.25">
                        @error('kode_surat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="pengirim_penerima" class="block mb-2 text-sm font-semibold text-gray-950">Pengirim / Tujuan Penerima Surat</label>
                    <input type="text" id="pengirim_penerima" wire:model.live="pengirim_penerima" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('pengirim_penerima') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Pengirim / Tujuan Penerima Surat" autocomplete="off" />
                    <div class="h-0.25">
                        @error('pengirim_penerima') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="isi_singkat" class="block mb-2 text-sm font-semibold text-gray-950">Isi Singkat Surat</label>
                    <textarea id="isi_singkat" wire:model.live="isi_singkat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('isi_singkat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Isi Singkat Surat" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('isi_singkat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('AgendaSuratDesa') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-sky-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-2 focus:outline-none focus:ring-sky-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Surat Keluar</button>
            </div>
        </form>
    </div>
</div>
