<x-slot:judul>
    Beranda
</x-slot:judul>

<div>
    @if(empty($profil['deskripsi_beranda']) || empty($profil['gambar_landing_page']))
    <x-placeholder title="Konten Gambar Landing Page Belum Tersedia" description="Silakan hubungi admin untuk informasi lebih lanjut." showPlaceholder="true" />
    @else
    <section class="relative mb-15 bg-cover bg-center bg-no-repeat h-[50vh] md:h-[80vh] text-white flex items-center px-2 md:px-4 py-6" style="background-image: url('{{ asset('storage/'.$profil['gambar_landing_page']) }}');">
        <div class="absolute inset-0 z-0"></div>
        <div class="relative z-10 w-full mx-auto max-w-7xl px-4 sm:px-6 lg:px-4">
            <div class="max-w-4xl">
                <h1 class="text-center sm:text-left text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 leading-tight sm:leading-tight md:leading-tight lg:leading-tight [text-shadow:2px_2px_4px_rgba(0,0,0,0.8)]">
                    {{ strip_tags($profil['deskripsi_beranda']) ?? 'Selamat Datang di Sistem Informasi Desa Kami'}}
                </h1>
            </div>
        </div>
    </section>
    @endif

    <div class="mx-4">
        <section class="card_carousel mx-auto max-w-7xl px-4 sm:px-6 lg:px-4 mb-15" x-data="carousel()">
            <h1 class="text-2xl sm:text-3xl font-bold text-sky-700 text-center mb-6 sm:mb-10">Perangkat Desa</h1>
            <div class="flex items-center justify-center mt-2">
                <!-- Left Arrow -->
                <div class="arrow-left">
                    <a href="#" @click.prevent="prev()" class="bg-gray-200 p-2 rounded-full inline-block transition-opacity duration-300" :class="{'opacity-50 cursor-not-allowed': currentIndex === 0, 'hover:bg-gray-300': currentIndex > 0}">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                        </svg>
                    </a>
                </div>

                <!-- Carousel Items -->
                <div class="overflow-hidden mx-2 sm:mx-4 w-full max-w-[85%] sm:max-w-[90%] md:max-w-4xl lg:max-w-6xl" x-ref="carouselContainer">
                    <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${currentIndex * slideWidth}px)`">
                        <template x-if="perangkatDesa.length > 0">
                            <div class="flex">
                                <template x-for="(item, index) in perangkatDesa" :key="index">
                                    <div class="flex-shrink-0 px-2 sm:px-3 w-[280px] sm:w-[320px] md:w-[350px]">
                                        <div class="card border border-sky-600 rounded-lg h-full py-4 px-3 sm:py-5 sm:px-4 md:py-6 md:px-5 flex flex-col items-center text-center">
                                            <div class="card-header mb-3 sm:mb-4">
                                                <img :src="item.foto ? `storage/${item.foto}` : 'images/masyarakat/beranda.png'" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full object-cover" :alt="item.nama_lengkap">
                                            </div>
                                            <div class="card-text">
                                                <h4 class="text-black font-bold text-center text-sm sm:text-base md:text-lg" x-text="item.nama_lengkap"></h4>
                                                <h5 class="text-sky-700 text-center italic text-xs sm:text-sm md:text-base" x-text="item.jabatan"></h5>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- Empty State -->
                        <template x-if="perangkatDesa.length === 0">
                            <div class="flex-shrink-0 px-2 sm:px-4 w-full">
                                <div class="card border border-sky-500 rounded-lg h-full py-8 px-4 sm:py-10 sm:px-6 flex flex-col items-center text-center">
                                    <div class="card-header mb-4">
                                        <img src="images/masyarakat/beranda.png" class="w-24 h-24 sm:w-30 sm:h-30 rounded-full object-cover" alt="Default Image">
                                    </div>
                                    <div class="card-text">
                                        <h4 class="text-black font-bold text-center text-lg sm:text-xl">Data tidak tersedia</h4>
                                        <h5 class="text-sky-600 text-center italic text-sm sm:text-base">Belum ada data perangkat desa</h5>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Right Arrow -->
                <div class="arrow-right">
                    <a href="#" @click.prevent="next()" class="bg-gray-200 p-2 rounded-full inline-block transition-opacity duration-300" :class="{'opacity-50 cursor-not-allowed': currentIndex >= maxIndex, 'hover:bg-gray-300': currentIndex < maxIndex}">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Dots Navigation -->
            <div class="flex justify-center mt-4 sm:mt-6 space-x-2" x-show="totalPages > 1">
                <template x-for="(_, index) in totalPages" :key="index">
                    <button @click="goToPage(index)" class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-colors duration-300" :class="{
                'bg-sky-700': Math.floor(currentIndex / itemsPerView) === index,
                'bg-gray-300 hover:bg-gray-400': Math.floor(currentIndex / itemsPerView) !== index
            }">
                    </button>
                </template>
            </div>
        </section>

        <section class="berita_desa mx-auto max-w-7xl px-4 sm:px-6 lg:px-4 mb-15">
            <div class="judul_berita">
                <h1 class="text-sky-700 font-bold text-2xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    <svg class="w-7 h-7 md:w-9 md:h-9 text-sky-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd" />
                    </svg>
                    <span>Berita Desa</span>
                </h1>
            </div>
            @if(!$beritaData->isEmpty())
            <div class="cards_berita grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
                @foreach ($beritaData as $berita)
                <!-- Card 1 -->
                <div class="card bg-white w-7/8 mx-auto border-1 border-gray-300 rounded-sm overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="card_image mb-3 md:mb-4">
                        <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-full h-40 md:h-48 object-cover rounded-t-sm" alt="">
                    </div>
                    <div class="p-3 md:p-4">
                        <div class="card_heading mb-3 md:mb-4">
                            <h3 class="text-sky-700 font-semibold text-lg md:text-xl text-justify">
                                {{ $berita->judul }}
                            </h3>
                        </div>
                        <div class="card_date mb-2 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-sky-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            <span class="text-sm md:text-base">{{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="card_text">
                            <div class="text-slate-800 text-sm md:text-base mb-3 text-justify">
                                {{ Str::limit(strip_tags($berita->deskripsi), 100, '...') }}
                            </div>
                            <a href="{{ route('detail.berita', $berita->id_berita) }}" class="text-sky-600 text-sm md:text-base underline hover:text-sky-800">Baca Lebih Lanjut</a>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>

            @else
            <x-placeholder title="Konten Berita Desa Belum Tersedia" description="Silakan hubungi admin untuk informasi lebih lanjut." showPlaceholder="true" />
            @endif

        </section>

        <section class="terkait mx-auto max-w-7xl px-4 sm:px-6 lg:px-4 py-8 md:py-12 bg-white grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-center">
            <!-- teks + button -->
            <div class="space-y-4 md:space-y-6">
                <h3 class="text-sky-700 font-bold text-2xl md:text-3xl">TERKAIT DESA</h3>
                <div class="text-gray-700 text-base md:text-lg leading-relaxed w-full md:w-8/9 text-justify">
                    @if(isset($profil['deskripsi_singkat_desa']))
                    {!! $profil['deskripsi_singkat_desa'] !!}
                    @else
                    <p class="text-gray-500 italic">
                        Deskripsi Sekitar Desa Desa belum tersedia. Silakan hubungi admin.
                    </p>
                    @endif
                </div>
                <a href="{{ route('profil') }}" class="inline-block bg-sky-700 text-white font-semibold py-3 px-4 md:py-4 md:px-5 text-sm md:text-base rounded-sm hover:bg-sky-800 transition">
                    LIHAT PROFIL DESA
                </a>
            </div>

            <!-- peta -->
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

        <section class="organisasi mx-auto max-w-7xl px-4 sm:px-6 lg:px-4 py-8 md:py-12 bg-white grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-start">
            <!-- image first -->
            <div class="order-1 md:order-1 flex justify-center md:justify-start">
                <img src="{{ asset('images/masyarakat/organisasi.png') }}" alt="Organisasi Desa Sosor Dolok" class="w-full max-w-full md:max-w-md h-48 md:h-64 object-cover rounded-md shadow" />
            </div>

            <!-- text + button, bottom‑aligned -->
            <div class="order-2 md:order-2 space-y-4 md:space-y-6 self-end">
                <h3 class="text-sky-700 font-bold text-2xl md:text-3xl">ORGANISASI DESA</h3>
                <div class="text-gray-700 text-base md:text-lg leading-relaxed text-justify">
                    @if(isset($profil['deskripsi_singkat_organisasi']))
                    {!! $profil['deskripsi_singkat_organisasi'] !!}
                    @else
                    <p class="text-gray-500 italic">
                        Deskripsi Organisasi Desa belum tersedia. Silakan hubungi admin.
                    </p>
                    @endif
                </div>
                <a href="{{ route('organisasi.desa') }}" class="inline-block bg-sky-700 text-white font-semibold py-3 px-4 md:py-4 md:px-5 text-sm md:text-base rounded-md hover:bg-sky-800 transition">
                    LIHAT ORGANISASI DESA
                </a>
            </div>
        </section>
    </div>



</div>
@push('scripts')
<!-- Add this script tag before your carousel section -->
<script>
    window.perangkatDesaData = @json($perangkatDesa);

</script>

<script>
    function carousel() {
        return {
            currentIndex: 0
            , slideWidth: 0
            , itemsPerView: 1
            , perangkatDesa: window.perangkatDesaData || [],

            init() {
                this.calculateDimensions();
                window.addEventListener('resize', () => {
                    this.calculateDimensions();
                });
            },

            calculateDimensions() {
                const container = this.$refs.carouselContainer;
                if (!container) return;

                const containerWidth = container.offsetWidth;

                if (containerWidth < 640) {
                    this.itemsPerView = 1;
                } else if (containerWidth < 768) {
                    this.itemsPerView = 2;
                } else {
                    this.itemsPerView = 3;
                }

                this.slideWidth = containerWidth / this.itemsPerView;
            },

            get maxIndex() {
                return Math.max(0, this.perangkatDesa.length - 1); // FIXED
            },

            get totalPages() {
                return Math.ceil(this.perangkatDesa.length / this.itemsPerView); // FIXED
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                }
            },

            next() {
                // FIXED condition
                if (this.currentIndex < this.perangkatDesa.length - 1) {
                    this.currentIndex++;
                }
            },

            goToPage(pageIndex) {
                this.currentIndex = pageIndex * this.itemsPerView;
                // Ensure we don't go beyond last item
                if (this.currentIndex > this.maxIndex) {
                    this.currentIndex = this.maxIndex;
                }
            }
        }
    }

</script>

@endpush
