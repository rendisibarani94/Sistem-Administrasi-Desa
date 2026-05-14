<div>
    <x-slot:judul>
        Notifikasi Sistem
    </x-slot:judul>

    <div class="bg-white rounded-lg shadow-md mx-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Notifikasi Sistem</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="flex justify-between mx-4 mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Notifikasi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 mb-6">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Request Surat Baru</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $countNewRequests }}</p>
                    </div>
                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Pengaduan Baru</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $countNewPengaduan }}</p>
                    </div>
                    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">Total Belum Dibaca</p>
                        <p class="text-3xl font-bold text-green-600">{{ $countNotifications }}</p>
                    </div>
                    <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tabs Navigation --}}
        <div class="border-b border-gray-200 px-4 mb-6">
            <div class="flex gap-8">
                <button onclick="switchTab('requests')" id="requests-tab" class="py-4 px-1 border-b-2 border-sky-500 text-sky-600 font-semibold">
                    Request Surat ({{ $countNewRequests }})
                </button>
                <button onclick="switchTab('pengaduan')" id="pengaduan-tab" class="py-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-semibold hover:border-gray-300">
                    Pengaduan ({{ $countNewPengaduan }})
                </button>
                <button onclick="switchTab('notifikasi')" id="notifikasi-tab" class="py-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-semibold hover:border-gray-300">
                    Riwayat Notifikasi
                </button>
            </div>
        </div>

        {{-- Request Surat Content --}}
        <div id="requests-content" class="px-4 mb-6">
            @forelse($newRequests as $item)
                <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->jenisSurat?->nama_surat ?? 'Surat Tidak Diketahui' }}</h3>
                            <p class="text-sm text-gray-600">Dari: <strong>{{ $item->penduduk?->nama_lengkap ?? 'Tidak diketahui' }}</strong> (NIK: {{ $item->penduduk?->nik ?? '-' }})</p>
                            <p class="text-xs text-gray-500">{{ $item->created_at?->format('d M Y H:i') ?? '' }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            Menunggu Review
                        </span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.layanan-surat.request.show', $item->id_pengajuan_surat) }}" class="inline-flex items-center px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Review & Proses
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-4 text-gray-500 font-semibold">Tidak ada request surat baru</p>
                </div>
            @endforelse
        </div>

        {{-- Pengaduan Content --}}
        <div id="pengaduan-content" class="px-4 mb-6 hidden">
            @forelse($newPengaduan as $item)
                <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-600">Dari: <strong>{{ $item->user?->name ?? 'Tidak diketahui' }}</strong></p>
                            <p class="text-sm text-gray-700 mt-3 p-3 bg-gray-50 rounded">{{ $item->isi }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $item->created_at?->format('d M Y H:i') ?? '' }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 ml-4">
                            Terkirim
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-4 text-gray-500 font-semibold">Tidak ada pengaduan baru</p>
                </div>
            @endforelse
        </div>

        {{-- Notifikasi History Content --}}
        <div id="notifikasi-content" class="px-4 mb-6 hidden">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Pesan</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifikasi as $item)
                            <tr class="border-b hover:bg-gray-50 {{ !$item->is_read ? 'bg-blue-50' : '' }}">
                                <td class="px-4 py-3 font-semibold {{ !$item->is_read ? 'text-blue-900' : 'text-gray-900' }}">
                                    {{ $item->judul }}
                                </td>
                                <td class="px-4 py-3">{{ Str::limit($item->pesan, 100) }}</td>
                                <td class="px-4 py-3 text-xs whitespace-nowrap">{{ $item->created_at?->format('d M Y H:i') ?? '' }}</td>
                                <td class="px-4 py-3">
                                    @if($item->is_read)
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">
                                            Dibaca
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                            Baru
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada notifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $notifikasi->links() }}
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Hide all content divs
            document.getElementById('requests-content').classList.add('hidden');
            document.getElementById('pengaduan-content').classList.add('hidden');
            document.getElementById('notifikasi-content').classList.add('hidden');

            // Reset all tab styles
            ['requests-tab', 'pengaduan-tab', 'notifikasi-tab'].forEach(tabId => {
                document.getElementById(tabId).classList.remove('border-sky-500', 'text-sky-600');
                document.getElementById(tabId).classList.add('border-transparent', 'text-gray-600', 'hover:border-gray-300');
            });

            // Show selected content and highlight tab
            if (tab === 'requests') {
                document.getElementById('requests-content').classList.remove('hidden');
                document.getElementById('requests-tab').classList.add('border-sky-500', 'text-sky-600');
                document.getElementById('requests-tab').classList.remove('border-transparent', 'text-gray-600', 'hover:border-gray-300');
            } else if (tab === 'pengaduan') {
                document.getElementById('pengaduan-content').classList.remove('hidden');
                document.getElementById('pengaduan-tab').classList.add('border-sky-500', 'text-sky-600');
                document.getElementById('pengaduan-tab').classList.remove('border-transparent', 'text-gray-600', 'hover:border-gray-300');
            } else if (tab === 'notifikasi') {
                document.getElementById('notifikasi-content').classList.remove('hidden');
                document.getElementById('notifikasi-tab').classList.add('border-sky-500', 'text-sky-600');
                document.getElementById('notifikasi-tab').classList.remove('border-transparent', 'text-gray-600', 'hover:border-gray-300');
            }
        }
    </script>
</div>
