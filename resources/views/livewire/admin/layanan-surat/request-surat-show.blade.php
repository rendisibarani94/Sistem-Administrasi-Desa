<x-layouts.layouts>
    <x-slot:judul>
        Detail Pengajuan Surat
    </x-slot:judul>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mx-4 mb-4 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm mx-4 border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 pt-6 pb-4 border-b border-gray-100">
            <div class="space-y-4">
                <div>
                    <a href="{{ route('admin.layanan-surat.request.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Kembali
                    </a>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Detail Pengajuan Surat</h1>
                    <nav class="mt-1" aria-label="Breadcrumb">
                        <ol class="flex items-center gap-1.5 text-sm text-gray-400">
                            <li>
                                <a href="{{ route('beranda.admin') }}" class="flex items-center gap-1 hover:text-sky-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    <span translate="no">Dashboard</span>
                                </a>
                            </li>
                            <li class="text-gray-300">/</li>
                            <li>
                                <a href="{{ route('admin.layanan-surat.request.index') }}" class="flex items-center gap-1 hover:text-sky-600 transition-colors">
                                    Pengajuan Surat
                                </a>
                            </li>
                            <li class="text-gray-300">/</li>
                            <li class="font-medium text-gray-600">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="px-6 py-6 space-y-6">
        @php
            // Safely parse data_form (support both stored JSON string and array)
            $dataForm = $pengajuanSurat->data_form;
            if (is_string($dataForm)) {
                $dataForm = json_decode($dataForm, true) ?? [];
            }
            if (!is_array($dataForm)) {
                $dataForm = [];
            }

            // Robust Lookup Pemohon: cari relasi penduduk, atau cari user pemohon lalu relasi penduduknya
            $pemohon = $pengajuanSurat->penduduk;
            $userPemohon = null;
            if (!$pemohon) {
                $userPemohon = \App\Models\User::where('id_penduduk', $pengajuanSurat->id_penduduk)
                    ->orWhere('id', $pengajuanSurat->id_penduduk)
                    ->first();
                if ($userPemohon) {
                    $pemohon = $userPemohon->penduduk;
                }
            }

            // Fallback: get applicant name/NIK from data_form if relations are null
            $namaFallback = $pemohon?->nama_lengkap 
                ?? $userPemohon?->name
                ?? $dataForm['nama'] 
                ?? $dataForm['nama_lengkap'] 
                ?? '-';
            $nikFallback  = $pemohon?->nik 
                ?? $userPemohon?->nik
                ?? $dataForm['nik'] 
                ?? '-';
            $alamatFallback = $pemohon?->alamat 
                ?? $dataForm['alamat'] 
                ?? '-';
        @endphp
            {{-- Info Pemohon --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-100">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Informasi Pemohon</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Nama</p>
                            <p class="text-sm font-medium text-gray-800">{{ $namaFallback }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">NIK</p>
                            <p class="text-sm font-medium text-gray-800">{{ $nikFallback }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Alamat</p>
                            <p class="text-sm font-medium text-gray-800">{{ $alamatFallback }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Informasi Request</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Jenis Surat</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->jenisSurat->nama_surat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Status</p>
                            @php
                                $status = strtolower($pengajuanSurat->status);
                                $badgeClass = match($status) {
                                    'diajukan'  => 'bg-amber-100 text-amber-800',
                                    'diproses'  => 'bg-blue-100 text-blue-800',
                                    'selesai'   => 'bg-green-100 text-green-800',
                                    'ditolak'   => 'bg-red-100 text-red-800',
                                    default     => 'bg-gray-100 text-gray-800',
                                };
                                $badgeLabel = match($status) {
                                    'diajukan'  => 'Menunggu',
                                    'diproses'  => 'Diproses',
                                    'selesai'   => 'Disetujui',
                                    'ditolak'   => 'Ditolak',
                                    default     => ucfirst($pengajuanSurat->status),
                                };
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                {{ $badgeLabel }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Tanggal Pengajuan</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Pengajuan --}}
            @if (count($dataForm) > 0 || ($pengajuanSurat->detailPengajuanSurat && $pengajuanSurat->detailPengajuanSurat->count() > 0))
                @php
                    $renderedKeys = [];
                @endphp
                <div class="pb-6 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Data Pengajuan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Data Form Web --}}
                        @foreach ($dataForm as $key => $value)
                            @php
                                $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $key));
                                $renderedKeys[$normalized] = true;
                                $isFile = is_string($value) && (str_starts_with($value, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $value));
                                
                                $label = ucfirst(str_replace('_', ' ', $key));
                                if (strtolower($label) === 'nik') {
                                    $label = 'NIK';
                                }
                            @endphp
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                <p class="text-xs text-gray-500 font-medium mb-2">{{ $label }}</p>
                                @if($isFile && $value)
                                    <div class="space-y-2">
                                        <a href="{{ asset('storage/' . $value) }}" target="_blank"
                                            class="block overflow-hidden rounded-lg border border-gray-200 hover:border-sky-400 transition-colors">
                                            <img src="{{ asset('storage/' . $value) }}"
                                                alt="{{ ucfirst(str_replace('_', ' ', $key)) }}"
                                                class="w-full h-36 object-cover"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div style="display:none" class="p-3 text-xs text-sky-600 font-semibold">Lihat Berkas (klik untuk buka)</div>
                                        </a>
                                        <a href="{{ asset('storage/' . $value) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-xs text-sky-600 hover:underline font-medium">Buka di tab baru</a>
                                    </div>
                                @else
                                    <p class="text-sm font-medium text-gray-800">{{ $value ?? '-' }}</p>
                                @endif
                            </div>
                        @endforeach

                        {{-- Data EAV Mobile --}}
                        @foreach ($pengajuanSurat->detailPengajuanSurat as $detail)
                            @php
                                $namaField = $detail->persyaratanSurat?->nama_field ?? "Field #{$detail->persyaratan_id}";
                                $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $namaField));
                                if (isset($renderedKeys[$normalized])) {
                                    continue;
                                }
                                $renderedKeys[$normalized] = true;

                                $tipeField = $detail->persyaratanSurat?->tipe_field ?? 'text';
                                $val       = $detail->value;
                                $isFile    = $tipeField === 'file_image' || (is_string($val) && str_starts_with($val, 'pengajuan/'));

                                $labelField = $namaField;
                                if (strtolower($labelField) === 'nik') {
                                    $labelField = 'NIK';
                                }
                            @endphp
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                <p class="text-xs text-gray-500 font-medium mb-2">{{ $labelField }}</p>
                                @if ($isFile && $val)
                                    <div class="space-y-2">
                                        <a href="{{ asset('storage/' . $val) }}" target="_blank"
                                            class="block overflow-hidden rounded-lg border border-gray-200 hover:border-sky-400 transition-colors">
                                            <img src="{{ asset('storage/' . $val) }}"
                                                alt="{{ $namaField }}"
                                                class="w-full h-36 object-cover"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div style="display:none" class="p-3 text-xs text-sky-600 font-semibold">Lihat Berkas (klik untuk buka)</div>
                                        </a>
                                        <a href="{{ asset('storage/' . $val) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-xs text-sky-600 hover:underline font-medium">Buka di tab baru</a>
                                    </div>
                                @elseif ($val)
                                    <p class="text-sm font-medium text-gray-800">{{ $val }}</p>
                                @else
                                    <p class="text-sm text-gray-400 italic">— Tidak diisi —</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Informasi Respons --}}
            <div class="pb-6 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-600 mb-4">Informasi Respons</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Diproses Oleh</p>
                        <p class="text-sm font-medium text-gray-800">
                            @if (in_array(strtolower($pengajuanSurat->status), ['selesai', 'ditolak']))
                                {{ $pengajuanSurat->diprosesOleh?->nama ?? (\App\Models\KepalaDesa::where('is_active', true)->first()?->nama ?? 'Kepala Desa') }}
                            @else
                                Belum diproses
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Tanggal Respons</p>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $pengajuanSurat->tanggal_respons?->format('d M Y H:i') ?? '-' }}
                        </p>
                    </div>
                    @if ($pengajuanSurat->status === 'ditolak' && $pengajuanSurat->alasan_tolak)
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-500 mb-1">Alasan Penolakan</p>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-sm text-red-800">
                                {{ $pengajuanSurat->alasan_tolak }}
                            </div>
                        </div>
                    @endif
                    @if ($pengajuanSurat->status === 'selesai')
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Tanggal Selesai</p>
                            <p class="text-sm font-medium text-gray-800">
                                {{ $pengajuanSurat->tanggal_selesai?->format('d M Y H:i') ?? '-' }}
                            </p>
                        </div>
                        @if ($pengajuanSurat->nomor_surat)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nomor Surat</p>
                                <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->nomor_surat }}</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Aksi --}}
            @if (auth()->user()->role === 'admin' && $pengajuanSurat->status === 'diajukan')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button"
                        data-id="{{ $pengajuanSurat->id_pengajuan_surat }}"
                        data-pemohon="{{ $namaFallback }}"
                        onclick="openSetujuiModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'))"
                        class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-green-600 hover:bg-green-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Setujui Pengajuan
                    </button>

                    <button type="button" 
                        data-id="{{ $pengajuanSurat->id_pengajuan_surat }}"
                        data-pemohon="{{ $namaFallback }}"
                        onclick="openTolakModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'))"
                        class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-red-600 hover:bg-red-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Tolak Pengajuan
                    </button>

                    {{-- Tombol Cetak Surat (preview sebelum disetujui) --}}
                    <a href="{{ route('admin.layanan-surat.request.print', $pengajuanSurat->id_pengajuan_surat) }}"
                        target="_blank"
                        class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-purple-600 hover:bg-purple-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                        Cetak Surat
                    </a>
                </div>
            @endif

            @if ($pengajuanSurat->status === 'selesai')
                <div class="flex flex-wrap gap-3">
                    {{-- Cetak Surat Resmi (selalu tersedia bila selesai) --}}
                    <a href="{{ route('admin.layanan-surat.request.print', $pengajuanSurat->id_pengajuan_surat) }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg bg-purple-600 hover:bg-purple-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                        Cetak Surat Resmi
                    </a>
                    @if ($pengajuanSurat->file_pdf)
                    {{-- Unduh scan PDF yang diupload admin (jika ada) --}}
                    <a href="{{ route('admin.layanan-surat.request.download', $pengajuanSurat->id_pengajuan_surat) }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Unduh Surat Scan
                    </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Setujui --}}
    <div id="setujuiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4">
            <div class="flex items-center gap-3 mb-5">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Setujui Pengajuan Surat</h3>
            </div>
            
            <form id="setujuiForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Pemohon</label>
                    <input type="text" id="pemohon_setuju" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm">
                </div>

                <div>
                    <label for="nomor_surat" class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                        Nomor Surat <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nomor_surat" 
                        name="nomor_surat" 
                        placeholder="Contoh: 140/025/SKD/V/2026" 
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-100 text-gray-700 text-sm" 
                        required
                    >
                </div>

                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="closeSetujuiModal()"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-semibold">
                        Batal
                    </button>
                    <button type="submit" id="setujuiSubmitBtn"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                        Setujui 
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4">
            <div class="flex items-center gap-3 mb-5">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Tolak Pengajuan Surat</h3>
            </div>
            
            <form id="tolakForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Pemohon</label>
                    <input type="text" id="pemohon" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm">
                </div>

                <div>
                    <label for="alasan_tolak" class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="alasan_tolak" 
                        name="alasan_tolak" 
                        rows="4"
                        placeholder="Jelaskan alasan penolakan dengan jelas..."
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-100 text-gray-700 text-sm resize-none"
                        required
                        minlength="5"
                        maxlength="500"
                    ></textarea>
                    <p class="text-xs text-gray-400 mt-1">Min. 5 karakter</p>
                </div>

                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="closeTolakModal()"
                        class="px-4 py-2 border border-red-300 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-semibold">
                        Batal
                    </button>
                    <button type="submit" id="tolakSubmitBtn"
                        class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                        Tolak Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSetujuiModal(id, pemohon) {
            // Gunakan url() helper — tidak enkode karakter apa pun
            const base = "{{ url('/admin/layanan-surat/request') }}";
            document.getElementById('setujuiForm').action = base + '/' + id + '/setujui';

            // Reset field satu per satu — JANGAN gunakan form.reset() (akan menghapus CSRF token)
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
            const base = "{{ url('/admin/layanan-surat/request') }}";
            document.getElementById('tolakForm').action = base + '/' + id + '/tolak';

            document.getElementById('pemohon').value = pemohon;
            document.getElementById('alasan_tolak').value = '';
            document.getElementById('tolakSubmitBtn').disabled = false;
            document.getElementById('tolakSubmitBtn').textContent = 'Tolak Pengajuan';

            document.getElementById('tolakModal').classList.remove('hidden');
            setTimeout(() => document.getElementById('alasan_tolak').focus(), 150);
        }

        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
        }

        // Loading state saat submit
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

        // Close on backdrop click
        ['setujuiModal', 'tolakModal'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) this.classList.add('hidden');
            });
        });

        // Close on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closeSetujuiModal(); closeTolakModal(); }
        });
    </script>

</x-layouts.layouts>
