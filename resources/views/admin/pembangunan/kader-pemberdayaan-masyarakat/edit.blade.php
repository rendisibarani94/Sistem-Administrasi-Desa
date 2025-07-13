<div>
    <x-slot:judul>
        Edit Surat Keluar Desa
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Kader Kader Pemberdayaan Masyarakat</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="update">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-semibold text-gray-950">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" wire:model.live="nama_lengkap" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_lengkap') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Lengkap " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_lengkap') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" wire:model.live="tanggal_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Kelamin</label>
                    <div class="flex">
                        <div class="input-components flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-1" name="jenis_kelamin" type="radio" value="Laki-laki" wire:model.live="jenis_kelamin" class="w-4 h-4 text-sky-600 cursor-pointer bg-gray-100 focus:ring-sky-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-1" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Laki-laki</label>
                            </div>
                        </div>
                        <div class="input-components flex-1 mr-2 cursor-pointer">
                            <div class="flex items-center px-2.5 border cursor-pointer rounded-sm border-gray-400">
                                <input id="bordered-radio-2" name="jenis_kelamin" type="radio" value="Perempuan" wire:model.live="jenis_kelamin" class="w-4 h-4 text-sky-600 cursor-pointer bg-gray-100 focus:ring-sky-600 ring-offset-gray-800 focus:ring-2 border-gray-400">
                                <label for="bordered-radio-2" class="w-full py-2.5 ml-2 text-sm font-medium text-gray-900 cursor-pointer">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-component">
                    <label for="pendidikan" class="block mb-2 text-sm font-semibold text-gray-950">Pendidikan Terakhir</label>
                    <select id="pendidikan" wire:model.live="pendidikan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pendidikan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option selected>Pilih Pendidikan Terakhir</option>
                        <option value="TIDAK PERNAH SEKOLAH">TIDAK PERNAH SEKOLAH</option>
                        <option value="TK/KELOMPOK BERMAIN">TK/KELOMPOK BERMAIN</option>
                        <option value="SD/SEDERAJAT">SD/SEDERAJAT</option>
                        <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
                        <option value="D-1/SEDERAJAT">D-1/SEDERAJAT</option>
                        <option value="D-2/SEDERAJAT">D-2/SEDERAJAT</option>
                        <option value="D-3/SEDERAJAT">D-3/SEDERAJAT</option>
                        <option value="S-1/SEDERAJAT">S-1/SEDERAJAT</option>
                        <option value="S-2/SEDERAJAT">S-2/SEDERAJAT</option>
                        <option value="SLB /SEDERAJAT">SLB /SEDERAJAT</option>
                    </select>
                    <div class="h-0.25">
                        @error('pendidikan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
               <div class="input-component">
                    <label for="bidang_keahlian" class="block mb-2 text-sm font-semibold text-gray-950">Bidang Keahlian</label>
                    <input type="text" id="bidang_keahlian" wire:model.live="bidang_keahlian" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('bidang_keahlian') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Bidang Keahlian " autocomplete="off" />
                    <div class="h-0.25">
                        @error('bidang_keahlian') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-950">Alamat</label>
                    <input type="text" id="alamat" wire:model.live="alamat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat " autocomplete="off" />
                    <div class="h-0.25">
                        @error('alamat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
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
                <a href="{{ route('KaderPemberdayaanMasyarakat') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Data Kader</button>
            </div>
        </form>
    </div>
</div>
