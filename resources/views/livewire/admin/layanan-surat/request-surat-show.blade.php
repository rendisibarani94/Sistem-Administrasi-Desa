<x-layouts.layouts>
    <x-slot:judul>
        Detail Request Surat
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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Detail Request Surat</h1>
                    <nav class="mt-1" aria-label="Breadcrumb">
                        <ol class="flex items-center gap-1.5 text-sm text-gray-400">
                            <li>
                                <a href="{{ route('beranda.admin') }}" class="flex items-center gap-1 hover:text-sky-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li class="text-gray-300">/</li>
                            <li>
                                <a href="{{ route('admin.layanan-surat.request.index') }}" class="flex items-center gap-1 hover:text-sky-600 transition-colors">
                                    Request Surat
                                </a>
                            </li>
                            <li class="text-gray-300">/</li>
                            <li class="font-medium text-gray-600">Detail</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('admin.layanan-surat.request.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Content --}}
        <div class="px-6 py-6 space-y-6">
            {{-- Info Pemohon --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-100">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Informasi Pemohon</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Nama</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->penduduk->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">NIK</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->penduduk->nik ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Alamat</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pengajuanSurat->penduduk->alamat ?? '-' }}</p>
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

            {{-- Data Form (jika ada) --}}
            @if ($pengajuanSurat->data_form && count($pengajuanSurat->data_form) > 0)
                <div class="pb-6 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-600 mb-4">Data Pengajuan</h3>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        @foreach ($pengajuanSurat->data_form as $key => $value)
                            <div class="flex gap-3">
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 mb-1">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                                    <p class="text-sm font-medium text-gray-800">{{ $value ?? '-' }}</p>
                                </div>
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
                            {{ $pengajuanSurat->diprosesOleh?->name ?? 'Belum diproses' }}
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
            @if (auth()->user()->role === 'admin' && in_array($pengajuanSurat->status, ['diajukan', 'diproses']))
                <div class="flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('admin.layanan-surat.request.setujui', $pengajuanSurat->id_pengajuan_surat) }}" method="POST" 
                        onsubmit="return confirm('Setujui request surat dari {{ $pengajuanSurat->penduduk->nama_lengkap ?? 'pemohon' }}?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-green-600 hover:bg-green-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Setujui
                        </button>
                    </form>

                    <button type="button" 
                        onclick="openTolakModal(@json($pengajuanSurat->id_pengajuan_surat), @json($pengajuanSurat->penduduk->nama_lengkap ?? 'pemohon'))"
                        class="w-full sm:w-auto inline-flex items-center gap-2 rounded-lg bg-red-600 hover:bg-red-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Tolak
                    </button>
                </div>
            @endif

            @if ($pengajuanSurat->status === 'selesai' && $pengajuanSurat->file_pdf)
                <div>
                    <a href="{{ route('admin.layanan-surat.request.download', $pengajuanSurat->id_pengajuan_surat) }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-4 py-2.5 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Unduh Surat
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Tolak dengan Alasan --}}
    <div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tolak Request Surat</h3>
            
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
                        placeholder="Jelaskan alasan penolakan request surat ini..."
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
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openTolakModal(id, pemohon) {
            const form = document.getElementById('tolakForm');
            form.reset();
            const tolakTemplate = "{{ route('admin.layanan-surat.request.tolak', ['__ID__']) }}";
            form.action = tolakTemplate.replace('__ID__', encodeURIComponent(id));
            document.getElementById('pemohon').value = pemohon;
            document.getElementById('tolakModal').classList.remove('hidden');
        }

        function closeTolakModal() {
            document.getElementById('tolakModal').classList.add('hidden');
        }

        // Close modal ketika klik di luar modal
        document.getElementById('tolakModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTolakModal();
            }
        });

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTolakModal();
            }
        });
    </script>
</div>
