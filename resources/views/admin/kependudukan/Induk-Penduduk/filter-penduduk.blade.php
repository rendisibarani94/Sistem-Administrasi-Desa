<div>
    <x-slot:judul>
        Filter Penduduk
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Filter Data Penduduk</h1>
        </div>

        {{-- Nav Breadcrumbs --}}
        <div class="flex justify-between mx-4 ">
            <nav class="flex mr-30" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700 ">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <a href="{{ route('indukPenduduk') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700 ">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            Induk Penduduk
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Filter Data Penduduk</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Filter Form Section --}}
        <div class="border-2 border-gray-300 rounded-sm my-6 p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-5 gap-y-5 my-4">
                <div class="input-component">
                    <label for="nik" class="block mb-2 text-sm font-semibold text-gray-950">NIK</label>
                    <input type="text" id="nik" wire:model.live.debounce.500ms="nik" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600" placeholder="Masukan NIK " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nik') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-semibold text-gray-950">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" wire:model.live.debounce.500ms="nama_lengkap" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600" placeholder="Masukan Nama Lengkap " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_lengkap') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-950">Jenis Kelamin</label>
                    <select id="jenis_kelamin" wire:model.live.debounce.500ms="jenis_kelamin" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('jenis_kelamin') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="h-0.25">
                        @error('jenis_kelamin') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-950">Alamat</label>
                    <input type="text" id="alamat" wire:model.live.debounce.500ms="alamat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat " autocomplete="off" />
                    <div class="h-0.25">
                        @error('alamat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="nama_ayah" class="block mb-2 text-sm font-semibold text-gray-950">Ayah</label>
                    <input type="text" id="nama_ayah" wire:model.live.debounce.500ms="nama_ayah" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_ayah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Ayah " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_ayah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="nama_ibu" class="block mb-2 text-sm font-semibold text-gray-950">Ibu</label>
                    <input type="text" id="nama_ibu" wire:model.live.debounce.500ms="nama_ibu" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_ibu') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Ibu " autocomplete="off" />
                    <div class="h-0.25">
                        @error('nama_ibu') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tempat_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" wire:model.live.debounce.500ms="tempat_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tempat Lahir " autocomplete="off" />
                    <div class="h-0.25">
                        @error('tempat_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-multi-component">
                    <label for="" class="block mb-2 text-sm font-semibold text-gray-950">Rentang Usia</label>
                    <div class="flex space-x-2">
                        <div class="md:col-span-1">
                            <input type="date" id="tanggal_lahir_awal" wire:model.live.debounce.500ms.live="tanggal_lahir_awal" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_lahir_awal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                            <div class="h-0.25">
                                @error('tanggal_lahir_awal') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                            </div>
                        </div>
                        <div class="md:col-span-1">
                            <input type="date" id="tanggal_lahir_akhir" wire:model.live.debounce.500ms.live="tanggal_lahir_akhir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_lahir_akhir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                            <div class="h-0.25">
                                @error('tanggal_lahir_akhir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-component">
                    <label for="kewarganegaraan" class="block mb-2 text-sm font-semibold text-gray-950">Kewarganegaraan</label>
                    <select id="kewarganegaraan" wire:model.live.debounce.500ms="kewarganegaraan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kewarganegaraan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Kewarganegaraan</option>
                        <option value="WNI">Warga Negara Indonesia</option>
                        <option value="WNA">Warga Negara Asing</option>
                    </select>
                    <div class="h-0.25">
                        @error('kewarganegaraan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="golongan_darah" class="block mb-2 text-sm font-semibold text-gray-950">Golongan Darah</label>
                    <select id="golongan_darah" wire:model.live.debounce.500ms="golongan_darah" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('golongan_darah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B">B</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB">AB</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O">O</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <div class="h-0.25">
                        @error('golongan_darah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="agama" class="block mb-2 text-sm font-semibold text-gray-950">Agama</label>
                    <select id="agama" wire:model.live.debounce.500ms="agama" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('agama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Agama</option>
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
                <div class="input-component">
                    <label for="status_perkawinan" class="block mb-2 text-sm font-semibold text-gray-950">Status Perkawinan</label>
                    <select id="status_perkawinan" wire:model.live.debounce.500ms="status_perkawinan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('status_perkawinan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Status Pernikahan</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin Tercatat">Kawin Tercatat</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                    <div class="h-0.25">
                        @error('status_perkawinan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="pendidikan_terakhir" class="block mb-2 text-sm font-semibold text-gray-950">Pendidikan Terakhir</label>
                    <select id="pendidikan_terakhir" wire:model.live.debounce.500ms="pendidikan_terakhir" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pendidikan_terakhir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Pendidikan Terakhir</option>
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
                        @error('pendidikan_terakhir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="pekerjaan" class="block mb-2 text-sm font-semibold text-gray-950">Pekerjaan</label>
                    <input type="text" id="pekerjaan" wire:model.live.debounce.500ms="pekerjaan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Pekerjaan " autocomplete="off" />
                    <div class="h-0.25">
                        @error('pekerjaan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="baca_huruf" class="block mb-2 text-sm font-semibold text-gray-950">Kemampuan Baca Huruf</label>
                    <select id="baca_huruf" wire:model.live.debounce.500ms="baca_huruf" class="bg-gray-50 [&>option]:font-medium border font-medium text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('baca_huruf') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Kemampuan Baca huruf</option>
                        <option value="I">Indonesia</option>
                        <option value="D">Daerah</option>
                        <option value="A">Arab</option>
                        <option value="L">Latin</option>
                    </select>
                    <div class="h-0.25">
                        @error('baca_huruf') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="kedudukan_keluarga" class="block mb-2 text-sm font-semibold text-gray-950">Keududukan Keluarga</label>
                    <select id="kedudukan_keluarga" wire:model.live.debounce.500ms="kedudukan_keluarga" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kedudukan_keluarga') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Keududukan Keluarga</option>
                        <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                        <option value="ISTRI">ISTRI</option>
                        <option value="ANAK">ANAK</option>
                        <option value="FAMILI LAIN">FAMILI LAIN</option>
                    </select>
                    <div class="h-0.25">
                        @error('kedudukan_keluarga') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="dusun" class="block mb-2 text-sm font-semibold text-gray-950">Dusun</label>
                    <select id="dusun" wire:model.live.debounce.500ms="dusun" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('dusun') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih Dusun</option>
                        @foreach ($dusunData as $dusun)
                        <option value="{{ $dusun->id_dusun }}">{{ $dusun->dusun }}</option>
                        @endforeach
                    </select>
                    <div class="h-0.25">
                        @error('dusun') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="asal_penduduk" class="block mb-2 text-sm font-medium text-semibold-950">Alamat Asal Penduduk <span class="text-gray-500">*Jika Pindahan</span></label>
                    <input type="text" id="asal_penduduk" wire:model.live.debounce.500ms="asal_penduduk" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('asal_penduduk') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Asal Penduduk " autocomplete="off" />
                    <div class="h-0.25">
                        @error('asal_penduduk') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="suku" class="block mb-2 text-sm font-medium text-semibold-950">Asal Suku Penduduk</label>
                    <input type="text" id="suku" wire:model.live.debounce.500ms="suku" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('suku') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Asal Suku Penduduk " autocomplete="off" />
                    <div class="h-0.25">
                        @error('suku') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="status_penduduk" class="block mb-2 text-sm font-semibold text-gray-950">Status penduduk</label>
                    <select id="status_penduduk" wire:model.live.debounce.500ms="status_penduduk" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('status_penduduk') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                        <option value="" selected>Pilih status penduduk</option>
                        <option value="aktif">Aktif</option>
                        <option value="pindah">Pindah</option>
                        <option value="meninggal">Meninggal</option>
                    </select>
                    <div class="h-0.25">
                        @error('status_penduduk') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
        <div class="button mt-8 flex space-x-4">
            <a wire:click="resetFilters" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">
                Reset Filter
            </a>
            <a wire:click="exportToExcel" class="text-white text-center bg-green-600 hover:bg-green-700 focus:ring-2 focus:outline-none focus:ring-green-500 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                    </svg>
                    <span>Export Excel</span>
                </div>
            </a>
        </div>

        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 mb-6 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed" id="dataTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Status Kedudukan Keluarga
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($pendudukData as $index => $item)
                    <tr class="page-row bg-white hover:bg-gray-300 transition duration-200 border-b-2 border-gray-300 @if($loop->index >= 10) hidden @endif" data-index="{{ $index }}">
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nik }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->alamat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->kedudukan_keluarga }}
                        </td>
                        <td class="px-6 py-4 font-semibold flex space-x-4 justify-center">
                            <!-- Edit Button -->
                            <a href="{{ route('indukPenduduk.edit', $item->id_penduduk) }}" class="text-green-600 hover:text-green-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
                            </a>

                            <!-- Edit Button -->
                            <a wire:click="mutasi({{ $item->id_penduduk }})" class="text-orange-500 hover:text-orange-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg class="w-6 h-6 text-orange-500 hover:text-orange-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-6 pt-1">
                                    <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd" />
                                </svg>

                                <span>Mutasi</span>
                            </a>

                            <!-- Delete Button -->
                            <a wire:click="confirmDelete({{ $item->id_penduduk }})" type="button" class="text-red-600 hover:text-red-900 font-medium transition duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pendudukData->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle the confirmation dialog
        @this.on('swal:confirm', (parameters) => {
            Swal.fire({
                title: parameters[0].title
                , text: parameters[0].text
                , icon: parameters[0].icon
                , showCancelButton: true
                , confirmButtonColor: '#d33'
                , cancelButtonColor: '#3085d6'
                , confirmButtonText: parameters[0].confirmButtonText
                , cancelButtonText: parameters[0].cancelButtonText
                , reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.delete();
                }
            });
        });

        // Handle the success message with custom GIF
        @this.on('swal:success', (parameters) => {
            Swal.fire({
                title: parameters[0].title
                , text: parameters[0].text
                , imageUrl: "{{ asset('vendor/sweetalert/success/sukses.gif') }}"
                , imageWidth: 250
                , imageHeight: 250
                , imageAlt: 'Custom GIF'
                , confirmButtonText: 'OK'
                , confirmButtonColor: '#0f766e'
            });
        });
    });

</script>
@endpush
