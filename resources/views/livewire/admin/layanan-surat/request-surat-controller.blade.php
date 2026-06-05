<x-layouts.layouts>
    <x-slot:judul>
        Data Pengajuan Surat
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        {{-- Header & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6 mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Data Pengajuan Surat</h1>
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
                                <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Pengajuan Surat</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.jenis-surat.index') }}" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition-colors text-sm flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 12h7.5" />
                    </svg>
                    <span>Kelola Jenis Surat</span>
                </a>
            </div>
        </div>

        {{-- Notifikasi --}}
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Statistics Grid --}}
        <div class="grid gap-3 sm:grid-cols-4 my-6">
            <div class="rounded-lg bg-gray-50 border border-gray-200 p-4 text-sm text-gray-700 shadow-sm">
                <p class="text-gray-500 font-medium">Total Pengajuan</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalSurat }}</p>
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
            <form method="GET" action="{{ route('admin.layanan-surat.request.index') }}" class="flex flex-wrap items-center gap-3 w-full">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input id="search" name="search" type="search" value="{{ request('search') }}" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-sky-500 focus:border-sky-500" placeholder="Cari nama pemohon..." />
                </div>

                <!-- Status Filter -->
                <div class="w-full sm:w-48">
                    <select id="status" name="status" onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-400 bg-white p-3 text-sm text-gray-900 focus:border-sky-500 focus:ring-sky-500">
                        <option value="">Semua Status</option>
                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Menunggu</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Jenis Filter -->
                <div class="w-full sm:w-56">
                    <select id="jenis" name="jenis" onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-400 bg-white p-3 text-sm text-gray-900 focus:border-sky-500 focus:ring-sky-500">
                        <option value="">Semua Jenis Surat</option>
                        @foreach ($jenisSuratList as $jenis)
                            <option value="{{ $jenis->id_jenis_surat }}" {{ request('jenis') == $jenis->id_jenis_surat ? 'selected' : '' }}>
                                {{ $jenis->nama_surat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Cari Button -->
                <div class="w-full sm:w-auto ms-auto">
                    <button type="submit"
                        class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white font-bold py-2.5 px-6 rounded flex items-center space-x-2 w-full sm:w-auto justify-center">
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
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Pemohon
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Jenis Surat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Diproses Oleh
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-32">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-44">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengajuanSurat as $index => $surat)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">
                                {{ $pengajuanSurat->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        // Safely parse data_form for the list view
                                        $df = $surat->data_form;
                                        if (is_string($df)) { $df = json_decode($df, true) ?? []; }
                                        if (!is_array($df)) { $df = []; }
                                        
                                        // Robust Lookup Pemohon: cari relasi penduduk, atau cari user pemohon lalu relasi penduduknya
                                        $pemohon = $surat->penduduk;
                                        $userPemohon = null;
                                        if (!$pemohon) {
                                            $userPemohon = \App\Models\User::where('id_penduduk', $surat->id_penduduk)
                                                ->orWhere('id', $surat->id_penduduk)
                                                ->first();
                                            if ($userPemohon) {
                                                $pemohon = $userPemohon->penduduk;
                                            }
                                        }

                                        $namaPemohon = $pemohon?->nama_lengkap ?? $userPemohon?->name ?? $df['nama'] ?? $df['nama_lengkap'] ?? 'N A';
                                        $nikPemohon  = $pemohon?->nik ?? $userPemohon?->nik ?? $df['nik'] ?? '';
                                        $alamatFallback = $pemohon?->alamat ?? $df['alamat'] ?? '-';
                                        $nameParts   = explode(' ', $namaPemohon);
                                        $initials    = strtoupper(substr($nameParts[0] ?? 'N', 0, 1)) . strtoupper(substr($nameParts[1] ?? 'A', 0, 1));
                                    @endphp
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sky-100 text-xs font-semibold text-sky-700">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $namaPemohon }}</p>
                                        <p class="text-xs text-gray-400">NIK: {{ $nikPemohon ? Str::mask($nikPemohon, '*', 8) : '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                <div class="space-y-1">
                                    <p>{{ $surat->jenisSurat->nama_surat ?? '-' }}</p>
                                    @if($surat->nomor_surat)
                                        <p class="text-xs text-gray-400">No. Surat: {{ $surat->nomor_surat }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $surat->diprosesOleh?->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $surat->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $status = strtolower($surat->status);
                                    $badgeClass = match($status) {
                                        'diajukan'  => 'bg-amber-50 text-amber-700 ring-amber-200',
                                        'diproses'  => 'bg-blue-50 text-blue-700 ring-blue-200',
                                        'selesai'   => 'bg-green-50 text-green-700 ring-green-200',
                                        'ditolak'   => 'bg-red-50 text-red-700 ring-red-200',
                                        default     => 'bg-gray-50 text-gray-600 ring-gray-200',
                                    };
                                    $badgeLabel = match($status) {
                                        'diajukan'  => 'Menunggu',
                                        'diproses'  => 'Diproses',
                                        'selesai'   => 'Disetujui',
                                        'ditolak'   => 'Ditolak',
                                        default     => ucfirst($surat->status),
                                    };
                                @endphp
                                <div class="flex flex-col items-center gap-1">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $badgeClass }}">
                                        {{ $badgeLabel }}
                                    </span>
                                    @if($status === 'ditolak' && $surat->alasan_tolak)
                                        <span class="text-xs text-red-600 font-medium" title="{{ $surat->alasan_tolak }}">
                                            {{ Str::limit($surat->alasan_tolak, 30) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('admin.layanan-surat.request.show', $surat->id_pengajuan_surat) }}"
                                        title="Lihat Detail"
                                        class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white p-1.5 text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>

                                    @if (in_array($surat->status, ['diajukan', 'diproses']))
                                        {{-- Tombol Setujui --}}
                                        <button type="button"
                                            data-id="{{ $surat->id_pengajuan_surat }}"
                                            data-pemohon="{{ $namaPemohon }}"
                                            onclick="openSetujuiModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'))"
                                            title="Setuju"
                                            class="inline-flex items-center justify-center rounded-lg border border-green-200 bg-green-50 px-2.5 py-1.5 text-xs font-semibold text-green-600 hover:bg-green-100 hover:text-green-700 transition-colors">
                                            Setuju
                                        </button>

                                        {{-- Tombol Tolak --}}
                                        <button 
                                            type="button"
                                            data-id="{{ $surat->id_pengajuan_surat }}"
                                            data-pemohon="{{ $namaPemohon }}"
                                            onclick="openTolakModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'))"
                                            title="Tolak"
                                            class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-500 hover:bg-red-100 hover:text-red-700 transition-colors">
                                            Tolak
                                        </button>
                                    @endif

                                    @if ($surat->status === 'selesai')
                                        {{-- Tombol Unduh --}}
                                        <a href="{{ route('admin.layanan-surat.request.download', $surat->id_pengajuan_surat) }}"
                                            title="Unduh Surat"
                                            class="inline-flex items-center justify-center rounded-lg border border-sky-200 bg-sky-50 p-1.5 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada data pengajuan surat.</p>
                                    @if (request()->hasAny(['search', 'status', 'jenis']))
                                        <a href="{{ route('admin.layanan-surat.request.index') }}" class="text-xs text-sky-600 hover:underline">Reset filter</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($pengajuanSurat->hasPages())
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-gray-100 px-6 py-4">
                <p class="text-sm text-gray-400">
                    Menampilkan <span class="font-medium text-gray-600">{{ $pengajuanSurat->firstItem() }}</span>–<span class="font-medium text-gray-600">{{ $pengajuanSurat->lastItem() }}</span>
                    dari <span class="font-medium text-gray-600">{{ $pengajuanSurat->total() }}</span> data
                </p>
                {{ $pengajuanSurat->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

    {{-- Modal Setujui --}}
    <div id="setujuiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Setujui Pengajuan Surat</h3>
            
            <form id="setujuiForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="pemohon_setuju" class="block text-sm font-medium text-gray-700 mb-1">Pemohon</label>
                    <input type="text" id="pemohon_setuju" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600">
                </div>

                <div>
                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor Surat <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nomor_surat" 
                        name="nomor_surat" 
                        placeholder="Contoh: 213/23/421" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 text-gray-700" 
                        required
                    >
                </div>

                <div class="flex gap-3 justify-end mt-6">
                    <button 
                        type="button"
                        onclick="closeSetujuiModal()"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                        Batal
                    </button>
                    <button 
                        type="submit"
                        id="setujuiSubmitBtn"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Setujui & Hasilkan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tolak dengan Alasan --}}
    <div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tolak Pengajuan Surat</h3>
            
            <form id="tolakForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="pemohon" class="block text-sm font-medium text-gray-700 mb-1">Pemohon</label>
                    <input type="text" id="pemohon" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600">
                </div>

                <div>
                    <label for="alasan_tolak" class="block text-sm font-medium text-gray-700 mb-1">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="alasan_tolak" 
                        name="alasan_tolak" 
                        rows="4"
                        placeholder="Jelaskan alasan penolakan pengajuan surat ini..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 text-gray-700"
                        required
                        minlength="5"
                        maxlength="500"
                    ></textarea>
                    <p class="text-xs text-gray-500 mt-1">Minimal 5 karakter, maksimal 500 karakter</p>
                </div>

                <div class="flex gap-3 justify-end mt-6">
                    <button 
                        type="button"
                        onclick="closeTolakModal()"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                        Batal
                    </button>
                    <button 
                        type="submit"
                        id="tolakSubmitBtn"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSetujuiModal(id, pemohon) {
            const form = document.getElementById('setujuiForm');
            const setujuiTemplate = "{{ route('admin.layanan-surat.request.setujui', ['__ID__']) }}";
            form.action = setujuiTemplate.replace('__ID__', encodeURIComponent(id));
            document.getElementById('pemohon_setuju').value = pemohon;
            document.getElementById('nomor_surat').value = '';
            document.getElementById('setujuiSubmitBtn').disabled = false;
            document.getElementById('setujuiSubmitBtn').textContent = 'Setujui & Hasilkan Surat';
            document.getElementById('setujuiModal').classList.remove('hidden');
            setTimeout(() => document.getElementById('nomor_surat').focus(), 150);
        }

        function closeSetujuiModal() {
            document.getElementById('setujuiModal').classList.add('hidden');
        }

        function openTolakModal(id, pemohon) {
            const form = document.getElementById('tolakForm');
            const tolakTemplate = "{{ route('admin.layanan-surat.request.tolak', ['__ID__']) }}";
            form.action = tolakTemplate.replace('__ID__', encodeURIComponent(id));
            document.getElementById('pemohon').value = pemohon;
            document.getElementById('alasan_tolak').value = '';
            document.getElementById('tolakSubmitBtn').disabled = false;
            document.getElementById('tolakSubmitBtn').textContent = 'Tolak';
            document.getElementById('tolakModal').classList.remove('hidden');
            setTimeout(() => document.getElementById('alasan_tolak').focus(), 150);
        }

        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
        }

        // Close modal ketika klik di luar modal
        ['setujuiModal', 'tolakModal'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) {
                    if (id === 'setujuiModal') closeSetujuiModal();
                    if (id === 'tolakModal') closeTolakModal();
                }
            });
        });

        // Loading states
        document.getElementById('setujuiForm').addEventListener('submit', function() {
            const btn = document.getElementById('setujuiSubmitBtn');
            btn.disabled = true;
            btn.textContent = '⏳ Memproses...';
        });
        document.getElementById('tolakForm').addEventListener('submit', function() {
            const btn = document.getElementById('tolakSubmitBtn');
            btn.disabled = true;
            btn.textContent = '⏳ Memproses...';
        });
    </script>
</x-layouts.layouts>