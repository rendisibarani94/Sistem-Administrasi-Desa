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
            if ($nikFallback !== '-') {
                $cleanNik = str_replace(' ', '', $nikFallback);
                if (strlen($cleanNik) === 16) {
                    $nikFallback = implode(' ', str_split($cleanNik, 4));
                }
            }
            $alamatFallback = $pemohon?->alamat 
                ?? $dataForm['alamat'] 
                ?? '-';

            // Extract form fields for setujui modal
            $formFields = [];
            $normalizedKeys = [];
            if (is_array($dataForm)) {
                foreach ($dataForm as $key => $value) {
                    $isFile = is_string($value) && (str_starts_with($value, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $value));
                    if (!$isFile && $value) {
                        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $key));
                        if (isset($normalizedKeys[$normalized])) {
                            continue;
                        }
                        $normalizedKeys[$normalized] = true;

                        $label = ucfirst(str_replace('_', ' ', $key));
                        if (strtolower($label) === 'nik') {
                            $label = 'NIK';
                        }
                        $formFields[$label] = $value;
                    }
                }
            }
            if ($pengajuanSurat->detailPengajuanSurat) {
                foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
                    $namaField = $detail->persyaratanSurat?->nama_field ?? "Field #{$detail->persyaratan_id}";
                    $tipeField = $detail->persyaratanSurat?->tipe_field ?? 'text';
                    $val = $detail->value;
                    $isFile = $tipeField === 'file_image' || (is_string($val) && str_starts_with($val, 'pengajuan/'));
                    if (!$isFile && $val) {
                        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $namaField));
                        if (isset($normalizedKeys[$normalized])) {
                            continue;
                        }
                        $normalizedKeys[$normalized] = true;

                        $label = $namaField;
                        if (strtolower($label) === 'nik') {
                            $label = 'NIK';
                        }
                        $formFields[$label] = $val;
                    }
                }
            }
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
                    $imagesList = [];
                    $textFieldsList = [];

                    // 1. Process dataForm (Web)
                    foreach ($dataForm as $key => $value) {
                        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $key));
                        $renderedKeys[$normalized] = true;
                        
                        $isFile = is_string($value) && (str_starts_with($value, 'pengajuan/') || preg_match('/\.(jpg|jpeg|png|webp|gif|pdf)$/i', $value));
                        $label = ucfirst(str_replace('_', ' ', $key));
                        if (strtolower($label) === 'nik') {
                            $label = 'NIK';
                        }
                        $displayVal = $value;
                        if (in_array(strtolower($label), ['nik', 'kk', 'no kk', 'no. kk', 'no.kk', 'nomor kk', 'nomor kartu keluarga'])) {
                            $cleanVal = str_replace(' ', '', $value);
                            if (strlen($cleanVal) === 16) {
                                $displayVal = implode(' ', str_split($cleanVal, 4));
                            }
                        }

                        if ($isFile && $value) {
                            $imagesList[] = [
                                'label' => $label,
                                'value' => $value
                            ];
                        } else {
                            $textFieldsList[] = [
                                'label' => $label,
                                'value' => $displayVal ?? '-'
                            ];
                        }
                    }

                    // 2. Process detailPengajuanSurat (Mobile EAV)
                    if ($pengajuanSurat->detailPengajuanSurat) {
                        foreach ($pengajuanSurat->detailPengajuanSurat as $detail) {
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
                            $displayVal = $val;
                            if (in_array(strtolower($labelField), ['nik', 'kk', 'no kk', 'no. kk', 'no.kk', 'nomor kk', 'nomor kartu keluarga'])) {
                                $cleanVal = str_replace(' ', '', $val);
                                if (strlen($cleanVal) === 16) {
                                    $displayVal = implode(' ', str_split($cleanVal, 4));
                                }
                            }

                            if ($isFile && $val) {
                                $imagesList[] = [
                                    'label' => $labelField,
                                    'value' => $val
                                ];
                            } else {
                                $textFieldsList[] = [
                                    'label' => $labelField,
                                    'value' => $displayVal ?? '-'
                                ];
                            }
                        }
                    }
                @endphp

                <div class="pb-6 border-b border-gray-100 space-y-6">
                    <h3 class="text-sm font-semibold text-gray-600">Data Pengajuan</h3>
                    
                    {{-- Lampiran Gambar di bagian atas (diperbesar) --}}
                    @if (count($imagesList) > 0)
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Berkas Lampiran (KTP / KK)</h4>
                            <div class="grid grid-cols-1 gap-6">
                                @foreach ($imagesList as $img)
                                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                        <p class="text-xs text-gray-500 font-bold mb-3">{{ $img['label'] }}</p>
                                        <div class="space-y-3">
                                            <a href="{{ asset('storage/' . $img['value']) }}" target="_blank"
                                                class="block overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm hover:border-sky-500 hover:shadow transition-all text-center">
                                                <img src="{{ asset('storage/' . $img['value']) }}"
                                                    alt="{{ $img['label'] }}"
                                                    class="mx-auto w-full max-h-[550px] object-contain p-2"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <div style="display:none" class="p-4 text-sm text-sky-600 font-semibold">Lihat Berkas (klik untuk buka)</div>
                                            </a>
                                            <div class="flex justify-between items-center px-1">
                                                <span class="text-xs text-gray-400 font-mono">{{ basename($img['value']) }}</span>
                                                <a href="{{ asset('storage/' . $img['value']) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 text-xs text-sky-600 hover:text-sky-800 font-bold hover:underline font-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                    </svg>
                                                    Lihat Detail Foto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Data Isian Teks di bawah --}}
                    @if (count($textFieldsList) > 0)
                        <div class="space-y-4">
                            @if (count($imagesList) > 0)
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Formulir Isian</h4>
                            @endif
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($textFieldsList as $txt)
                                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                        <p class="text-xs text-gray-500 font-medium mb-1">{{ $txt['label'] }}</p>
                                        <p class="text-sm font-semibold text-gray-800">{{ $txt['value'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
                        data-jenis="{{ $pengajuanSurat->jenisSurat->nama_surat ?? '-' }}"
                        data-tanggal="{{ $pengajuanSurat->created_at->format('d M Y') }}"
                        data-admin="{{ \App\Models\KepalaDesa::where('is_active', true)->first()?->nama ?? 'Kepala Desa' }}"
                        data-fields="{{ json_encode($formFields) }}"
                        onclick="openSetujuiModal(
                            this.getAttribute('data-id'),
                            this.getAttribute('data-pemohon'),
                            this.getAttribute('data-jenis'),
                            this.getAttribute('data-tanggal'),
                            this.getAttribute('data-admin'),
                            this.getAttribute('data-fields')
                        )"
                        class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-green-600 hover:bg-green-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Setujui Pengajuan
                    </button>

                    <button type="button" 
                        data-id="{{ $pengajuanSurat->id_pengajuan_surat }}"
                        data-pemohon="{{ $namaFallback }}"
                        data-fields="{{ json_encode($formFields) }}"
                        onclick="openTolakModal(this.getAttribute('data-id'), this.getAttribute('data-pemohon'), this.getAttribute('data-fields'))"
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Preview Surat
                    </a>
                </div>
            @endif

            @if ($pengajuanSurat->status === 'selesai')
                <div class="space-y-6">
                    <div class="flex flex-wrap gap-3">
                        {{-- Cetak Surat Resmi (selalu tersedia bila selesai) --}}
                        <a href="{{ route('admin.layanan-surat.request.print', $pengajuanSurat->id_pengajuan_surat) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-purple-600 hover:bg-purple-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.056 48.056 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                            Pratinjau Surat
                        </a>
                        @if ($pengajuanSurat->file_pdf)
                        {{-- Unduh scan PDF/Gambar yang diupload admin (jika ada) --}}
                        <a href="{{ route('admin.layanan-surat.request.download', $pengajuanSurat->id_pengajuan_surat) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Unduh Surat 
                        </a>
                        @endif
                    </div>

                    {{-- Form Upload Foto/Scan yang sudah TTD Basah --}}
                    <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Upload Scan / Foto Surat TTD Basah Kepala Desa
                        </h4>
                        <p class="text-xs text-gray-500 mb-4">
                            Kirimkan file PDF atau foto (JPG, JPEG, PNG) surat yang sudah ditandatangani basah oleh Kepala Desa agar masyarakat dapat mengunduhnya di aplikasi mereka.
                        </p>
                        <form action="{{ route('admin.layanan-surat.request.upload-scan', $pengajuanSurat->id_pengajuan_surat) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <input type="file" name="file_pdf" accept=".pdf,image/png,image/jpeg,image/jpg" required
                                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 border border-gray-300 rounded-lg p-1 bg-white">
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-4 py-2 text-xs font-semibold text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                    </svg>
                                    Unggah File
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Setujui --}}
    <div id="setujuiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-2xl w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Setujui Pengajuan Surat</h3>
                </div>
                <button type="button" onclick="closeSetujuiModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Banner info -->
            <div class="mb-4 flex items-start gap-3 rounded-lg border border-blue-100 bg-blue-50 p-3 text-xs text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.053 1.053l-.042.02.042.02a.75.75 0 1 1-1.053-1.053l.042-.02ZM12 21a9 9 0 1 1 0-18 9 9 0 0 1 0 18Zm0-12.75h.008v.008H12v-.008Z" />
                </svg>
                <div>
                    <strong class="font-semibold block mb-0.5">Isi nomor dan kode surat saja.</strong>
                    <span class="text-blue-600">Jenis surat, bulan, dan tahun akan digenerate otomatis oleh sistem.</span>
                </div>
            </div>

            <!-- Data Pengajuan -->
            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200 text-xs mb-4">
                <h4 class="font-bold text-gray-500 uppercase tracking-wider mb-2">Data Pengajuan</h4>
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
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-100 text-gray-700 text-sm focus:outline-none" 
                            required
                        >
                        <p class="text-[10px] text-gray-400 mt-1">Hanya isi nomor surat</p>
                    </div>
                    <div>
                        <label for="kode_surat_part" class="block text-xs font-bold text-gray-700 mb-1">
                            Kode Surat <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="kode_surat_part" 
                            placeholder="Contoh: SKM" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-100 text-gray-700 text-sm focus:outline-none" 
                            required
                        >
                        <p class="text-[10px] text-gray-400 mt-1">Hanya isi kode surat</p>
                    </div>
                </div>

                <!-- Preview Nomor Surat -->
                <div>
                    <span class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Preview Nomor Surat (Akan Digenerate Otomatis)</span>
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-3.5 text-center font-mono text-base tracking-wider text-gray-800 relative overflow-hidden" id="preview_nomor_surat_box">
                        <span id="preview_nomor_surat_text">140/SKM/HM/2008/VI/2026</span>
                    </div>
                </div>

                <input type="hidden" id="nomor_surat" name="nomor_surat">

                <!-- Warning Note -->
                <div class="flex items-start gap-2.5 rounded-lg bg-amber-50 border border-amber-100 p-3 text-[11px] text-amber-800 leading-normal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.008v.008H12v-.008Z" />
                    </svg>
                    <div>
                        <strong class="font-semibold block mb-0.5">Pastikan nomor dan kode surat sudah benar.</strong>
                        Nomor surat akan digunakan pada dokumen yang dihasilkan sistem.
                    </div>
                </div>

                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" onclick="closeSetujuiModal()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                        Batal
                    </button>
                    <button type="submit" id="setujuiSubmitBtn"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                        Setujui & Hasilkan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl p-6 max-w-2xl w-full mx-4">
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
                
                <!-- Data Pengajuan -->
                <div class="bg-gray-50/70 rounded-xl border border-gray-200/50 p-4 mb-4 text-xs">
                    <h4 class="font-bold text-gray-500 uppercase tracking-wider mb-3">DATA PENGAJUAN</h4>
                    <div id="tolak_form_fields_container" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2.5">
                        <!-- Dynamic fields go here -->
                    </div>
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
                    labelSpan.className = 'text-gray-500';
                    labelSpan.textContent = key;
                    
                    const valueSpan = document.createElement('span');
                    valueSpan.className = 'font-semibold text-gray-800 text-right truncate pl-2 max-w-[220px]';
                    let displayVal = fields[key];
                    const keyLower = key.toLowerCase().trim();
                    if (keyLower === 'nik' || keyLower === 'kk' || keyLower.includes('kartu keluarga') || keyLower.includes('induk kependudukan')) {
                        const cleanVal = String(displayVal).replace(/\s+/g, '');
                        if (cleanVal.length === 16) {
                            displayVal = cleanVal.replace(/(\d{4})(?=\d)/g, '$1 ');
                        }
                    }
                    valueSpan.textContent = displayVal;
                    valueSpan.title = displayVal;
                    
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
                    labelSpan.className = 'text-gray-400';
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

        // Close on backdrop click
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
    </script>

</x-layouts.layouts>
