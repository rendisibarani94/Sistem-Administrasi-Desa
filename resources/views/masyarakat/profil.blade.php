
<div>
    <section class="terkait px-4 md:px-8 lg:px-36 py-8 md:py-12 bg-white grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-center mb-10">
        <!-- teks + button -->
        <div class="space-y-4 md:space-y-6">
            <h3 class="text-teal-700 font-extrabold text-2xl md:text-3xl">PROFIL DESA</h3>
            <div class="text-gray-700 text-base  md:text-md leading-relaxed w-full text-justify">
                @if(isset($profil['profil_desa']))
                    {!! App\Helpers\HtmlSanitizer::cleanList($profil['profil_desa']) !!}

                @else
                <p class="text-gray-500 italic">
                    Deskripsi beranda belum tersedia. Silakan hubungi admin.
                </p>
                @endif
            </div>

        </div>

        {{-- <iframe src="" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
        <!-- gambar -->
        <div class="w-full h-full mt-4 md:mt-0">
            @if(isset($profil['link_iframe_maps']))
            <iframe src="{{ $profil['link_iframe_maps'] }}" class="w-full h-full border-2 border-gray-300" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            @else
            <div class="bg-gray-100 border-2 border-dashed border-gray-300 w-full h-full flex items-center justify-center">
                <div class="text-center p-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Peta Tidak Tersedia</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Link peta belum dikonfigurasi untuk halaman ini.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </section>

    <section class="visi_misi bg-cyan-200">
        <div class="py-10 md:py-20 px-4 md:px-8 lg:px-30">
            <div class="visi mb-15">
                <h3 class="text-teal-700 font-extrabold text-2xl md:text-3xl mb-4">VISI {{ $settings['nama_desa'] }}</h3>
                <div class="text-gray-700 font-semibold text-md md:text-md leading-relaxed w-full text-justify">
                    @if(isset($profil['visi_desa']))
                    {!! App\Helpers\HtmlSanitizer::cleanList($profil['visi_desa']) !!}

                    @else
                    <p class="text-gray-500 italic">
                        Visi Desa belum tersedia. Silakan hubungi admin.
                    </p>
                    @endif
                </div>

            </div>

            <div class="misi">
                <h3 class="text-teal-700 font-extrabold text-2xl md:text-3xl mb-4">MISI {{ $settings['nama_desa'] }}</h3>
                <div class="text-gray-700 font-semibold text-md md:text-md leading-relaxed w-full text-justify">
                    @if(isset($profil['misi_desa']))
                    {!! App\Helpers\HtmlSanitizer::cleanList($profil['misi_desa']) !!}
                    @else
                    <p class="text-gray-500 italic">
                        Misi Desa belum tersedia. Silakan hubungi admin.
                    </p>
                    @endif
                </div>

            </div>
        </div>
    </section>

    <section class="py-10 md:py-20 px-4 md:px-8 lg:px-30">
        <div class="sejarah">
            <h3 class="text-teal-700 font-extrabold text-2xl md:text-3xl mb-4">SEJARAH {{ $settings['nama_desa'] }}</h3>
            <div class="text-gray-700 font-semibold text-md md:text-md leading-relaxed w-full text-justify">
                @if(isset($profil['sejarah_desa']))
                    {!! App\Helpers\HtmlSanitizer::cleanList($profil['sejarah_desa']) !!}
                @else
                <p class="text-gray-500 italic">
                    Sejarah Desa belum tersedia. Silakan hubungi admin.
                </p>
                @endif
            </div>
        </div>
    </section>

</div>
