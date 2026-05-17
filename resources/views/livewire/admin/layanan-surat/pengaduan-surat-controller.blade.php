<div>
    <x-slot:judul>
        Pengaduan Surat
    </x-slot:judul>

    <div class="bg-white rounded-xl shadow-sm mx-4 border border-gray-100 overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-100">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Pengaduan Surat</h1>
                </div>
                <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li>
                            <a href="{{ route('beranda.admin') }}" class="inline-flex items-center gap-1 text-gray-500 hover:text-sky-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </li>
                        <li class="font-semibold text-gray-700">Pengaduan Surat</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-100">
            <form method="GET" action="{{ route('admin.layanan-surat.pengaduan') }}">
                <div class="max-w-md">
                    <label for="search" class="sr-only">Cari pengaduan</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center ps-3">
                            <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input id="search" name="search" type="search" value="{{ request('search') }}" placeholder="Cari judul, isi, atau pengirim"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-3 pl-10 pr-4 text-sm text-gray-700 placeholder:text-gray-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto px-6 py-6">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 w-12">No</th>
                        <th scope="col" class="px-4 py-3">Subjek</th>
                        <th scope="col" class="px-4 py-3">Isi Pengaduan</th>
                        <th scope="col" class="px-4 py-3">Pengirim</th>
                        <th scope="col" class="px-4 py-3">Catatan Admin</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Dibuat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($pengaduan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 font-semibold text-gray-800">{{ $item->judul }}</td>
                            <td class="px-4 py-4 text-gray-600 whitespace-normal max-w-[360px]">{{ Str::limit($item->isi, 80) }}</td>
                            <td class="px-4 py-4 text-gray-700">{{ $item->user?->name ?? 'Tidak diketahui' }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600 whitespace-normal max-w-[220px]">{{ $item->catatan_admin ?? '-' }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $item->status === 'baru' ? 'bg-yellow-100 text-yellow-700' : ($item->status === 'diproses' ? 'bg-blue-100 text-blue-700' : ($item->status === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700')) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-gray-500 font-semibold">Belum ada pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
