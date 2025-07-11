<div>
    <x-slot:judul>
        Edit Penduduk Sementara
    </x-slot:judul>


    <div class="bg-sky-600 my-4 border-2 border-gray-400 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Edit Penduduk Sementara</h5>
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
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Kelamin</label>
                    <select id="jenis_kelamin" wire:model.live="jenis_kelamin" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('jenis_kelamin') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="h-0.25">
                        @error('jenis_kelamin') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-1">
                    <label for="tempat_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" wire:model.live="tempat_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tempat Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tempat_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" wire:model.live="tanggal_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="pekerjaan" class="block mb-2 text-sm font-semibold text-gray-950">Pekerjaan</label>
                        <select id="pekerjaan" wire:model.live="pekerjaan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Pekerjaan</option>
                            @foreach ($pekerjaanData as $pekerjaan)
                            <option value="{{ $pekerjaan->id_pekerjaan }}">{{ $pekerjaan->pekerjaan }}</option>
                            @endforeach
                        </select>
                        <div class="h-0.25">
                            @error('pekerjaan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">

                <div class="input-component">
                    <label for="kewarganegaraan" class="block mb-2 text-sm font-semibold text-gray-950">Kewarganegaraan</label>
                    <select id="kewarganegaraan" wire:model.live="kewarganegaraan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kewarganegaraan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option selected>Pilih Kewarganegaraan</option>
                        <option value="WNI">Warga Negara Indonesia</option>
                        <option value="WNA">Warga Negara Asing</option>
                    </select>
                    <div class="h-0.25">
                        @error('kewarganegaraan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="keturunan" class="block mb-2 text-sm font-semibold text-gray-950">Asal Keturunan</label>
                    <input type="text" id="keturunan" wire:model.live="keturunan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('keturunan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Negara Asal Keturunan (WNI untuk Indonesia)" autocomplete="off" />
                    <div class="h-0.25">
                        @error('keturunan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="asal" class="block mb-2 text-sm font-semibold text-gray-950">Asal Kedatangan</label>
                    <input type="text" id="asal" wire:model.live="asal" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('asal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat Asal Kedatangan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('asal') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tokoh_tujuan" class="block mb-2 text-sm font-semibold text-gray-950">Tokoh Tujuan Kedatangan</label>
                    <input type="text" id="tokoh_tujuan" wire:model.live="tokoh_tujuan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tokoh_tujuan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tokoh Tujuan Kedatangan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tokoh_tujuan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="alamat_tujuan" class="block mb-2 text-sm font-semibold text-gray-950">Alamat Tujuan Kedatangan</label>
                    <input type="text" id="alamat_tujuan" wire:model.live="alamat_tujuan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('alamat_tujuan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat Tujuan Kedatangan" autocomplete="off" />
                    <div class="h-0.25">
                        @error('alamat_tujuan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_kedatangan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Kedatangan</label>
                    <input type="date" id="tanggal_kedatangan" wire:model.live="tanggal_kedatangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_kedatangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Kedatangan " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_kedatangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_kepulangan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Kepulangan</label>
                    <input type="date" id="tanggal_kepulangan" wire:model.live="tanggal_kepulangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_kepulangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Kepulangan " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_kepulangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                </div>
                <div class="input-component">
                    <label for="maksud_kedatangan" class="block mb-2 text-sm font-semibold text-gray-950">Maksud Kedatangan</label>
                    <textarea id="maksud_kedatangan" wire:model.live="maksud_kedatangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('maksud_kedatangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Maksud Kedatangan" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('maksud_kedatangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
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
                <a href="{{ route('pendudukSementara') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Penduduk Sementara</button>
            </div>

        </form>
    </div>
</div>
