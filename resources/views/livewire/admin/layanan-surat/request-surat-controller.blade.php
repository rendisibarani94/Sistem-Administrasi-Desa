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
                    <label for="search" class="sr-only">Cari Nama Pemohon</label>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input id="search" name="search" type="search" value="{{ request('search') }}" aria-label="Cari nama pemohon" title="Cari nama pemohon" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-sky-500 focus:border-sky-500" placeholder="Cari nama pemohon..." />
                </div>

                <!-- Status Filter -->
                <div class="w-full sm:w-48">
                    <label for="status" class="sr-only">Filter Status</label>
                    <select id="status" name="status" onchange="this.form.submit()" aria-label="Filter Berdasarkan Status" title="Filter Berdasarkan Status"
                        class="w-full rounded-lg border border-gray-400 bg-white p-3 text-sm text-gray-900 focus:border-sky-500 focus:ring-sky-500">
                        <option value="">Semua Status</option>
                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Menunggu</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Jenis Filter -->
                <div class="w-full sm:w-56">
                    <label for="jenis" class="sr-only">Filter Jenis Surat</label>
                    <select id="jenis" name="jenis" onchange="this.form.submit()" aria-label="Filter Berdasarkan Jenis Surat" title="Filter Berdasarkan Jenis Surat"
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
                            <td class="px-6 py-4 text-gray-600 font-semibold">
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
                                        <p class="text-xs text-gray-600 font-medium">NIK: {{ $nikPemohon ? Str::mask($nikPemohon, '*', 8) : '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                <div class="space-y-1">
                                    <p class="font-medium text-gray-800">{{ $surat->jenisSurat->nama_surat ?? '-' }}</p>
                                    @if($surat->nomor_surat)
                                        <p class="text-xs text-gray-600 font-medium">No. Surat: {{ $surat->nomor_surat }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium">
                                {{ $surat->diprosesOleh?->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-medium">
                                {{ $surat->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $status = strtolower($surat->status);
                                    $badgeClass = match($status) {
                                        'diajukan'  => 'bg-amber-50 text-amber-800 ring-amber-300',
                                        'diproses'  => 'bg-blue-50 text-blue-800 ring-blue-300',
                                        'selesai'   => 'bg-green-50 text-green-800 ring-green-300',
                                        'ditolak'   => 'bg-red-50 text-red-800 ring-red-300',
                                        default     => 'bg-gray-50 text-gray-800 ring-gray-300',
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
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $badgeClass }}">
                                        {{ $badgeLabel }}
                                    </span>
                                    @if($status === 'ditolak' && $surat->alasan_tolak)
                                        <span class="text-xs text-red-700 font-medium" title="{{ $surat->alasan_tolak }}">
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
                                        @php
                                            // Extract form fields for setujui modal
                                            $rowFormFields = [];
                                            $rowNormalizedFields = [];
                                            $rowDataForm = $surat->data_form;
                                            if (is_string($rowDataForm)) {
                                                $rowDataForm = json_decode($rowDataForm, true) ?? [];
                                            }
                                            if (is_array($rowDataForm)) {
                                                foreach ($rowDataForm as $key => $value) {
                                                    $isFile = is_string($value) && (str_starts_with($value, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $value));
                                                    if (!$isFile && $value) {
                                                        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $key));
                                                        if (isset($rowNormalizedFields[$normalized])) {
                                                            continue;
                                                        }
                                                        $rowNormalizedFields[$normalized] = true;

                                                        $label = ucfirst(str_replace('_', ' ', $key));
                                                        if (strtolower($label) === 'nik') {
                                                            $label = 'NIK';
                                                        }
                                                        $rowFormFields[$label] = $value;
                                                    }
                                                }
                                            }
                                            if ($surat->detailPengajuanSurat) {
                                                foreach ($surat->detailPengajuanSurat as $detail) {
                                                    $namaField = $detail->persyaratanSurat?->nama_field ?? "Field #{$detail->persyaratan_id}";
                                                    $tipeField = $detail->persyaratanSurat?->tipe_field ?? 'text';
                                                    $val = $detail->value;
                                                    $isFile = $tipeField === 'file_image' || (is_string($val) && str_starts_with($val, 'pengajuan/'));
                                                    if (!$isFile && $val) {
                                                        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $namaField));
                                                        if (isset($rowNormalizedFields[$normalized])) {
                                                            continue;
                                                        }
                                                        $rowNormalizedFields[$normalized] = true;

                                                        $label = $namaField;
                                                        if (strtolower($label) === 'nik') {
                                                            $label = 'NIK';
                                                        }
                                                        $rowFormFields[$label] = $val;
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{-- Tombol Setujui --}}
                                        <button type="button"
                                            data-id="{{ $surat->id_pengajuan_surat }}"
                                            data-pemohon="{{ $namaPemohon }}"
                                            data-jenis="{{ $surat->jenisSurat->nama_surat ?? '-' }}"
                                            data-tanggal="{{ $surat->created_at->format('d M Y') }}"
                                            data-admin="{{ \App\Models\KepalaDesa::where('is_active', true)->first()?->nama ?? 'Kepala Desa' }}"
                                            data-fields="{{ json_encode($rowFormFields) }}"
                                            onclick="openSetujuiModal(
                                                this.getAttribute('data-id'),
                                                this.getAttribute('data-pemohon'),
                                                this.getAttribute('data-jenis'),
                                                this.getAttribute('data-tanggal'),
                                                this.getAttribute('data-admin'),
                                                this.getAttribute('data-fields')
                                            )"
                                            title="Setuju"
                                            class="inline-flex items-center justify-center rounded-lg border border-green-300 bg-green-50 px-2.5 py-1.5 text-xs font-bold text-green-800 hover:bg-green-100 hover:text-green-900 transition-colors">
                                            Setuju
                                        </button>

                                        {{-- Tombol Tolak --}}
                                        <button 
                                            type="button"
                                            data-id="{{ $surat->id_pengajuan_surat }}"
                                            data-pemohon="{{ $namaPemohon }}"
                                            data-fields="{{ json_encode($rowFormFields) }}"
                                            onclick="openTolakModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'), this.getAttribute('data-fields'))"
                                            title="Tolak"
                                            class="inline-flex items-center justify-center rounded-lg border border-red-300 bg-red-50 px-2.5 py-1.5 text-xs font-bold text-red-800 hover:bg-red-100 hover:text-red-900 transition-colors">
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
                <p class="text-sm text-gray-700 font-medium">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $pengajuanSurat->firstItem() }}</span>–<span class="font-semibold text-gray-900">{{ $pengajuanSurat->lastItem() }}</span>
                    dari <span class="font-semibold text-gray-900">{{ $pengajuanSurat->total() }}</span> data
                </p>
                {{ $pengajuanSurat->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

    {{-- Modal Setujui --}}
    <div id="setujuiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-2xl w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Setujui Pengajuan Surat</h3>
                </div>
                <button type="button" onclick="closeSetujuiModal()" title="Tutup Modal" aria-label="Tutup Modal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="sr-only">Tutup Modal</span>
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Banner info -->
            <div class="mb-4 flex items-start gap-3 rounded-lg border border-blue-100 bg-blue-50 p-3 text-xs text-blue-900">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-blue-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.053 1.053l-.042.02.042.02a.75.75 0 1 1-1.053-1.053l.042-.02ZM12 21a9 9 0 1 1 0-18 9 9 0 0 1 0 18Zm0-12.75h.008v.008H12v-.008Z" />
                </svg>
                <div>
                    <strong class="font-bold block mb-0.5">Isi nomor dan kode surat saja.</strong>
                    <span class="text-blue-800 font-medium">Jenis surat, bulan, dan tahun akan digenerate otomatis oleh sistem.</span>
                </div>
            </div>

            <!-- Data Pengajuan -->
            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200 text-xs mb-4">
                <h4 class="font-bold text-gray-700 uppercase tracking-wider mb-2">Data Pengajuan</h4>
                <div id="form_fields_container" class="grid grid-cols-2 gap-x-4 gap-y-2">
                    <!-- Dynamic fields go here -->
                </div>
            </div>
            
            <form id="setujuiForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <!-- Input Nomor dan Kode Surat -->
                <div class="grid grid-cols-2 gap-4 items-start">
                    <div>
                        <label for="no_surat_part" class="block text-xs font-bold text-gray-700 mb-1">
                            Nomor Surat <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="no_surat_part" 
                            placeholder="Contoh: 140" 
                            aria-label="Nomor Surat"
                            title="Nomor Surat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-100 text-gray-900 text-sm focus:outline-none" 
                            required
                        >
                        <p class="text-xs text-gray-700 font-medium mt-1">Hanya isi nomor surat</p>
                    </div>
                    <div>
                        <label for="kode_surat_part" class="block text-xs font-bold text-gray-700 mb-1">
                            Kode Surat <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="kode_surat_part" 
                            placeholder="Contoh: SKM" 
                            aria-label="Kode Surat"
                            title="Kode Surat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-100 text-gray-900 text-sm focus:outline-none" 
                            required
                        >
                        <p class="text-xs text-gray-700 font-medium mt-1">Hanya isi kode surat</p>
                    </div>
                </div>

                <!-- Preview Nomor Surat -->
                <div>
                    <span class="block text-xs font-bold text-gray-700 uppercase mb-1">Preview Nomor Surat (Akan Digenerate Otomatis)</span>
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-3.5 text-center font-mono text-base tracking-wider text-gray-900 relative overflow-hidden" id="preview_nomor_surat_box">
                        <span id="preview_nomor_surat_text">140/SKM/HM/2008/VI/2026</span>
                    </div>
                </div>

                <input type="hidden" id="nomor_surat" name="nomor_surat">

                <!-- Warning Note -->
                <div class="flex items-start gap-2.5 rounded-lg bg-amber-50 border border-amber-100 p-3 text-[11px] text-amber-900 leading-normal">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-amber-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.008v.008H12v-.008Z" />
                    </svg>
                    <div>
                        <strong class="font-bold block mb-0.5">Pastikan nomor dan kode surat sudah benar.</strong>
                        Nomor surat akan digunakan pada dokumen yang dihasilkan sistem.
                    </div>
                </div>

                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="closeSetujuiModal()" title="Batal dan Tutup" aria-label="Batal dan Tutup"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-800 rounded-lg hover:bg-red-100 transition-colors text-sm font-bold">
                        Batal
                    </button>
                    <button type="submit" id="setujuiSubmitBtn" title="Setujui & Hasilkan Surat" aria-label="Setujui & Hasilkan Surat"
                        class="px-5 py-2 bg-emerald-800 hover:bg-emerald-900 text-white rounded-lg transition-colors text-sm font-bold shadow-sm">
                        Setujui & Hasilkan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tolak dengan Alasan --}}
    <div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-2xl w-full mx-4">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Tolak Pengajuan Surat</h3>
                </div>
                <button type="button" onclick="closeTolakModal()" title="Tutup Modal" aria-label="Tutup Modal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="sr-only">Tutup Modal</span>
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="tolakForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <!-- Data Pengajuan -->
                <div class="bg-gray-50/70 rounded-xl border border-gray-200/50 p-4 mb-4 text-xs">
                    <h4 class="font-bold text-gray-700 uppercase tracking-wider mb-3">DATA PENGAJUAN</h4>
                    <div id="tolak_form_fields_container" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2.5">
                        <!-- Dynamic fields go here -->
                    </div>
                </div>

                <div>
                    <label for="alasan_tolak" class="block text-xs font-bold text-gray-700 uppercase mb-1">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="alasan_tolak" 
                        name="alasan_tolak" 
                        rows="4"
                        placeholder="Jelaskan alasan penolakan dengan jelas..."
                        aria-label="Alasan Penolakan"
                        title="Alasan Penolakan"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-100 text-gray-900 text-sm resize-none"
                        required
                        minlength="5"
                        maxlength="500"
                    ></textarea>
                    <p class="text-xs text-gray-700 font-medium mt-1">Min. 5 karakter</p>
                </div>

                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="closeTolakModal()" title="Batal dan Tutup" aria-label="Batal dan Tutup"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-800 rounded-lg hover:bg-red-100 transition-colors text-sm font-bold">
                        Batal
                    </button>
                    <button type="submit" id="tolakSubmitBtn" title="Tolak Pengajuan" aria-label="Tolak Pengajuan"
                        class="px-5 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors text-sm font-bold shadow-sm">
                        Tolak Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let isSetujuiConfirmed = false;
        let isTolakConfirmed = false;

        function openSetujuiModal(id, pemohon, jenisSurat, tanggal, adminName, fieldsJson) {
            isSetujuiConfirmed = false;
            // Gunakan url() helper — tidak enkode karakter apa pun
            const base = "{{ url('/admin/layanan-surat/request') }}";
            document.getElementById('setujuiForm').action = base + '/' + id + '/setujui';

            // Populate Form Fields
            const fieldsContainer = document.getElementById('form_fields_container');
            fieldsContainer.innerHTML = '';
            
            let fields = {};
            try {
                fields = JSON.parse(fieldsJson);
            } catch (e) {
                console.error(e);
            }

            const keys = Object.keys(fields);
            if (keys.length > 0) {
                keys.forEach(key => {
                    const item = document.createElement('div');
                    item.className = 'flex justify-between border-b border-gray-100 pb-1';
                    
                    const labelSpan = document.createElement('span');
                    labelSpan.className = 'text-gray-700 font-medium';
                    labelSpan.textContent = key;
                    
                    const valueSpan = document.createElement('span');
                    valueSpan.className = 'font-semibold text-gray-800 text-right truncate pl-2 max-w-[220px]';
                    valueSpan.textContent = fields[key];
                    valueSpan.title = fields[key];
                    
                    item.appendChild(labelSpan);
                    item.appendChild(valueSpan);
                    fieldsContainer.appendChild(item);
                });
            } else {
                const emptyMsg = document.createElement('div');
                emptyMsg.className = 'col-span-2 text-center text-gray-600 italic py-1';
                emptyMsg.textContent = 'Tidak ada data pengajuan';
                fieldsContainer.appendChild(emptyMsg);
            }

            // Reset inputs
            document.getElementById('no_surat_part').value = '';
            document.getElementById('kode_surat_part').value = '';
            document.getElementById('nomor_surat').value = '';

            updateNomorSuratPreview();

            document.getElementById('setujuiSubmitBtn').disabled = false;
            document.getElementById('setujuiSubmitBtn').textContent = 'Setujui & Hasilkan Surat';
            document.getElementById('setujuiModal').classList.remove('hidden');
            setTimeout(() => document.getElementById('no_surat_part').focus(), 150);
        }

        function closeSetujuiModal() {
            document.getElementById('setujuiModal').classList.add('hidden');
            isSetujuiConfirmed = false;
        }

        function updateNomorSuratPreview() {
            const noSurat = document.getElementById('no_surat_part').value || '___';
            const kodeSurat = document.getElementById('kode_surat_part').value || '___';
            
            const now = new Date();
            const romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
            const currentMonth = romanMonths[now.getMonth()];
            const currentYear = now.getFullYear();
            
            const fullNumber = `${noSurat}/${kodeSurat}/HM/2008/${currentMonth}/${currentYear}`;
            document.getElementById('preview_nomor_surat_text').textContent = fullNumber;
            document.getElementById('nomor_surat').value = fullNumber;
        }

        document.getElementById('no_surat_part').addEventListener('input', updateNomorSuratPreview);
        document.getElementById('kode_surat_part').addEventListener('input', updateNomorSuratPreview);

        function openTolakModal(id, pemohon, fieldsJson) {
            isTolakConfirmed = false;
            const base = "{{ url('/admin/layanan-surat/request') }}";
            document.getElementById('tolakForm').action = base + '/' + id + '/tolak';

            const fieldsContainer = document.getElementById('tolak_form_fields_container');
            fieldsContainer.innerHTML = '';
            
            let fields = {};
            try {
                fields = JSON.parse(fieldsJson);
            } catch (e) {
                console.error(e);
            }

            const keys = Object.keys(fields);
            if (keys.length > 0) {
                keys.forEach(key => {
                    const item = document.createElement('div');
                    item.className = 'flex justify-between items-center pb-2 border-b border-gray-200/60';
                    
                    const labelSpan = document.createElement('span');
                    labelSpan.className = 'text-gray-700 font-medium';
                    labelSpan.textContent = key;
                    
                    const valueSpan = document.createElement('span');
                    valueSpan.className = 'font-bold text-gray-800 text-right truncate pl-2 max-w-[200px]';
                    valueSpan.textContent = fields[key];
                    valueSpan.title = fields[key];
                    
                    item.appendChild(labelSpan);
                    item.appendChild(valueSpan);
                    fieldsContainer.appendChild(item);
                });
            } else {
                const emptyMsg = document.createElement('div');
                emptyMsg.className = 'col-span-2 text-center text-gray-400 italic py-1';
                emptyMsg.textContent = 'Tidak ada data pengajuan';
                fieldsContainer.appendChild(emptyMsg);
            }

            document.getElementById('alasan_tolak').value = '';
            document.getElementById('tolakSubmitBtn').disabled = false;
            document.getElementById('tolakSubmitBtn').textContent = 'Tolak Pengajuan';

            document.getElementById('tolakModal').classList.remove('hidden');
            setTimeout(() => document.getElementById('alasan_tolak').focus(), 150);
        }

        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
            isTolakConfirmed = false;
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

        // Close on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closeSetujuiModal(); closeTolakModal(); }
        });

        // Loading state & confirmation saat submit
        document.getElementById('setujuiForm').addEventListener('submit', function(e) {
            if (!isSetujuiConfirmed) {
                e.preventDefault();
                updateNomorSuratPreview();
                const nomorSurat = document.getElementById('nomor_surat').value;

                Swal.fire({
                    title: 'Konfirmasi Nomor Surat',
                    html: `Apakah nomor surat <strong>"${nomorSurat}"</strong> sudah benar?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#059669', // Emerald 600
                    cancelButtonColor: '#dc2626',  // Red 600
                    confirmButtonText: 'Ya, Sudah Benar!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        isSetujuiConfirmed = true;
                        const btn = document.getElementById('setujuiSubmitBtn');
                        btn.disabled = true;
                        btn.textContent = '⏳ Memproses...';
                        this.submit();
                    }
                });
            }
        });

        document.getElementById('tolakForm').addEventListener('submit', function(e) {
            if (!isTolakConfirmed) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Tolak',
                    text: 'Apakah Anda yakin ingin menolak pengajuan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626', // Red 600
                    cancelButtonColor: '#6b7280', // Gray 500
                    confirmButtonText: 'Ya, Tolak!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        isTolakConfirmed = true;
                        const btn = document.getElementById('tolakSubmitBtn');
                        btn.disabled = true;
                        btn.textContent = '⏳ Memproses...';
                        this.submit();
                    }
                });
            }
        });

        // Auto refresh jika ada pengajuan surat baru
        const currentTotalMenunggu = {{ $totalMenunggu }};
        const currentLatestId = "{{ $pengajuanSurat->first()?->id_pengajuan_surat ?? '' }}";

        function checkNewSubmissions() {
            // Hanya jalankan auto-check jika modal sedang tertutup untuk menghindari gangguan user
            const isSetujuiModalOpen = !document.getElementById('setujuiModal').classList.contains('hidden');
            const isTolakModalOpen = !document.getElementById('tolakModal').classList.contains('hidden');
            if (isSetujuiModalOpen || isTolakModalOpen) return;

            fetch("{{ route('admin.layanan-surat.request.check-new') }}")
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        if (data.total_menunggu !== currentTotalMenunggu || String(data.latest_id) !== currentLatestId) {
                            window.location.reload();
                        }
                    }
                })
                .catch(err => console.error('Error checking new requests:', err));
        }

        // Jalankan pengecekan setiap 5 detik
        setInterval(checkNewSubmissions, 5000);
    </script>
</x-layouts.layouts>