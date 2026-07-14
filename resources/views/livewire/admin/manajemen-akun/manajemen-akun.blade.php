<div>
    <x-slot:judul>
        Manajemen Akun Masyarakat
    </x-slot:judul>

    <div class="mx-4">

        {{-- Header & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6 mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Manajemen Akun Masyarakat</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600">
                                <svg class="w-3.5 h-3.5 me-2.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Pelayanan Masyarakat</span>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Manajemen Akun Masyarakat</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            @if($oldCompletedCount > 0)
                <div class="flex items-center gap-2">
                    <button
                        wire:click="confirmCleanOldHistory"
                        class="cursor-pointer bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition-colors text-sm flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Bersihkan Arsip Selesai > 1 Tahun ({{ $oldCompletedCount }})</span>
                    </button>
                </div>
            @endif
        </div>

        {{-- Statistics Grid --}}
        <div class="grid gap-3 sm:grid-cols-4 my-6">
            <div class="rounded-lg bg-gray-50 border border-gray-200 p-4 text-sm text-gray-700 shadow-sm">
                <p class="text-gray-500 font-medium">Total Akun Masyarakat</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalWarga }}</p>
            </div>
            <div class="rounded-lg bg-green-50 border border-green-200 p-4 text-sm text-green-900 shadow-sm">
                <p class="text-green-700 font-medium">Akun Aktif</p>
                <p class="mt-2 text-2xl font-semibold">{{ $aktifWarga }}</p>
            </div>
            <div class="rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-900 shadow-sm">
                <p class="text-red-700 font-medium">Akun Dinonaktifkan</p>
                <p class="mt-2 text-2xl font-semibold">{{ $nonaktifWarga }}</p>
            </div>
            <div class="rounded-lg bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900 shadow-sm">
                <p class="text-amber-700 font-medium">Arsip Selesai > 1 Thn</p>
                <p class="mt-2 text-2xl font-semibold">{{ $oldCompletedCount }}</p>
            </div>
        </div>

        {{-- Orphaned Data Clean Up Alert --}}
        @if ($orphanedPengajuanCount > 0 || $orphanedPengaduanCount > 0 || $orphanedNotifikasiCount > 0)
            <div class="my-4 p-4 rounded-lg border border-red-200 bg-red-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3 text-red-800 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <div>
                        <p class="font-semibold text-base">Terdeteksi Data Sampah / Yatim (Orphaned Data)</p>
                        <p class="mt-1">
                            Ditemukan histori transaksi dari akun-akun yang telah dihapus secara manual sebelumnya:
                        </p>
                        <ul class="list-disc list-inside mt-2 space-y-0.5">
                            @if($orphanedPengajuanCount > 0)
                                <li>📄 Pengajuan Surat Yatim: <strong>{{ $orphanedPengajuanCount }}</strong> data</li>
                            @endif
                            @if($orphanedPengaduanCount > 0)
                                <li>📢 Pengaduan Yatim: <strong>{{ $orphanedPengaduanCount }}</strong> data</li>
                            @endif
                            @if($orphanedNotifikasiCount > 0)
                                <li>🔔 Notifikasi Yatim: <strong>{{ $orphanedNotifikasiCount }}</strong> data</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="shrink-0 flex items-center">
                    <button 
                        wire:click="confirmCleanOrphanedData" 
                        class="cursor-pointer bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors text-sm flex items-center gap-1.5"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Bersihkan Data Yatim</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div class="mb-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Search & Status Filter --}}
        <div class="flex flex-wrap justify-between items-center border border-gray-300 rounded-lg my-6 p-4 gap-4 bg-gray-50 shadow-sm">
            <div class="flex flex-wrap items-center gap-3 w-full">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        autocomplete="off"
                        class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-white focus:ring-sky-500 focus:border-sky-500"
                        placeholder="Cari nama, email, NIK..."
                    />
                </div>

                <!-- Status Filter -->
                <div class="w-full sm:w-64">
                    <select wire:model.live="statusFilter" class="block w-full p-2.5 text-sm text-gray-900 border border-gray-400 rounded-lg bg-white focus:ring-sky-500 focus:border-sky-500">
                        <option value="aktif">Tampilkan Akun Masyarakat Aktif</option>
                        <option value="nonaktif">Tampilkan Akun Dinonaktifkan</option>
                        <option value="semua">Tampilkan Semua Status Akun</option>
                    </select>
                </div>

                <!-- Submit Cari Button -->
                <div class="w-full sm:w-auto ms-auto">
                    <button type="button" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white font-bold py-2.5 px-6 rounded-lg flex items-center space-x-2 w-full sm:w-auto justify-center shadow-sm transition-colors text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803 7.5 7.5 0 0 0 15.803 15.803Z" />
                        </svg>
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-12">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Nama / Akun</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Pengajuan Surat</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Pengaduan</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Notifikasi</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">Daftar</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-52">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- No --}}
                            <td class="px-4 py-4 text-center text-gray-500 text-sm">
                                {{ $users->firstItem() + $index }}
                            </td>

                            {{-- Nama / Akun --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center font-bold text-sky-700 text-sm uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                            @if($user->trashed())
                                                <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-800">
                                                    Tidak Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800">
                                                    Aktif
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        @if($user->nik)
                                            <p class="text-xs text-gray-400">Nomor KK: {{ $user->nik }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Jumlah Pengajuan Surat --}}
                            <td class="px-4 py-4 text-center">
                                @php $jmlPengajuan = $pengajuanCounts[$user->id_penduduk] ?? 0; @endphp
                                <span class="inline-flex items-center justify-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    {{ $jmlPengajuan > 0 ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $jmlPengajuan }}
                                </span>
                            </td>

                            {{-- Jumlah Pengaduan --}}
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center justify-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    {{ $user->pengaduan_count > 0 ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $user->pengaduan_count }}
                                </span>
                            </td>

                            {{-- Jumlah Notifikasi --}}
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center justify-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    {{ $user->notifikasi_count > 0 ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $user->notifikasi_count }}
                                </span>
                            </td>

                            {{-- Tanggal Daftar --}}
                            <td class="px-4 py-4 text-center text-xs text-gray-500">
                                {{ $user->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                    @if ($user->trashed())
                                        {{-- Aktifkan Kembali (Restore) --}}
                                        <button
                                            wire:click="restoreUser({{ $user->id }})"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1.5 rounded-md border border-green-200 bg-green-50 px-2.5 py-1.5 text-xs font-semibold text-green-700 hover:bg-green-100 transition-colors"
                                            title="Aktifkan kembali akun masyarakat ini"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>
                                            Aktifkan
                                        </button>
                                    @else
                                        {{-- Bersihkan Data (Tetap Akun, Bersihkan History) --}}
                                        <button
                                            wire:click="confirmClearData({{ $user->id }})"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1 rounded-md border border-amber-200 bg-amber-50 px-2.5 py-1.5 text-xs font-semibold text-amber-700 hover:bg-amber-100 transition-colors"
                                            title="Bersihkan semua histori, akun tetap ada"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Bersihkan
                                        </button>

                                        {{-- Nonaktifkan Akun (Soft Delete) --}}
                                        <button
                                            wire:click="confirmDelete({{ $user->id }})"
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-1 rounded-md border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors"
                                            title="Nonaktifkan akun masyarakat (Soft Delete)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            Nonaktifkan
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                    <p class="text-sm font-medium">Tidak ada akun masyarakat ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    {{-- SweetAlert Confirm Delete --}}
    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:confirm-user', (params) => {
                const p = Array.isArray(params) ? params[0] : params;
                Swal.fire({
                    title: p.title,
                    html: p.html,
                    icon: p.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: p.confirmButtonText,
                    cancelButtonText: p.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.delete();
                    }
                });
            });

            Livewire.on('swal:confirm-clear-data', (params) => {
                const p = Array.isArray(params) ? params[0] : params;
                Swal.fire({
                    title: p.title,
                    html: p.html,
                    icon: p.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: p.confirmButtonText,
                    cancelButtonText: p.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.clearData();
                    }
                });
            });

            Livewire.on('swal:confirm-clean-old-history', (params) => {
                const p = Array.isArray(params) ? params[0] : params;
                Swal.fire({
                    title: p.title,
                    html: p.html,
                    icon: p.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: p.confirmButtonText,
                    cancelButtonText: p.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.cleanOldHistory();
                    }
                });
            });

            Livewire.on('swal:confirm-clean-orphaned-data', (params) => {
                const p = Array.isArray(params) ? params[0] : params;
                Swal.fire({
                    title: p.title,
                    html: p.html,
                    icon: p.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc2626',
                    confirmButtonText: p.confirmButtonText,
                    cancelButtonText: p.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.cleanOrphanedData();
                    }
                });
            });
        });
    </script>
    @endpush
</div>
