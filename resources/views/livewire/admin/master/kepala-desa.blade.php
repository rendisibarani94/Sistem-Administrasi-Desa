<div>
    <x-slot:judul>Master Kepala Desa</x-slot:judul>

    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Master Kepala Desa</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="flex justify-between mx-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-600">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            <span translate="no">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Data Master</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Kepala Desa</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="my-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="my-4 flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Toolbar --}}
        <div class="flex justify-between items-center my-6">
            <h2 class="text-xl font-bold text-gray-800">Daftar Kepala Desa</h2>
            <button wire:click="openCreateModal"
                class="inline-flex items-center gap-2 rounded-lg bg-sky-700 hover:bg-sky-800 px-4 py-2.5 text-sm font-semibold text-white transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kepala Desa
            </button>
        </div>

        {{-- Info Card --}}
        <div class="my-4 p-4 rounded-xl border border-sky-100 bg-sky-50 flex gap-3.5 items-start shadow-sm">
            <div class="p-2 rounded-lg bg-sky-100 text-sky-700 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-sky-900 text-sm">Informasi</h4>
                <p class="text-xs text-sky-800 mt-1 leading-relaxed">
                    Data kepala desa yang aktif digunakan sebagai penandatangan surat resmi desa. Setiap penambahan data kepala desa baru akan secara otomatis menonaktifkan data kepala desa sebelumnya.
                </p>
            </div>
        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Nama</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">NIP</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Tanda Tangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($list as $index => $kd)
                        <tr class="hover:bg-sky-50 transition duration-200">
                            <td class="px-6 py-4 text-center font-semibold text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-left">
                                <p class="font-bold text-gray-800">{{ $kd->nama }}</p>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-600 text-sm">{{ $kd->nip ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($kd->file_ttd)
                                    <a href="{{ asset('storage/' . $kd->file_ttd) }}" target="_blank"
                                        class="inline-block">
                                        <img src="{{ asset('storage/' . $kd->file_ttd) }}"
                                            alt="TTD"
                                            class="h-12 w-auto object-contain border rounded shadow-sm mx-auto"
                                            onerror="this.style.display='none'">
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs italic">Belum diupload</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($kd->is_active)
                                    <button wire:click="confirmNonAktif({{ $kd->id_kepala_desa }})"
                                        class="cursor-pointer inline-flex items-center gap-1 rounded-full bg-green-100 border border-green-200 px-2.5 py-1 text-xs font-semibold text-green-700 hover:bg-green-200 hover:text-green-800 transition-colors"
                                        title="Klik untuk menonaktifkan">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span>
                                        Aktif
                                    </button>
                                @else
                                    <button wire:click="confirmSetAktif({{ $kd->id_kepala_desa }})"
                                        class="cursor-pointer inline-flex items-center gap-1 rounded-full bg-red-50 border border-red-200 px-2.5 py-1 text-xs font-semibold text-red-700 hover:bg-red-100 hover:text-red-800 transition-colors"
                                        title="Klik untuk mengaktifkan">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                                        Non Aktif
                                    </button>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="openEditModal({{ $kd->id_kepala_desa }})"
                                        class="cursor-pointer rounded-lg bg-amber-500 hover:bg-amber-600 p-1.5 text-white transition-colors"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $kd->id_kepala_desa }})"
                                        class="cursor-pointer rounded-lg bg-red-500 hover:bg-red-600 p-1.5 text-white transition-colors"
                                        title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-semibold">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <p>Belum ada data kepala desa.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         MODAL TAMBAH / EDIT
    ══════════════════════════════════════════ --}}
    @if ($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/50 px-4 py-8"
        x-data x-on:keydown.escape.window="$wire.closeModal()">
        <div class="relative w-full max-w-lg rounded-2xl bg-white shadow-xl">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">
                    {{ $editingId ? 'Edit Kepala Desa' : 'Tambah Kepala Desa' }}
                </h2>
                <button wire:click="closeModal" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="px-6 py-5 space-y-4">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="nama" type="text" placeholder="Nama kepala desa"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 @error('nama') border-red-400 bg-red-50 @enderror" />
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NIP --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        NIP <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <input wire:model="nip" type="text" placeholder="Nomor Induk Pegawai"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 @error('nip') border-red-400 bg-red-50 @enderror" />
                    @error('nip')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload TTD --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Gambar Tanda Tangan <span class="text-gray-400 font-normal">(opsional, maks. 2MB)</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <label for="file_ttd" class="cursor-pointer inline-flex items-center gap-2 rounded-lg bg-sky-50 hover:bg-sky-100 px-4 py-2.5 text-sm font-semibold text-sky-700 transition-colors border border-sky-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                            Pilih Tanda Tangan
                        </label>
                        <span class="text-sm text-gray-500 pointer-events-none select-none">
                            @if($file_ttd) {{ $file_ttd->getClientOriginalName() }} @else Belum ada file dipilih @endif
                        </span>
                        <input id="file_ttd" wire:model="file_ttd" accept="image/*" style="display: none;" type="file">
                    </div>
                    @error('file_ttd')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    @if ($file_ttd)
                        <div class="mt-2">
                            <img src="{{ $file_ttd->temporaryUrl() }}" alt="Preview TTD" class="h-16 object-contain border rounded shadow-sm">
                        </div>
                    @endif
                </div>

                {{-- Status Aktif --}}
                @if ($editingId)
                    <div class="flex items-center gap-3">
                        <input wire:model="is_active" type="checkbox" id="is_active" class="rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Jadikan sebagai kepala desa aktif (penandatangan surat)</label>
                    </div>
                    @error('is_active')
                        <p class="text-xs text-red-600 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                            ⛔ {{ $message }}
                        </p>
                    @enderror
                    @if ($is_active)
                        <p class="text-xs text-blue-600 bg-blue-50 border border-blue-100 rounded-lg px-3 py-2">
                            ℹ️ Data pengajuan surat yang sudah diproses oleh kepala desa sebelumnya <strong>tidak akan berubah</strong> — historis tetap terhubung ke kepala desa yang memproses saat itu.
                        </p>
                    @else
                        <p class="text-xs text-amber-600 bg-amber-50 border border-amber-100 rounded-lg px-3 py-2">
                            ⚠️ Jika dinonaktifkan, pastikan ada kepala desa lain yang aktif agar surat desa tetap dapat diproses.
                        </p>
                    @endif
                @else
                    <div class="p-3 bg-sky-50 border border-sky-100 rounded-lg">
                        <p class="text-xs text-sky-850 font-medium">
                            💡 Data kepala desa baru yang ditambahkan akan otomatis diaktifkan sebagai penandatangan surat aktif. Kepala desa aktif saat ini akan dinonaktifkan secara otomatis.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 px-6 py-4">
                <button type="button" wire:click="closeModal"
                    class="rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 hover:text-red-800 transition-colors">
                    Batal
                </button>
                <button type="button" wire:click="simpan"
                    wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed"
                    class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-5 py-2 text-sm font-semibold text-white transition-colors shadow-sm">
                    <span wire:loading.remove wire:target="simpan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    <span wire:loading wire:target="simpan">
                        <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                    {{ $editingId ? 'Simpan Perubahan' : 'Tambah' }}
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- SweetAlert listeners --}}
    <script>
        // Konfirmasi Hapus
        window.addEventListener('swal:confirm', event => {
            const data = event.detail[0] ?? event.detail;
            Swal.fire({
                title: data.title ?? 'Konfirmasi',
                text: data.text ?? '',
                icon: data.icon ?? 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dc2626',
                confirmButtonText: data.confirmButtonText ?? 'Ya',
                cancelButtonText: data.cancelButtonText ?? 'Batal',
            }).then(result => {
                if (result.isConfirmed) {
                    @this.call('delete');
                }
            });
        });

        // Konfirmasi Aktifkan
        window.addEventListener('swal:confirmAktifkan', event => {
            const data = event.detail[0] ?? event.detail;
            Swal.fire({
                title: data.title ?? 'Konfirmasi',
                text: data.text ?? '',
                icon: data.icon ?? 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#dc2626',
                confirmButtonText: data.confirmButtonText ?? 'Ya, Aktifkan!',
                cancelButtonText: data.cancelButtonText ?? 'Batal',
            }).then(result => {
                if (result.isConfirmed) {
                    @this.call('setAktif');
                }
            });
        });

        // Konfirmasi Non-Aktifkan
        window.addEventListener('swal:confirmNonAktif', event => {
            const data = event.detail[0] ?? event.detail;
            Swal.fire({
                title: data.title ?? 'Konfirmasi',
                text: data.text ?? '',
                icon: data.icon ?? 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dc2626',
                confirmButtonText: data.confirmButtonText ?? 'Ya, Nonaktifkan!',
                cancelButtonText: data.cancelButtonText ?? 'Batal',
            }).then(result => {
                if (result.isConfirmed) {
                    @this.call('setNonAktif');
                }
            });
        });

        // Error Alert
        window.addEventListener('swal:error', event => {
            const data = event.detail[0] ?? event.detail;
            Swal.fire({
                title: data.title ?? 'Error',
                text: data.text ?? '',
                icon: data.icon ?? 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Mengerti',
            });
        });
    </script>
</div>
