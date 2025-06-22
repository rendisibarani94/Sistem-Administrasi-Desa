<div>
    <section class="berita_desa  mb-15">
        <div class="py-10 md:py-20 px-4 md:px-8 lg:px-30">
            <div class="judul_berita">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-7 h-7 md:w-9 md:h-9 text-teal-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd" />
                    </svg>
                    <span>Berita Desa</span>
                </h1>
            </div>
            <div class="cards_berita grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
                @foreach ($beritaData as $berita)
                <!-- Card 1 -->
                <div class="card p-3 md:p-4 bg-white w-7/8 mx-auto md:bg-gray-200 border-2 rounded-lg border-gray-300 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="card_image mb-3 md:mb-4">
                        <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-full h-40 md:h-48 object-cover rounded-t-lg" alt="">
                    </div>
                    <div class="card_heading mb-3 md:mb-4">
                        <h3 class="text-cyan-900 font-semibold text-lg md:text-xl">
                            {{ $berita->judul }}
                        </h3>
                    </div>
                    <div class="card_date mb-2 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-cyan-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        <span class="text-sm md:text-base">{{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="card_text">
                        <div class="text-slate-800 text-sm md:text-base mb-3">
                            {{ Str::limit(strip_tags($berita->deskripsi), 50, '...') }}
                        </div>
                        <a href="{{ route('detail.berita', $berita->id_berita) }}" class="text-blue-600 text-sm md:text-base underline hover:text-blue-800">Baca Lebih Lanjut</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $beritaData->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </section>
</div>
