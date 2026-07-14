<div>
    <x-slot:judul>
        Data Pengaduan Masyarakat
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        {{-- Header & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6 mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Data Pengaduan Masyarakat</h1>
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
                                <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Pengaduan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Success/Error Alert --}}
        @if (session('success'))
            <div class="my-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Statistics Grid --}}
        <div class="grid gap-3 sm:grid-cols-4 my-6">
            <div class="rounded-lg bg-gray-50 border border-gray-200 p-4 text-sm text-gray-700 shadow-sm">
                <p class="text-gray-500 font-medium">Total Pengaduan</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalPengaduan }}</p>
            </div>
            <div class="rounded-lg bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900 shadow-sm">
                <p class="text-amber-700 font-medium">Menunggu</p>
                <p class="mt-2 text-2xl font-semibold">{{ $totalMenunggu }}</p>
            </div>
            <div class="rounded-lg bg-green-50 border border-green-200 p-4 text-sm text-green-900 shadow-sm">
                <p class="text-green-700 font-medium">Disetujui</p>
                <p class="mt-2 text-2xl font-semibold">{{ $totalDisetujui }}</p>
            </div>
            <div class="rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-900 shadow-sm">
                <p class="text-red-700 font-medium">Ditolak</p>
                <p class="mt-2 text-2xl font-semibold">{{ $totalDitolak }}</p>
            </div>
        </div>

        {{-- Filter & Search Form --}}
        <div class="flex flex-wrap justify-between items-center border border-gray-300 rounded-lg my-6 p-4 gap-4 bg-gray-50 shadow-sm">
            <form method="GET" action="{{ route('admin.layanan-surat.pengaduan') }}" class="flex flex-wrap items-center gap-3 w-full">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input id="search" name="search" type="search" value="{{ request('search') }}" class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-white focus:ring-sky-500 focus:border-sky-500" placeholder="Cari judul, isi, atau pengirim..." />
                </div>

                <!-- Status Filter select -->
                <div class="w-full sm:w-48">
                    <select name="status" id="status" onchange="this.form.submit()" class="block w-full p-2.5 text-sm text-gray-900 border border-gray-400 rounded-lg bg-white focus:ring-sky-500 focus:border-sky-500">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Submit Cari Button -->
                <div class="w-full sm:w-auto ms-auto">
                    <button type="submit" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white font-bold py-2.5 px-6 rounded-lg flex items-center space-x-2 w-full sm:w-auto justify-center shadow-sm transition-colors text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803 7.5 7.5 0 0 0 15.803 15.803Z" />
                        </svg>
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-16">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-32">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Detail Pengadu
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Aduan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">
                            Bukti Foto
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Catatan Perangkat Desa
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">
                            Dibuat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-28">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pengaduan as $index => $item)
                        <tr wire:click="showDetail({{ $item->id_pengaduan }})" class="hover:bg-sky-50 transition duration-200 cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold text-gray-700">
                                {{ $pengaduan->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-800 capitalize">
                                    {{ $item->jenis ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-left">
                                @php
                                    $namaLengkap = $item->user?->penduduk?->nama_lengkap ?? $item->user?->name ?? 'Tidak diketahui';
                                    $nik = $item->user?->penduduk?->nik ?? $item->user?->nik ?? '-';
                                    $gender = $item->user?->penduduk?->jenis_kelamin ?? '-';
                                    $alamat = $item->user?->penduduk?->alamat ?? '-';
                                @endphp
                                <div class="space-y-0.5">
                                    <p class="font-bold text-gray-900 text-sm">{{ $namaLengkap }}</p>
                                    <p class="text-xs text-gray-500"><strong class="text-gray-700">NIK:</strong> {{ $nik }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-left">
                                <div class="space-y-0.5">
                                    <p class="font-bold text-gray-800 text-sm">{{ $item->judul }}</p>
                                    <p class="text-xs text-gray-600 whitespace-normal leading-relaxed line-clamp-2">{{ $item->isi }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap" wire:click.stop>
                                @if($item->foto)
                                    <a href="{{ asset($item->foto) }}" target="_blank" class="inline-block hover:opacity-90 transition-opacity">
                                        <img src="{{ asset($item->foto) }}" alt="Foto Bukti" class="w-10 h-10 object-cover rounded-lg border border-gray-200 shadow-sm inline-block">
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-left text-gray-600 whitespace-normal max-w-[200px] text-xs">
                                {{ $item->catatan_admin ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @php
                                    $statusStyle = match($item->status) {
                                        'baru', 'diproses' => 'bg-amber-100 text-amber-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'ditolak' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                    $statusLabel = match($item->status) {
                                        'baru', 'diproses' => 'Menunggu',
                                        'selesai' => 'Disetujui',
                                        'ditolak' => 'Ditolak',
                                        default => ucfirst($item->status),
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusStyle }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-gray-500 text-xs">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap" wire:click.stop>
                                <button wire:click="showDetail({{ $item->id_pengaduan }})" class="cursor-pointer inline-flex items-center gap-1 rounded bg-sky-700 hover:bg-sky-800 px-3 py-1.5 text-xs font-bold text-white shadow transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-400 font-semibold">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p>Belum ada pengaduan masyarakat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($pengaduan->total() > 0)
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-100 px-6 py-4">
                <p class="text-sm text-gray-400">
                    Menampilkan <span class="font-medium text-gray-600">{{ $pengaduan->firstItem() }}</span>–<span class="font-medium text-gray-600">{{ $pengaduan->lastItem() }}</span>
                    dari <span class="font-medium text-gray-600">{{ $pengaduan->total() }}</span> data
                </p>
                @if ($pengaduan->hasPages())
                    {{ $pengaduan->appends(request()->query())->links() }}
                @endif
            </div>
        @endif
    </div>

    {{-- ══════════════════════════════════════════════════════════════
         DETAIL MODAL
    ══════════════════════════════════════════════════════════════ --}}
    @if ($showDetailModal && $selectedPengaduan)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black bg-opacity-50 px-4 py-6">
        <div class="relative w-full max-w-2xl rounded-2xl bg-white shadow-2xl overflow-hidden animate-fade-in">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 bg-gray-50 px-6 py-4">
                <div class="flex items-center gap-2">
                    <span class="text-xl">{{ $selectedPengaduan->foto ? '🖼️' : '💬' }}</span>
                    <h2 class="text-lg font-bold text-gray-800">Detail Laporan Pengaduan Masyarakat</h2>
                </div>
                <button wire:click="closeDetailModal" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-200 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 py-5 space-y-6 max-h-[70vh] overflow-y-auto">
                {{-- Data Pengadu --}}
                <div class="bg-sky-50 border border-sky-200 rounded-xl p-4 space-y-3">
                    <h3 class="text-xs font-bold text-sky-800 uppercase tracking-wider flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Identitas Masyarakat Pengadu
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500 text-xs font-medium">Nama Lengkap</p>
                            <p class="font-bold text-gray-800">{{ $selectedPengaduan->user?->penduduk?->nama_lengkap ?? $selectedPengaduan->user?->name ?? 'Tidak diketahui' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs font-medium">NIK</p>
                            <p class="font-bold text-gray-800">{{ $selectedPengaduan->user?->penduduk?->nik ?? $selectedPengaduan->user?->nik ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs font-medium">Jenis Kelamin</p>
                            <p class="font-semibold text-gray-800">{{ $selectedPengaduan->user?->penduduk?->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs font-medium">Alamat Lengkap</p>
                            <p class="font-semibold text-gray-800">{{ $selectedPengaduan->user?->penduduk?->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Isi Pengaduan --}}
                <div class="space-y-2">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Isi Laporan Pengaduan</h3>
                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 space-y-2">
                        <p class="text-sm font-extrabold text-gray-900 border-b pb-1.5 border-gray-200">{{ $selectedPengaduan->judul }}</p>
                        <p class="text-sm text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $selectedPengaduan->isi }}</p>
                    </div>
                </div>

                {{-- Foto Lampiran --}}
                @if($selectedPengaduan->foto)
                    <div class="space-y-2">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Berkas Foto Bukti</h3>
                        <div class="border border-gray-200 rounded-xl p-2 bg-gray-100 flex justify-center shadow-inner">
                            <a href="{{ asset($selectedPengaduan->foto) }}" target="_blank" title="Klik untuk memperbesar gambar">
                                <img src="{{ asset($selectedPengaduan->foto) }}" alt="Foto Bukti" class="max-h-60 object-contain rounded-lg border shadow-sm">
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Update Status & Respon --}}
                <div class="space-y-3 border-t border-gray-100 pt-4">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggapan / Catatan Perangkat Desa</h3>
                    <div class="space-y-4">
                        <div>
                            <textarea
                                id="catatanAdmin"
                                wire:model="catatanAdmin"
                                rows="3"
                                placeholder="Tuliskan respon resmi, solusi, atau instruksi dari desa..."
                                class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 resize-none text-gray-700 disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed"
                                {{ in_array($selectedPengaduan->status, ['ditolak', 'selesai']) ? 'disabled' : '' }}
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="relative flex items-center justify-end gap-2 border-t border-gray-100 bg-gray-50 px-6 py-4">
                @if(in_array($selectedPengaduan->status, ['ditolak', 'selesai']))
                    {{-- Status final — Tampil di Tengah sebagai teks biasa tanpa kotak button --}}
                    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-1.5 text-sm font-bold {{ $selectedPengaduan->status === 'ditolak' ? 'text-red-600' : 'text-emerald-600' }}">
                        @if($selectedPengaduan->status === 'ditolak')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Pengaduan Telah Ditolak
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Pengaduan Berhasil Disetujui
                        @endif
                    </div>
                @endif

                <button
                    type="button"
                    wire:click="closeDetailModal"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors cursor-pointer"
                >
                    Tutup
                </button>

                @if(!in_array($selectedPengaduan->status, ['ditolak', 'selesai']))
                    {{-- Tolak Button --}}
                    <button
                        type="button"
                        onclick="confirmTolak()"
                        class="cursor-pointer rounded-lg bg-red-600 hover:bg-red-700 active:bg-red-800 px-4 py-2 text-sm font-bold text-white transition-colors shadow-sm"
                    >
                        Tolak
                    </button>

                    {{-- Terima/Selesaikan Button --}}
                    <button
                        type="button"
                        onclick="confirmSetujui()"
                        class="cursor-pointer rounded-lg bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 px-4 py-2 text-sm font-bold text-white transition-colors shadow-sm"
                    >
                        Setujui
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        function confirmSetujui() {
            Swal.fire({
                title: 'Konfirmasi Setujui',
                text: 'Apakah Anda yakin ingin menyetujui pengaduan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669', // Emerald 600
                cancelButtonColor: '#dc2626',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.simpanCatatan('selesai');
                }
            });
        }

        function confirmTolak() {
            Swal.fire({
                title: 'Konfirmasi Tolak',
                text: 'Apakah Anda yakin ingin menolak pengaduan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Red 600
                cancelButtonColor: '#dc2626',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.simpanCatatan('ditolak');
                }
            });
        }
    </script>
    @endpush
</div>
