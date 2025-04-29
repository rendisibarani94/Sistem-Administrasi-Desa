<x-slot:judul>
    Detail
</x-slot:judul>

<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-4 px-5">
        <section class="pengumuman md:col-span-3 p-5 rounded-lg">
            <div class="judul_pengumuman">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-7 h-7 text-teal-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
                    </svg>
                    <span>Pengumuman Desa</span>
                </h1>
            </div>

            <div class="list_pengumuman md:col-span-1 p-3 ">
                <div class="container">
                    <div class="pengumuman-item flex flex-col sm:flex-row items-start gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                        <div class="image w-1/4 sm:w-1/3">
                            <img src="{{ asset('images/masyarakat/berita.png') }}" alt="Upacara HUT" class="w-full h-auto object-cover p-5" />
                        </div>
                        <!-- title + link -->
                        <div class="desc w-3/4 self-start p-5">
                            <h4 class="text-lg font-semibold mb-1">
                                Upacara Peringatan HUT Sosor Dolok
                            </h4>
                            <div class="pengumuman_date mb-10 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4.5 text-cyan-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <span class="md:text-sm">18 Juni 2024</span>
                            </div>
                            <p class="text-sm mb-2">
                                Untuk memberikan pelayanan yang lebih baik, jadwal Posyandu di Desa Sosor Dolok...
                            </p>
                            <a class="cursor-pointer text-teal-600 text-xs underline hover:text-teal-800" data-modal-target="default-modal" data-modal-toggle="default-modal">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <div class="list_agenda-wrapper">
        <!-- Sidebar List Berita -->
        <section class="list_agenda md:col-span-1 p-5 md:mt-25 border border-gray-300 shadow-md shadow-slate-400">
            <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                Agenda Desa
            </h3>

            <div class="container">
                <!-- Berita item 1-->
                <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                    <!-- thumbnail -->
                    <div class="w-full sm:w-1/3">
                        <img src="{{ asset('images/masyarakat/berita.png') }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                    </div>
                    <!-- title + link -->
                    <div class="flex flex-col justify-between flex-1 h-full">
                        <h4 class="text-xs font-semibold mb-2">
                            Agenda desa pada hari senin
                        </h4>
                        <a href="#" class="mt-auto text-teal-600 text-xs underline hover:text-teal-800">
                            Baca Selengkapnya
                        </a>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
</div>



