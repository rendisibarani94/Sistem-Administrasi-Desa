<div>
    <div class="pembangunan pt-6 md:pt-10 px-4 sm:px-6 md:px-15">
        <h1 class="text-teal-700 font-bold text-xl sm:text-2xl md:text-3xl flex items-center space-x-2 mb-4 md:mb-8">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-teal-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
            </svg>
            <span>Pembangunan</span>
        </h1>
    </div>

    <section class="pembangunan_list px-4 sm:px-6 md:px-15">


        <div class="pengumuman-item-wrapper mb-4 md:mb-6 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">

            @foreach ( $pembangunan as $item )
            <div class="pengumuman-item flex flex-col sm:flex-row items-start gap-3">
                <div class="image w-full sm:w-1/3 md:w-1/4">
                    <img src="{{ asset('storage/'.$item->dokumentasi) }}" alt="Upacara HUT" class="w-full max-h-[200px] object-cover p-2 sm:p-5" />
                </div>

                <div class="desc w-full sm:w-2/3 md:w-3/4 self-start p-2 sm:p-5">
                    <h4 class="text-lg sm:text-xl font-semibold mb-2 sm:mb-4">
                        {{ $item->nama_kegiatan }}
                    </h4>
                    <div class="pengumuman_locate mb-2 sm:mb-4 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-teal-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="text-sm sm:text-md">{{ $item->lokasi }}</span>
                    </div>
                    <div class="pengumuman_date mb-6 sm:mb-10 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-teal-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        <span class="text-sm sm:text-md">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="desc pl-2 sm:pl-5 pr-2 sm:pr-10">
                <p class="text-sm sm:text-md text-justify mb-2">
                    {{ Str::limit(strip_tags($item->manfaat), 50, '...') }}
                    </p>
                <a href="{{ route('pembangunan.detail',$item->id_pembangunan) }}" class="cursor-pointer text-blue-600 text-xs sm:text-sm underline hover:text-blue-800" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    Lihat Detail Pembangunan
                </a>
            </div>
            @endforeach

        </div>

    </section>
</div>
