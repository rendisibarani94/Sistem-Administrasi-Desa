<div>
    <x-slot:judul>
        Create Kartu Keluarga
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Kartu Keluarga</h5>
    </div>

    <div class="mx-6">
        <form id="signUpForm" class="p-12 shadow-md rounded-2xl bg-white mx-auto border-solid border-2 border-gray-100 mb-8" wire:submit.prevent="store">

            <!-- step indicators -->
            <div class="flex gap-3 mb-4 text-xs text-center">
                <span class="stepIndicator flex-1 pb-8 relative
                    {{ $currentStep >= 1 ? 'font-semibold text-gray-950' : '' }}
                    before:content-[''] before:absolute before:left-1/2 before:bottom-0 before:-translate-x-1/2 before:z-[9] before:w-5 before:h-5
                    before:rounded-full before:border-3 before:border-sky-100
                    {{ $currentStep >= 1 ? 'before:bg-sky-600' : 'before:bg-sky-100' }}
                    after:content-[''] after:absolute after:left-1/2 after:bottom-2 after:w-full after:h-1
                    {{ $currentStep >= 2 ? 'after:bg-sky-600' : 'after:bg-gray-200' }}
                    last:after:hidden">
                    Data Kartu Keluarga
                </span>
                <span class="stepIndicator flex-1 pb-8 relative
                    {{ $currentStep >= 2 ? 'font-semibold text-gray-950' : '' }}
                    before:content-[''] before:absolute before:left-1/2 before:bottom-0 before:-translate-x-1/2 before:z-[9] before:w-5 before:h-5
                    before:rounded-full before:border-3 before:border-sky-100
                    {{ $currentStep >= 2 ? 'before:bg-sky-600' : 'before:bg-sky-100' }}
                    after:content-[''] after:absolute after:left-1/2 after:bottom-2 after:w-full after:h-1
                    {{ $currentStep >= 3 ? 'after:bg-sky-600' : 'after:bg-gray-200' }}
                    last:after:hidden">
                    Data Kepala Keluarga
                </span>
            </div>
            <!-- end step indicators -->

            <!-- Form step one -->
            <div class="step {{ $currentStep != 1 ? 'hidden' : '' }}">
                {{-- Form Grid  --}}
                <div class="grid gap-6 mb-6 md:grid-cols-2">

                    <div class="input-component">
                        <label for="nomor_kartu_keluarga" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Kartu Keluarga</label>
                        <input type="text" id="nomor_kartu_keluarga" wire:model.live.debounce.500ms="nomor_kartu_keluarga" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nomor_kartu_keluarga') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nomor Kartu Keluarga " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nomor_kartu_keluarga') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <div class="input-component">
                        <label for="tanggal_keluar" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Keluar Kartu Keluarga</label>
                        <input type="date" id="tanggal_keluar" wire:model.live.debounce.500ms="tanggal_keluar" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tanggal_keluar') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Penambahan Penduduk " autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_keluar') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <label for="alamat_kk" class="block mb-2 text-sm font-semibold text-gray-950">Alamat</label>
                        <input type="text" id="alamat_kk" wire:model.live.debounce.500ms="alamat_kk" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('alamat_kk') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat " autocomplete="off" />
                        <div class="h-0.25">
                            @error('alamat_kk') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <label for="rt" class="block mb-2 text-sm font-semibold text-gray-950">RT</label>
                        <input type="text" id="rt" wire:model.live.debounce.500ms="rt" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('rt') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan RT " autocomplete="off" />
                        <div class="h-0.25">
                            @error('rt') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <label for="rw" class="block mb-2 text-sm font-semibold text-gray-950">RW</label>
                        <input type="text" id="rw" wire:model.live.debounce.500ms="rw" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('rw') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan RW " autocomplete="off" />
                        <div class="h-0.25">
                            @error('rw') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 grid-rows-1 gap-4">
                    <div class="col-span-2">
                        <label for="desa_kelurahan" class="block mb-2 text-sm font-semibold text-gray-950">Desa/Kelurahan</label>
                        <input type="text" id="desa_kelurahan" wire:model.live.debounce.500ms="desa_kelurahan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('desa_kelurahan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Desa/Kelurahan " autocomplete="off" />
                        <div class="h-0.25">
                            @error('desa_kelurahan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-2 col-start-3">
                        <label for="kecamatan" class="block mb-2 text-sm font-semibold text-gray-950">Kecamatan</label>
                        <input type="text" id="kecamatan" wire:model.live.debounce.500ms="kecamatan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kecamatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kecamatan " autocomplete="off" />
                        <div class="h-0.25">
                            @error('kecamatan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-2 col-start-5">
                        <label for="kode_pos" class="block mb-2 text-sm font-semibold text-gray-950">Kode Pos</label>
                        <input type="text" id="kode_pos" wire:model.live.debounce.500ms="kode_pos" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kode_pos') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kode Pos " autocomplete="off" />
                        <div class="h-0.25">
                            @error('kode_pos') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-3 col-start-7">
                        <label for="kabupaten_kota" class="block mb-2 text-sm font-semibold text-gray-950">Kabupaten/Kota</label>
                        <input type="text" id="kabupaten_kota" wire:model.live.debounce.500ms="kabupaten_kota" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kabupaten_kota') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Kabupaten/Kota " autocomplete="off" />
                        <div class="h-0.25">
                            @error('kabupaten_kota') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-3 col-start-10">
                        <label for="provinsi" class="block mb-2 text-sm font-semibold text-gray-950">Provinsi</label>
                        <input type="text" id="provinsi" wire:model.live.debounce.500ms="provinsi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('provinsi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Provinsi " autocomplete="off" />
                        <div class="h-0.25">
                            @error('provinsi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <div></div>
                    <button type="button" wire:click="nextStep" class="bg-sky-700 text-white px-4 py-2 rounded hover:bg-sky-800 cursor-pointer">
                        Data Kepala Keluarga
                    </button>
                </div>
            </div>

            <!-- Form step two -->
            <div class="step {{ $currentStep != 2 ? 'hidden' : '' }}">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="input-component">
                        <label for="nik" class="block mb-2 text-sm font-semibold text-gray-950">NIK</label>
                        <input type="text" id="nik" wire:model.live="nik" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nik') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan NIK " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nik') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
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
                    <div class="input-component">
                        <label for="nama_lengkap" class="block mb-2 text-sm font-semibold text-gray-950">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" wire:model.live="nama_lengkap" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nama_lengkap') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Lengkap " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nama_lengkap') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-950">Alamat</label>
                        <input type="text" id="alamat" wire:model.live="alamat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Alamat " autocomplete="off" />
                        <div class="h-0.25">
                            @error('alamat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="nama_ayah" class="block mb-2 text-sm font-semibold text-gray-950">Ayah</label>
                        <input type="text" id="nama_ayah" wire:model.live="nama_ayah" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nama_ayah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Ayah " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nama_ayah') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="nama_ibu" class="block mb-2 text-sm font-semibold text-gray-950">Ibu</label>
                        <input type="text" id="nama_ibu" wire:model.live="nama_ibu" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('nama_ibu') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nama Ibu " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nama_ibu') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <!-- Special 4-column grid for the last row with custom spans -->
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <label for="kedudukan_keluarga" class="block mb-2 text-sm font-semibold text-gray-950">Keududukan Keluarga</label>
                        <select id="kedudukan_keluarga" wire:model.live="kedudukan_keluarga" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('kedudukan_keluarga') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Keududukan Keluarga</option>
                            <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                            <option value="ISTRI">ISTRI</option>
                            <option value="ANAK">ANAK</option>
                            <option value="FAMILI LAIN">FAMILI LAIN</option>
                        </select>
                        <div class="h-0.25">
                            @error('kedudukan_keluarga') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <label for="tempat_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" wire:model.live="tempat_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tempat Lahir " autocomplete="off" />
                        <div class="h-0.25">
                            @error('tempat_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" wire:model.live="tanggal_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tanggal_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Lahir " autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="grid gap-6 mb-10 md:grid-cols-2">
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
                        <label for="nomor_akta_lahir" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Akte Kelahiran <span class="text-gray-500">*Jika Ada</span></label>
                        <input type="text" id="nomor_akta_lahir" wire:model.live="nomor_akta_lahir" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nomor_akta_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Nomor Akte Kelahiran" autocomplete="off" />
                        <div class="h-0.25">
                            @error('nomor_akta_lahir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="golongan_darah" class="block mb-2 text-sm font-semibold text-gray-950">Golongan Darah</label>
                        <select id="golongan_darah" wire:model.live="golongan_darah" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('golongan_darah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Golongan Darah</option>
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
                        <select id="agama" wire:model.live="agama" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('agama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
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
                    <div class="input-component">
                        <label for="tanggal_keluar_ktp" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Keluar E-KTP <span class="text-gray-500 font-light">*Jika Ada</span></label>
                        <input type="date" id="tanggal_keluar_ktp" wire:model.live="tanggal_keluar_ktp" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_keluar_ktp') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Keluar E-KTP <sup>*</sup>jika ada<sup>*</sup> " autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_keluar_ktp') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="keturunan" class="block mb-2 text-sm font-semibold text-gray-950">Negara Keturunan <span class="text-gray-500 font-light">*Jika Ada</span></label>
                        <input type="text" id="keturunan" wire:model.live="keturunan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('keturunan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Negara Asal Keturunan (WNI untuk Indonesia)" autocomplete="off" />
                        <div class="h-0.25">
                            @error('keturunan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="status_perkawinan" class="block mb-2 text-sm font-semibold text-gray-950">Status Perkawinan</label>
                        <select id="status_perkawinan" wire:model.live="status_perkawinan" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('status_perkawinan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Status Pernikahan</option>
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
                        <select id="pendidikan_terakhir" wire:model.live="pendidikan_terakhir" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('pendidikan_terakhir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
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
                            @error('pendidikan_terakhir') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="pekerjaan" class="block mb-2 text-sm font-semibold text-gray-950">Pekerjaan</label>
                        <input type="text" id="pekerjaan" wire:model.live="pekerjaan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Pekerjaan " autocomplete="off" />
                        <div class="h-0.25">
                            @error('pekerjaan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="baca_huruf" class="block mb-2 text-sm font-semibold text-gray-950">Kemampuan Baca Huruf</label>
                        <select id="baca_huruf" wire:model.live="baca_huruf" class="bg-gray-50 [&>option]:font-medium border font-medium text-gray-900 text-sm rounded-sm block w-full p-2.5 @error('baca_huruf') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Kemampuan Baca huruf</option>
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
                        <label for="dusun" class="block mb-2 text-sm font-semibold text-gray-950">Dusun</label>
                        <select id="dusun" wire:model.live="dusun" class="bg-gray-50 [&>option]:font-medium border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('dusun') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror">
                            <option selected>Pilih Dusun</option>
                            @foreach ($dusunData as $dusun)
                            <option value="{{ $dusun->id_dusun }}">{{ $dusun->dusun }}</option>
                            @endforeach
                        </select>
                        <div class="h-0.25">
                            @error('dusun') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="asal_penduduk" class="block mb-2 text-sm font-medium text-semibold-950">Asal Penduduk</label>
                        <input type="text" id="asal_penduduk" wire:model.live="asal_penduduk" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('asal_penduduk') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Asal Penduduk " autocomplete="off" />
                        <div class="h-0.25">
                            @error('asal_penduduk') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                        <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                        <div class="h-0.25">
                            @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="tanggal_penambahan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Penambahan Penduduk</label>
                        <input type="date" id="tanggal_penambahan" wire:model.live="tanggal_penambahan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tanggal_penambahan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Tanggal Penambahan Penduduk " autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_penambahan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" wire:click="previousStep" class="bg-gray-200 text-gray-700 px-4 py-2 border border-gray-300 rounded cursor-pointer">
                        Data Kartu Keluarga
                    </button>
                    <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded hover:bg-sky-800 cursor-pointer">
                        Tambahkan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
