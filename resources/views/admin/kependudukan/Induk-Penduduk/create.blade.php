{{-- resources/views/admin/kependudukan/Induk-Penduduk/create.blade.php --}}

<div>
    <x-slot:judul>
        Create Induk Penduduk
    </x-slot:judul>

    @php
        $inputClass = 'w-full rounded-md border px-3 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none ';
        $errorClass = 'border-red-500';
        $normalClass = 'border-gray-300';
    @endphp

    {{-- Header --}}
    <div class="mx-6 mt-5 rounded-md bg-sky-600 px-4 py-3 shadow">
        <h1 class="text-center text-xl font-semibold text-white">
            Formulir Tambah Induk Penduduk
        </h1>
    </div>

    <div class="mx-6 mt-8 mb-10">
        <form wire:submit.prevent="store" class="space-y-8">

            {{-- ================= DATA PRIBADI ================= --}}
            <div class="rounded-lg border bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-semibold text-gray-800">
                    Data Pribadi
                </h2>

                <div class="grid gap-6 md:grid-cols-2">

                    {{-- NIK --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">NIK</label>
                        <input type="text"
                            wire:model.live="nik"
                            placeholder="Masukkan NIK"
                            class="{{ $inputClass }} {{ $errors->has('nik') ? $errorClass : $normalClass }}">
                        @error('nik')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Nama Lengkap</label>
                        <input type="text"
                            wire:model.live="nama_lengkap"
                            placeholder="Masukkan Nama Lengkap"
                            class="{{ $inputClass }} {{ $errors->has('nama_lengkap') ? $errorClass : $normalClass }}">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Jenis Kelamin</label>
                        <select wire:model.live="jenis_kelamin"
                            class="{{ $inputClass }} {{ $errors->has('jenis_kelamin') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    {{-- Golongan Darah --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Golongan Darah</label>
                        <select wire:model.live="golongan_darah"
                            class="{{ $inputClass }} {{ $errors->has('golongan_darah') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Golongan Darah</option>
                            <option>A</option>
                            <option>B</option>
                            <option>AB</option>
                            <option>O</option>
                        </select>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Tempat Lahir</label>
                        <input type="text"
                            wire:model.live="tempat_lahir"
                            class="{{ $inputClass }} {{ $errors->has('tempat_lahir') ? $errorClass : $normalClass }}">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Tanggal Lahir</label>
                        <input type="date"
                            wire:model.live="tanggal_lahir"
                            class="{{ $inputClass }} {{ $errors->has('tanggal_lahir') ? $errorClass : $normalClass }}">
                    </div>

                    {{-- Agama --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Agama</label>
                        <select wire:model.live="agama"
                            class="{{ $inputClass }} {{ $errors->has('agama') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Agama</option>
                            <option>ISLAM</option>
                            <option>KRISTEN</option>
                            <option>KATOLIK</option>
                            <option>HINDU</option>
                            <option>BUDHA</option>
                        </select>
                    </div>

                    {{-- Kewarganegaraan --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Kewarganegaraan</label>
                        <select wire:model.live="kewarganegaraan"
                            class="{{ $inputClass }} {{ $errors->has('kewarganegaraan') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Kewarganegaraan</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- ================= DATA KELUARGA ================= --}}
            <div class="rounded-lg border bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-semibold text-gray-800">
                    Data Keluarga
                </h2>

                <div class="grid gap-6 md:grid-cols-2">

                    {{-- Kepala Keluarga --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Kartu Keluarga</label>
                        <select wire:model.live="id_kartu_keluarga"
                            class="{{ $inputClass }} {{ $errors->has('id_kartu_keluarga') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Kartu Keluarga</option>

                            @foreach($kkData as $data)
                                <option value="{{ $data->id_kartu_keluarga }}">
                                    {{ $data->nomor_kartu_keluarga }}
                                    @if($data->nama_lengkap)
                                        - {{ $data->nama_lengkap }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kedudukan --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Kedudukan Dalam Keluarga</label>
                        <select wire:model.live="kedudukan_keluarga"
                            class="{{ $inputClass }} {{ $errors->has('kedudukan_keluarga') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Kedudukan</option>
                            <option>KEPALA KELUARGA</option>
                            <option>ISTRI</option>
                            <option>ANAK</option>
                            <option>FAMILI LAIN</option>
                        </select>
                    </div>

                    {{-- Ayah --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Nama Ayah</label>
                        <input type="text"
                            wire:model.live="nama_ayah"
                            class="{{ $inputClass }} {{ $errors->has('nama_ayah') ? $errorClass : $normalClass }}">
                    </div>

                    {{-- Ibu --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Nama Ibu</label>
                        <input type="text"
                            wire:model.live="nama_ibu"
                            class="{{ $inputClass }} {{ $errors->has('nama_ibu') ? $errorClass : $normalClass }}">
                    </div>

                </div>
            </div>

            {{-- ================= ALAMAT ================= --}}
            <div class="rounded-lg border bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-semibold text-gray-800">
                    Alamat
                </h2>

                <div class="grid gap-6 md:grid-cols-2">

                    {{-- Alamat --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Alamat</label>
                        <input type="text"
                            wire:model.live="alamat"
                            class="{{ $inputClass }} {{ $errors->has('alamat') ? $errorClass : $normalClass }}">
                    </div>

                    {{-- Dusun --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Dusun</label>
                        <select wire:model.live="dusun"
                            class="{{ $inputClass }} {{ $errors->has('dusun') ? $errorClass : $normalClass }}">
                            <option value="">Pilih Dusun</option>

                            @foreach($dusunData as $dusun)
                                <option value="{{ $dusun->id_dusun }}">
                                    {{ $dusun->dusun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            {{-- ================= LAINNYA ================= --}}
            <div class="rounded-lg border bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-semibold text-gray-800">
                    Informasi Tambahan
                </h2>

                <div class="grid gap-6 md:grid-cols-2">

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Pekerjaan</label>
                        <input type="text"
                            wire:model.live="pekerjaan"
                            class="{{ $inputClass }} {{ $errors->has('pekerjaan') ? $errorClass : $normalClass }}">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Pendidikan Terakhir</label>
                        <input type="text"
                            wire:model.live="pendidikan_terakhir"
                            class="{{ $inputClass }} {{ $errors->has('pendidikan_terakhir') ? $errorClass : $normalClass }}">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Status Perkawinan</label>
                        <input type="text"
                            wire:model.live="status_perkawinan"
                            class="{{ $inputClass }} {{ $errors->has('status_perkawinan') ? $errorClass : $normalClass }}">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">Tanggal Penambahan</label>
                        <input type="date"
                            wire:model.live="tanggal_penambahan"
                            class="{{ $inputClass }} {{ $errors->has('tanggal_penambahan') ? $errorClass : $normalClass }}">
                    </div>

                </div>

                {{-- Keterangan --}}
                <div class="mt-6">
                    <label class="mb-2 block text-sm font-semibold">Keterangan</label>
                    <textarea rows="4"
                        wire:model.live="keterangan"
                        placeholder="Keterangan tambahan..."
                        class="{{ $inputClass }} {{ $errors->has('keterangan') ? $errorClass : $normalClass }}"></textarea>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-between gap-4 pt-2">

                <a href="{{ route('indukPenduduk') }}"
                    class="rounded-md bg-gray-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-gray-600">
                    Kembali
                </a>

                <button type="submit"
                    class="rounded-md bg-sky-700 px-6 py-2.5 text-sm font-medium text-white hover:bg-sky-800">
                    Tambah Penduduk
                </button>

            </div>

        </form>
    </div>
</div>