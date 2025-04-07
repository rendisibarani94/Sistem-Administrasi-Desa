<div>
    <x-slot:judul>
        Tambah Aparatur Desa
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Aparatur Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-semibold text-gray-950">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" wire:model.live="nama_lengkap" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_lengkap') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Lengkap Aparatur" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_lengkap') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="nip" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Induk Pegawai Negeri Sipil (NIP) <span class="text-xs text-gray-950 font-light">*Aparatur PNS</span></label>
                    <input type="text" id="nip" wire:model.live="nip" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nip') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nomor Induk Pegawai Negeri Sipil" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nip') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="nipd" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Induk Perangkat Desa (NIPD) <span class="text-xs text-gray-950 font-light">*Aparatur Non PNS</span></label>
                    <input type="text" id="nipd" wire:model.live="nipd" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nipd') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nomor Induk Perangkat Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('nipd') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Kelamin</label>
                    <select id="jenis_kelamin" wire:model.live="jenis_kelamin" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('jenis_kelamin') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="h-0.25">
                        @error('jenis_kelamin') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="pendidikan" class="block mb-2 text-sm font-semibold text-gray-950">Pendidikan Terakhir</label>
                    <select id="pendidikan" wire:model.live="pendidikan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pendidikan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
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
                    <label for="agama" class="block mb-2 text-sm font-semibold text-gray-950">Agama</label>
                    <select id="agama" wire:model.live="agama" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('agama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Agama</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KHATOLIK">KHATOLIK</option>
                        <option value="HINDU">HINDU</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="KHONGHUCU">KHONGHUCU</option>
                        <option value="KEPERCAYAAN KEPADA TUHAN YME LAINNYA">KEPERCAYAAN KEPADA TUHAN YME LAINNYA</option>
                    </select>
                    <div class="h-0.25">
                        @error('agama') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-1">
                    <label for="tempat_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" wire:model.live="tempat_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tempat Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tempat_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-1">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" wire:model.live="tanggal_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="input-component">
                        <label for="tanggal_pengangkatan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Pengangkatan </label>
                        <input type="date" id="tanggal_pengangkatan" wire:model.live="tanggal_pengangkatan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_pengangkatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tanggal Pengangkatan Aparatur" autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_pengangkatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="jabatan" class="block mb-2 text-sm font-semibold text-gray-950">Jabatan</label>
                    <select id="jabatan" wire:model.live="jabatan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('jabatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Jabatan</option>
                        @foreach ($jabatanData as $data)
                        <option value="{{ $data->id_jabatan }}">{{ $data->jabatan }}</option>
                        @endforeach
                    </select>
                    <div class="h-0.25">
                        @error('jabatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="golongan" class="block mb-2 text-sm font-semibold text-gray-950">Golongan</label>
                    <select id="golongan" wire:model.live="golongan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('golongan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror">
                        <option selected>Pilih Golongan</option>
                        <option value="I">I - Juru</option>
                        <option value="Ia">Ia</option>
                        <option value="Ib">Ib</option>
                        <option value="Ic">Ic</option>
                        <option value="Id">Id</option>
                        <option value="II">II - Pengatur</option>
                        <option value="IIa">IIa</option>
                        <option value="IIb">IIb</option>
                        <option value="IIc">IIc</option>
                        <option value="IId">IId</option>
                        <option value="III">III - Penata</option>
                        <option value="IIIa">IIIa</option>
                        <option value="IIIb">IIIb</option>
                        <option value="IIIc">IIIc</option>
                        <option value="IIId">IIId</option>
                        <option value="IV">IV - Pembina</option>
                        <option value="IVa">IVa</option>
                        <option value="IVb">IVb</option>
                        <option value="IVc">IVc</option>
                        <option value="IVd">IVd</option>
                        <option value="IVe">IVe</option>
                    </select>
                    <div class="h-0.25">
                        @error('golongan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Keterangan Tambahan" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('AparaturDesa') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambahkan Aparatur Desa</button>
            </div>
        </form>
    </div>
</div>
