<x-slot:judul>
    Detail Pengumuman Desa
</x-slot:judul>

<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-10 px-5">
        <!-- Main Berita -->
        <section class="berita md:col-span-3 p-5 rounded-lg">
            <h3 class="text-sky-700 font-extrabold text-2xl md:text-3xl mb-4">
                {{ $pengumuman->judul }}
            </h3>

            <div class="flex space-x-4">
                <div class="flex items-center space-x-2 text-gray-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-sky-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span class="text-sm md:text-base">{{ \Carbon\Carbon::parse($pengumuman->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-600 mb-4">
                    <svg class="w-6 h-6 text-sky-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm md:text-base">{{$pengumuman->nama_pembuat}}</span>
                </div>
            </div>

            <div class="gambar flex justify-center px-4 mb-6">
                <img src="{{ asset('storage/'.$pengumuman->gambar) }}" alt="Profil Desa Sosor Dolok" class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl object-cover shadow rounded-xs">
            </div>

            <div class="text-gray-700 text-lg md:text-md leading-relaxed">
                {!! App\Helpers\HtmlSanitizer::cleanList($pengumuman->deskripsi) !!}
            </div>
        </section>

        <!-- Sidebar List Berita -->
        <div class="list_berita-wrapper">
            <section class="list_berita md:col-span-1 p-5 md:mt-5 border border-gray-300 shadow-md shadow-slate-400">
                <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                    Berita Desa
                </h3>

                <div class="container space-y-2">
                    @foreach ($daftarBerita as $beritas)
                    <!-- Berita item -->
                    <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                        <!-- thumbnail -->
                        <div class="w-full sm:w-1/3">
                            <img src="{{ asset('storage/'.$beritas->gambar) }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                        </div>
                        <!-- title + link -->
                        <div class="flex flex-col justify-between flex-1 h-full">
                            <h4 class="text-xs font-semibold mb-2">
                                {{ $beritas->judul }}
                            </h4>
                            <a href="{{ route('detail.berita', $beritas->id_berita) }}" class="mt-auto text-sky-600 text-xs underline hover:text-sky-800">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>


    </div>
</div>
