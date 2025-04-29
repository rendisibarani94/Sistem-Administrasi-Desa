<x-slot:judul>
    Detail
</x-slot:judul>

<div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-10 px-5">
        <!-- Main Berita -->
        <section class="berita md:col-span-3 p-5 rounded-lg">
            <h3 class="text-teal-700 font-extrabold text-2xl md:text-3xl mb-4">
                Program Beasiswa Desa Sosor Dolok
            </h3>

            <div class="flex items-center space-x-2 text-gray-600 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-teal-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <span class="text-sm md:text-base">18 Juni 2024</span>
            </div>

            <div class="gambar flex justify-center mb-6">
                <img src="{{ asset('images/masyarakat/berita.png') }}" alt="Profil Desa Sosor Dolok" class="w-98/100 object-cover shadow">
            </div>

            <p class="text-gray-700 text-base md:text-md leading-relaxed">
                Desa Sosor Dolok terus berupaya meningkatkan kualitas pendidikan warganya melalui program beasiswa. Program ini ditujukan untuk siswa berprestasi dari keluarga kurang mampu. Kepala Desa Sosor Dolok, Bapak Joko, menyatakan bahwa pendidikan adalah kunci utama untuk memajukan desa. "Kami berharap dengan adanya beasiswa ini, anak-anak di Desa Sosor Dolok bisa mendapatkan pendidikan yang lebih baik dan nantinya dapat berkontribusi pada pembangunan desa," ujar beliau. Program ini telah berhasil memberikan beasiswa kepada 20 siswa dalam satu tahun terakhir.
                <br><br>
                Desa Sosor Dolok terus berupaya meningkatkan kualitas pendidikan warganya melalui program beasiswa. Program ini ditujukan untuk siswa berprestasi dari keluarga kurang mampu. Kepala Desa Sosor Dolok, Bapak Joko, menyatakan bahwa pendidikan adalah kunci utama untuk memajukan desa. "Kami berharap dengan adanya beasiswa ini, anak-anak di Desa Sosor Dolok bisa mendapatkan pendidikan yang lebih baik dan nantinya dapat berkontribusi pada pembangunan desa," ujar beliau. Program ini telah berhasil memberikan beasiswa kepada 20 siswa dalam satu tahun terakhir.
            </p>
        </section>

        <!-- Sidebar List Berita -->
        <div class="list_berita-wrapper">
        <section class="list_berita md:col-span-1 p-5 md:mt-5 border border-gray-300 shadow-md shadow-slate-400">
            <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                Berita Desa
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
                            Upacara Peringatan HUT Sosor Dolok
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
