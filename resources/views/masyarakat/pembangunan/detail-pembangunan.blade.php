<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5  px-5">
        <section class="pembangunan md:col-span-3 p-5 rounded-lg">
            <div class="judul_pembangunan mb-8">
                <h5 class="text-teal-700 font-bold text-base md:text-lg mb-2 md:mb-4">
                    Pembangunan {{ $pembangunan->sifat_proyek }}
                </h5>
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center space-x-2  mb-4">
                    {{ $pembangunan->nama_kegiatan }}
                </h1>

                <div class="pembangunan_locate mb-6 sm:mb-4 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-teal-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span class="text-sm sm:text-md">{{ $pembangunan->lokasi }}</span>
                </div>

                <div class="pembangunan_date sm:mb-10 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 sm:size-5 text-teal-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span class="text-sm sm:text-md">{{ \Carbon\Carbon::parse($pembangunan->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($pembangunan->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            <div class="tujuan mb-8">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center mb-4">
                    Tujuan Kegiatan
                </h1>
                <p class="text-black text-lg leading-relaxed text-justify w-9/10">
                    {{ $pembangunan->manfaat }}
                </p>
            </div>

            <div class="sumber_dana mb-8">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center mb-6">
                    Sumber Dana
                </h1>

                <div class="tabel_dana relative overflow-x-auto flex justify-center">
                    <table class="w-4/5 text-sm text-left text-gray-700">
                        <thead class="text-xs text-white uppercase bg-teal-600 border border-teal-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">SUMBER DANA/BESARAN BIAYA</th>
                                <th scope="col" class="px-6 py-3">Rencana Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="border border-teal-600">
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Pemerintah
                                </th>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">@rupiah($pembangunan->biaya_pemerintah)</td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Provinsi
                                </th>
                                <td class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap">@rupiah($pembangunan->biaya_provinsi)</td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Kabupaten/Kota
                                </th>
                                <td class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap">@rupiah($pembangunan->biaya_kabupaten_kota)</td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Swadaya
                                </th>
                                <td class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap">@rupiah($pembangunan->biaya_swadaya)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="dokumentasi mb-8 px-4 sm:px-6">
                <h1 class="text-teal-700 font-bold text-xl sm:text-2xl md:text-3xl flex items-center space-x-2 mb-4 sm:mb-8">
                    Dokumentasi Kegiatan
                </h1>
                <img src="{{ asset('storage/'.$pembangunan->dokumentasi) }}" alt="Pembangunan Desa" class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 h-auto object-cover shadow" />
            </div>

            <div class="keterangan mb-8">
                <h1 class="text-teal-700 font-bold text-2xl md:text-3xl flex items-center mb-4">
                    Keterangan
                </h1>
                <p class="text-black text-lg leading-relaxed text-justify w-9/10">
                    {{ $pembangunan->keterangan }}
                </p>
            </div>
        </section>

        <div class="list-wrapper">
            <section class="list_berita md:col-span-1 p-5 md:mt-20 border border-gray-300 shadow-md shadow-slate-400">
                <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                    Pembangunan Lainnya
                </h3>
                @foreach ($daftarPembangunan as $pembangunans)
                <div class="container">
                    <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                        <div class="w-full sm:w-1/3">
                            <img src="{{ asset('storage/' . $pembangunans->dokumentasi) }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                        </div>
                        <div class="flex flex-col justify-between flex-1 h-full">
                            <h4 class="text-xs font-semibold mb-2">
                                {{ $pembangunans->nama_kegiatan }}
                            </h4>
                            <a href="{{ route('pembangunan.detail',$pembangunans->id_pembangunan) }}" class="mt-auto text-teal-600 text-xs underline hover:text-teal-800">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </section>
        </div>
    </div>

</div>
