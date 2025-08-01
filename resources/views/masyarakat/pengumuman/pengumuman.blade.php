<x-slot:judul>
    Pengumuman Desa
</x-slot:judul>

<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-4 px-5">
        <section class="pengumuman md:col-span-3 p-5 rounded-lg">
            <div class="judul_pengumuman">
                <h1 class="text-sky-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-7 h-7 text-sky-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
                    </svg>
                    <span>Pengumuman Desa</span>
                </h1>
            </div>

            <div class="list_pengumuman md:col-span-1 p-3 ">
                <div class="container">
                    @if(!$pengumumanData->isEmpty())
                    @foreach ( $pengumumanData as $item)
                    {{-- Item --}}
                    <div class="pengumuman-item flex flex-col sm:flex-row items-start gap-3 sm:gap-4 mb-4 border-2 border-gray-300 p-3 sm:p-4 rounded-sm shadow-sm shadow-slate-400">
                        <!-- Image Section -->
                        <div class="image w-full sm:w-1/3 md:w-1/7">
                            <img src="{{ asset('storage/'. $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-auto max-h-24 sm:max-h-full object-cover p-2 sm:p-3" />
                        </div>

                        <!-- Content Section -->
                        <div class="desc w-full sm:w-2/3 md:w-3/4 self-start p-2 sm:p-3">
                            <h4 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">
                                {{ $item->judul }}
                            </h4>

                            <div class="pengumuman_date mb-4 sm:mb-6 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-sky-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <span class="text-xs sm:text-sm">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>

                            <p class="text-md sm:text-sm mb-2 sm:mb-3 text-justify">
                                {{ Str::limit(strip_tags($item->deskripsi), 465, '...') }}
                            </p>

                            <a href="{{ route('pengumuman.detail', $item->id_pengumuman) }}" class="cursor-pointer text-sky-600 text-sm underline hover:text-sky-800" data-modal-target="default-modal" data-modal-toggle="default-modal">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <x-placeholder title="Konten Pengumuman Belum Tersedia" description="Silakan hubungi admin untuk informasi lebih lanjut." showPlaceholder="true" />
                    @endif
                </div>
            </div>


        </section>

        <div class="list_agenda-wrapper">
            <!-- Sidebar List Berita -->
            <section class="list_agenda md:col-span-1 p-5 md:mt-25 border border-gray-300 shadow-md shadow-slate-400">
                <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                    Berita Desa
                </h3>

                @if(!$daftarBerita->isEmpty())
                @foreach ($daftarBerita as $beritas)
                <div class="container space-y-2">
                    <!-- Berita item -->
                    <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                        <!-- thumbnail -->
                        <div class="w-full sm:w-1/3">
                            <img src="{{ asset('storage/' . $beritas->gambar) }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                        </div>
                        <!-- title + link -->
                        <div class="flex flex-col justify-between flex-1 h-full">
                            <h4 class="text-xs font-semibold mb-2">
                                {{ $beritas->judul }}
                            </h4>
                            <a href="#" class="mt-auto text-sky-600 text-xs underline hover:text-sky-800">
                                Baca Selengkapnya
                            </a>

                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <x-placeholder title="Konten Berita Belum Tersedia" description="Silakan hubungi admin untuk informasi lebih lanjut." showPlaceholder="true" />

                @endif


            </section>
        </div>
    </div>
</div>
