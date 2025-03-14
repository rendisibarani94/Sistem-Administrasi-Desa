<div>
    <x-slot:judul>
        Create Induk Penduduk
    </x-slot:judul>

    <div class="bg-teal-700 my-4 border-2 border-gray-400 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Form Tambah Induk Penduduk</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-950">NIK</label>
                    <input type="text" id="nik" wire:model.live="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="NIK"  autocomplete="off" />
                    @error('nik') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-950">Jenis Kelamin</label>
                    <select id="jenis_kelamin" wire:model.live="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-950">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" wire:model.live="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="John"  autocomplete="off" />
                    @error('nama_lengkap') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-950">Alamat</label>
                    <input type="text" id="alamat" wire:model.live="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Alamat"  autocomplete="off" />
                    @error('alamat') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>

            </div>
            <!-- Special 4-column grid for the last row with custom spans -->
            <div class="grid gap-6 mb-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label for="nomor_kk" class="block mb-2 text-sm font-medium text-gray-950">Nomor Kartu Keluarga</label>
                    <input type="text" id="nomor_kk" wire:model.live="nomor_kk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nomor Kartu Keluarga"  autocomplete="off" />
                    @error('nomor_kk') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div class="md:col-span-1">
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-950">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" wire:model.live="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tempat Lahir"  autocomplete="off" />
                    @error('tempat_lahir') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div class="md:col-span-1">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-950">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" wire:model.live="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal Lahir"  autocomplete="off" />
                    @error('tanggal_lahir') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="golongan_darah" class="block mb-2 text-sm font-medium text-gray-950">Golongan Darah</label>
                    <select id="golongan_darah" wire:model.live="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                    @error('golongan_darah') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-950">Agama</label>
                    <select id="agama" wire:model.live="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Agama</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KHATOLIK">KHATOLIK</option>
                        <option value="HINDU">HINDU</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="KHONGHUCU">KHONGHUCU</option>
                        <option value="KEPERCAYAAN KEPADA TUHAN YME LAINNYA">KEPERCAYAAN KEPADA TUHAN YME LAINNYA</option>
                    </select>
                    @error('agama') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="status_perkawinan" class="block mb-2 text-sm font-medium text-gray-950">Status Perkawinan</label>
                    <select id="status_perkawinan" wire:model.live="status_perkawinan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Status Pernikahan</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin Tercatat">Kawin Tercatat</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                    @error('status_perkawinan') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="pendidikan_terakhir" class="block mb-2 text-sm font-medium text-gray-950">Pendidikan Terkahir</label>
                    <select id="pendidikan_terakhir" wire:model.live="pendidikan_terakhir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Pendidikan Terkahir</option>
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
                    @error('pendidikan_terakhir') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="pekerjaan" class="block mb-2 text-sm font-medium text-gray-950">Pekerjaan</label>
                    <select id="pekerjaan" wire:model.live="pekerjaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Pekerjaan</option>
                        @foreach ($pekerjaanData as $pekerjaan)
                        <option value="{{ $pekerjaan->id_pekerjaan }}">{{ $pekerjaan->pekerjaan }}</option>
                        @endforeach
                    </select>
                    @error('pekerjaan') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="baca_huruf" class="block mb-2 text-sm font-medium text-gray-950">Kemampuan Baca Huruf</label>
                    <select id="baca_huruf" wire:model.live="baca_huruf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Kemampuan Baca huruf</option>
                        <option value="I">Indonesia</option>
                        <option value="D">Daerah</option>
                        <option value="A">Arab</option>
                        <option value="L">Latin</option>
                    </select>
                    @error('baca_huruf') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="kedudukan_keluarga" class="block mb-2 text-sm font-medium text-gray-950">Keududukan Keluarga</label>
                    <select id="kedudukan_keluarga" wire:model.live="kedudukan_keluarga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Keududukan Keluarga</option>
                        <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                        <option value="ISTRI">ISTRI</option>
                        <option value="ANAK">ANAK</option>
                        <option value="FAMILI LAIN">FAMILI LAIN</option>
                    </select>
                    @error('kedudukan_keluarga') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="dusun" class="block mb-2 text-sm font-medium text-gray-950">Dusun</label>
                    <select id="dusun" wire:model.live="dusun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih Dusun</option>
                        @foreach ($dusunData as $dusun)
                        <option value="{{ $dusun->id_dusun }}">{{ $dusun->dusun }}</option>
                        @endforeach
                    </select>
                    @error('dusun') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="asal_penduduk" class="block mb-2 text-sm font-medium text-gray-950">Asal Penduduk</label>
                    <input type="text" id="asal_penduduk" wire:model.live="asal_penduduk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Asal Penduduk"  autocomplete="off" />
                    @error('asal_penduduk') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
                <div>
                    <label for="tanggal_penambahan" class="block mb-2 text-sm font-medium text-gray-950">Tanggal Penambahan Penduduk</label>
                    <input type="date" id="tanggal_penambahan" wire:model.live="tanggal_penambahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal Penambahan Penduduk"  autocomplete="off" />
                    @error('tanggal_penambahan') <span class="errorMsg text-red-500 text-sm ml-3 italic">{{ "*".$message }}</span> @enderror
                </div>
            </div>
            
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambahkan Penduduk</button>
        </form>
    </div>

</div>

{{-- @push('scripts')
<script>
    document.addEventListener("livewire:load", () => {
        Livewire.hook('message.processed', (message, component) => {
            // Look for the first error message element
            const firstError = document.querySelector('.errorMsg');
            if (firstError) {
                // Scroll the first error into view smoothly
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Optionally, focus the associated input element
                const input = firstError.previousElementSibling;
                if (input && input.focus) {
                    input.focus();
                }
            }
        });
    });
</script>
@endpush --}}
