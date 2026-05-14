<div>
    <x-slot:judul>
        Request Surat
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

    @if (session('error'))
        <div class="mx-4 mb-4 flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm mx-4 border border-gray-100">

        {{-- Header --}}
        <div class="px-6 pt-6 pb-4 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Request Surat</h1>
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
                            <li class="font-medium text-gray-600">Request Surat</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('admin.layanan-surat.request.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 active:bg-sky-800 px-4 py-2.5 text-sm font-medium text-white transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Request
                </a>
            </div>
        </div>

        {{-- Kartu Ringkasan --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 px-6 py-4 border-b border-gray-100">
            <div class="rounded-lg bg-gray-50 px-4 py-3">
                <p class="text-xs text-gray-500 mb-1">Total Request</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalSurat }}</p>
            </div>
            <div class="rounded-lg bg-amber-50 px-4 py-3">
                <p class="text-xs text-amber-700 mb-1">Menunggu</p>
                <p class="text-2xl font-semibold text-amber-800">{{ $totalMenunggu }}</p>
            </div>
            <div class="rounded-lg bg-green-50 px-4 py-3">
                <p class="text-xs text-green-700 mb-1">Disetujui</p>
                <p class="text-2xl font-semibold text-green-800">{{ $totalDisetujui }}</p>
            </div>
            <div class="rounded-lg bg-red-50 px-4 py-3">
                <p class="text-xs text-red-700 mb-1">Ditolak</p>
                <p class="text-2xl font-semibold text-red-800">{{ $totalDitolak }}</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="flex flex-col sm:flex-row gap-3 px-6 py-4">
            <form method="GET" action="{{ route('admin.layanan-surat.request.index') }}" class="flex flex-col sm:flex-row gap-3 w-full">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau jenis surat..."
                        class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm text-gray-700 placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                </div>
                <select name="status"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <select name="jenis"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Jenis</option>
                    @foreach ($jenisSuratList as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_surat }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    Cari
                </button>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-y border-gray-100 text-xs font-medium uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-3 text-left w-10">#</th>
                        <th class="px-6 py-3 text-left">Pemohon</th>
                        <th class="px-6 py-3 text-left">Jenis Surat</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-center w-32">Status</th>
                        <th class="px-6 py-3 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pengajuanSurat as $index => $surat)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">
                                {{ $pengajuanSurat->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sky-100 text-xs font-semibold text-sky-700">
                                        {{ strtoupper(substr($surat->penduduk->nama ?? 'N', 0, 1)) }}{{ strtoupper(substr(explode(' ', $surat->penduduk->nama ?? 'NA')[1] ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $surat->penduduk->nama ?? '-' }}</p>
                                        <p class="text-xs text-gray-400">NIK: {{ Str::mask($surat->penduduk->nik ?? '', '*', 8) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $surat->jenisSurat->nama_surat ?? '-' }}
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
                                        <form action="{{ route('admin.layanan-surat.request.setujui', $surat->id_pengajuan_surat) }}" method="POST"
                                            onsubmit="return confirm('Setujui request surat dari {{ $surat->penduduk->nama_lengkap ?? 'pemohon' }}?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Setujui"
                                                class="inline-flex items-center justify-center rounded-lg border border-green-200 bg-green-50 p-1.5 text-green-600 hover:bg-green-100 hover:text-green-700 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <button 
                                            type="button"
                                            onclick="openTolakModal({{ $surat->id_pengajuan_surat }}, '{{ $surat->penduduk->nama_lengkap ?? 'pemohon' }}')"
                                            title="Tolak"
                                            class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 p-1.5 text-red-500 hover:bg-red-100 hover:text-red-700 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
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
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada data request surat.</p>
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
            document.getElementById('pemohon').value = pemohon;
            document.getElementById('tolakForm').action = `{{ route('admin.layanan-surat.request.tolak', '') }}/${id}`;
            document.getElementById('tolakForm').reset();
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
    </script>
</div>