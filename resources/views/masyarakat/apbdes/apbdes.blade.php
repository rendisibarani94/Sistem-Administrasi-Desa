<x-slot:judul>
    APBDesa
</x-slot:judul>

<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-5 px-5">
        <section class="apbdes md:col-span-3 p-5 rounded-lg">
            <div class="judul_apbdes">
                <h1 class="text-sky-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-9 h-9 text-sky-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 22">
                        <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                        <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z" />
                    </svg>

                    <span>APBDes</span>
                </h1>
            </div>

            <div class="list_apbdes md:col-span-1 p-3 ">
                <div class="container">
                    @if(!$apbdesData->isEmpty())
                        @foreach ( $apbdesData as $item)
                            <div class="agenda-item flex flex-col md:flex-row gap-4 md:gap-3 mb-4 border-2 border-gray-500 p-3 md:p-2 rounded-sm shadow-sm shadow-slate-400">
                                <div class="desc w-full md:w-4/5 self-start p-3 md:p-5">
                                    <div class="agenda_desc mb-2 flex items-center space-x-2">
                                        <svg class="w-6 h-6 md:w-7 md:h-7 text-sky-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 22">
                                            <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                                            <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z" />
                                        </svg>
                                        <h4 class="text-lg md:text-xl font-semibold">Anggaran APBDesa Tahun {{ $item->tahun_anggaran }}</h4>
                                    </div>

                                    <a href="{{ route('apbdes.detail', $item->id_apbdes) }}" class="cursor-pointer text-blue-700 text-xs md:text-sm underline hover:text-sky-800 ml-0 md:ml-9" data-modal-target="default-modal" data-modal-toggle="default-modal">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                                <div class="date flex justify-start md:justify-end space-x-2 pt-3 md:pt-5 w-full md:w-auto pl-2">
                                    <svg class="w-5 h-5 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                    </svg>
                                    <p class="text-sm md:text-sm">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <x-placeholder title="Konten APBDesa Belum Tersedia" description="Silakan hubungi admin untuk informasi lebih lanjut." showPlaceholder="true" />
                    @endif

                </div>
            </div>
        </section>

        <div class="list_berita-wrapper">
            <section class="list_berita md:col-span-1 p-5 md:mt-10 border border-gray-300 shadow-md shadow-gray-300">

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
                                    <a href="{{ route('detail.berita', $beritas->id_berita) }}" class="mt-auto text-blue-700 text-xs underline hover:text-blue-800">
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
