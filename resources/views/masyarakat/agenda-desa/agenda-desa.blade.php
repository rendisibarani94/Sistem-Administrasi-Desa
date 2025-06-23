<x-slot:judul>
    Agenda Desa
</x-slot:judul>

<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-5 px-5">
        <section class="pengumuman md:col-span-3 p-5 rounded-lg">
            <div class="judul_pengumuman">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-9 h-9 text-teal-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 22">
                        <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                        <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z" />
                    </svg>

                    <span>Agenda Desa</span>
                </h1>
            </div>

            <div class="list_pengumuman md:col-span-1 p-3 ">
                <div class="container">
                    @foreach ($agendaData as $item)

                    <div class="agenda-item flex flex-col md:flex-row gap-4 md:gap-3 mb-4 border-2 border-teal-700 p-3 md:p-2 rounded-sm shadow-sm shadow-slate-400">
                        <div class="desc w-full md:w-4/5 self-start p-3 md:p-5">
                            <div class="agenda_desc mb-2 flex items-center space-x-2">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-teal-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 22">
                                    <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                                    <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z" />
                                </svg>
                                <h4 class="text-lg md:text-xl font-semibold">{{ $item->judul }}</h4>
                            </div>
                            <a class="cursor-pointer text-teal-600 text-xs md:text-sm underline hover:text-teal-800 ml-0 md:ml-9" wire:click="showAgenda({{ $item->id_agenda }})">
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
                </div>
            </div>
        </section>

        <div class="list_berita-wrapper">
            <section class="list_berita md:col-span-1 p-5 md:mt-10 border border-teal-600 shadow-md shadow-teal-700">

                <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                    Berita Desa
                </h3>
                <div class="container">
                    <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-teal-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                        <div class="w-full sm:w-1/3">
                            <img src="{{ asset('images/masyarakat/berita.png') }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                        </div>
                        <div class="flex flex-col justify-between flex-1 h-full">
                            <h4 class="text-xs font-semibold mb-2">
                                Berita desa pada hari senin
                            </h4>
                            <a class="mt-auto text-teal-600 text-xs underline hover:text-teal-800" wire:click="showAgenda({{ $item->id_agenda }})">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Main modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto" style="{{ $showModal ? 'display: flex' : 'display: none' }}">
        <!-- BACKDROP: semi-transparent + blur -->
        <div class="fixed inset-0 bg-black/40 bg-opacity-30" wire:click="closeModal"></div>

        <!-- MODAL CONTENT -->
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                    <h3 class="text-sm font-semibold text-teal-700">Agenda Desa</h3>

                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center cursor-pointer" wire:click="closeModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                {{-- Heading --}}
                @if($selectedAgenda)
                <div class="heading px-5 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">{{ $selectedAgenda->judul }}</h3>
                </div>

            <div class="flex space-x-4">
                <div class="date flex items-center px-8 space-x-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-blue-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span class="text-sm text-blue-700">{{ \Carbon\Carbon::parse($selectedAgenda->tanggal_agenda)->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-600 mb-4">
                    <svg class="w-6 h-6 text-blue-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm md:text-base text-blue-700">{{$selectedAgenda->nama_pembuat}}</span>
                </div>
            </div>

                <div class="tujuan px-5">
                    <h3 class="text-xl font-semibold text-teal-700 mb-2">Tujuan Kegiatan:</h3>
                    <h3 class="text-md text-black">{{ $selectedAgenda->tujuan_agenda }}</h3>
                </div>

                <!-- body -->
                <div class="p-4 md:p-5 space-y-4">
                    <h3 class="text-xl font-semibold text-teal-700 mb-2">Deskripsi:</h3>
                    <p class="text-base leading-relaxed text-black">
                        {{ strip_tags($selectedAgenda->deskripsi_agenda) }}
                    </p>
                </div>

                <div class="heading-3">
                    <h3 class="text-xl leading-8 font-semibold text-teal-700 px-5 ">Dokumentasi Kegiatan:</h3>
                </div>

                <div class="image p-5 flex justify-center">
                    <img src="{{ asset('storage/' . $selectedAgenda->gambar) }}" alt="{{ $selectedAgenda->judul }}" class="w-1/2 h-auto object-cover" />
                </div>
                @endif
            </div>
        </div>
    </div>



</div>
