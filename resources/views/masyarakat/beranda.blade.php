<x-slot:judul>
    Beranda
</x-slot:judul>

<div>
    <section class="relative mb-20 bg-cover bg-center bg-no-repeat h-[50vh] md:h-[80vh] text-white flex items-center px-4 md:px-8 py-6" style="background-image: url('{{ asset('images/masyarakat/beranda.png') }}');">
        <div class="absolute inset-0 bg-teal-700/25 z-0"></div>
        <div class="relative z-10 w-full mx-30">
            <h1 class="text-center md:text-left text-4xl md:text-5xl lg:text-6xl font-bold mb-4 [text-shadow:2px_2px_4px_rgba(0,0,0,0.99)] max-w-2xl">
                Selamat Datang di Sistem Informasi Desa
            </h1>            
        </div>
    </section>

    <section class="card carousel mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-15" x-data="carousel()">
        <h1 class="text-3xl font-bold text-teal-700 text-center mb-10">Perangkat Desa</h1>
        <div class="flex items-center justify-center mt-4">
            <!-- Left Arrow -->
            <div class="arrow-left">
                <a href="#" @click.prevent="prev()" class="bg-gray-200 p-2 rounded-full inline-block transition-opacity duration-300" :class="{'opacity-50 cursor-not-allowed': currentIndex === 0, 'hover:bg-gray-300': currentIndex > 0}">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </a>
            </div>

            <!-- Carousel Items -->
            <div class="overflow-hidden mx-4 w-full max-w-[90%] sm:max-w-2xl md:max-w-4xl lg:max-w-6xl" x-ref="carouselContainer">
                <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${currentIndex * slideWidth}px)`">
                    @if(isset($perangkatDesa) && count($perangkatDesa) > 0)
                    @foreach($perangkatDesa as $item)
                    <div class="flex-shrink-0 px-2 sm:px-4 w-full sm:w-1/2 md:w-1/3">
                        <div class="card border border-teal-500 rounded-lg h-full py-8 px-4 sm:py-10 sm:px-6 flex flex-col items-center text-center">
                            <div class="card-header mb-4">
                                <img src="{{ $item->image ?? asset('images/masyarakat/beranda.png') }}" class="w-24 h-24 sm:w-30 sm:h-30 rounded-full object-cover" alt="{{ $item->name ?? 'Perangkat Desa' }}">
                            </div>
                            <div class="card-text">
                                <h4 class="text-black font-bold text-center text-lg sm:text-xl">{{ $item->name ?? 'Tidak ada nama' }}</h4>
                                <h5 class="text-teal-600 text-center italic text-sm sm:text-base">{{ $item->position ?? 'Tidak ada jabatan' }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <!-- Empty State -->
                    <div class="flex-shrink-0 px-2 sm:px-4 w-full">
                        <div class="card border border-teal-500 rounded-lg h-full py-8 px-4 sm:py-10 sm:px-6 flex flex-col items-center text-center">
                            <div class="card-header mb-4">
                                <img src="{{ asset('images/masyarakat/beranda.png') }}" class="w-24 h-24 sm:w-30 sm:h-30 rounded-full object-cover" alt="Default Image">
                            </div>
                            <div class="card-text">
                                <h4 class="text-black font-bold text-center text-lg sm:text-xl">Data tidak tersedia</h4>
                                <h5 class="text-teal-600 text-center italic text-sm sm:text-base">Belum ada data perangkat desa</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Arrow -->
            <div class="arrow-right">
                <a href="#" @click.prevent="next()" class="bg-gray-200 p-2 rounded-full inline-block transition-opacity duration-300" :class="{'opacity-50 cursor-not-allowed': currentIndex >= maxIndex, 'hover:bg-gray-300': currentIndex < maxIndex}">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Dots Navigation -->
        <div class="flex justify-center mt-6 space-x-2">
            <template x-for="(_, index) in totalPages" :key="index">
                <button @click="goToPage(index)" class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-colors duration-300" :class="{'bg-teal-700': Math.floor(currentIndex / itemsPerView) === index, 'bg-gray-300 hover:bg-gray-400': Math.floor(currentIndex / itemsPerView) !== index}">
                </button>
            </template>
        </div>
    </section>

    <section class="berita_desa bg-cyan-200 mb-15">
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
                <!-- Card 1 -->
                <div class="card p-3 md:p-4 bg-white w-7/8 mx-auto md:bg-gray-200 border-2 rounded-lg border-gray-300 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="card_image mb-3 md:mb-4">
                        <img src="{{ asset('images/masyarakat/berita.png') }}" class="w-full h-40 md:h-48 object-cover rounded-t-lg" alt="">
                    </div>
                    <div class="card_heading mb-3 md:mb-4">
                        <h3 class="text-cyan-900 font-semibold text-lg md:text-xl">
                            Program Beasiswa Desa Sosor Dolok
                        </h3>
                    </div>
                    <div class="card_date mb-2 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-cyan-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        <span class="text-sm md:text-base">18 Juni 2024</span>
                    </div>
                    <div class="card_text">
                        <p class="text-slate-800 text-sm md:text-base mb-3">
                            Program Beasiswa Bagi siswa siswi asal desa sosor dolok TAHUN 2025...
                        </p>
                        <a href="#" class="text-blue-600 text-sm md:text-base underline hover:text-blue-800">Read more</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="terkait px-4 md:px-8 lg:px-36 py-8 md:py-12 bg-white grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-center">
        <!-- teks + button -->
        <div class="space-y-4 md:space-y-6">
            <h3 class="text-teal-700 font-bold text-2xl md:text-3xl">TERKAIT DESA</h3>
            <p class="text-gray-700 text-base md:text-lg leading-relaxed w-full md:w-8/9">
                Desa Sosor Dolok adalah sebuah desa yang terletak di Kecamatan Sosor Gadong, Kabupaten Simalungun, Provinsi Sumatera Utara, Indonesia. Desa ini memiliki luas wilayah sekitarkilometer persegi dan terdiri dari beberapa dusun, antara lain.
            </p>
            <a href="#profil-desa" class="inline-block bg-teal-700 text-white font-semibold py-3 px-4 md:py-4 md:px-5 text-sm md:text-base rounded-sm hover:bg-teal-800 transition">
                PROFIL DESA →
            </a>
        </div>

        <!-- gambar -->
        <div class="flex justify-center mt-4 md:mt-0">
            <img src="{{ asset('images/masyarakat/profil.png') }}" alt="Profil Desa Sosor Dolok" class="w-full max-w-full md:max-w-lg h-48 md:h-64 object-cover rounded-md shadow">
        </div>
    </section>

    <section class="organisasi container mx-auto px-4 md:px-8 lg:px-36 py-8 md:py-12 bg-white grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-start">
        <!-- image first -->
        <div class="order-1 md:order-1 flex justify-center md:justify-start">
            <img src="{{ asset('images/masyarakat/organisasi.png') }}" alt="Organisasi Desa Sosor Dolok" class="w-full max-w-full md:max-w-md h-48 md:h-64 object-cover rounded-md shadow" />
        </div>

        <!-- text + button, bottom‑aligned -->
        <div class="order-2 md:order-2 space-y-4 md:space-y-6 self-end">
            <h3 class="text-teal-700 font-bold text-2xl md:text-3xl">ORGANISASI DESA</h3>
            <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                Desa Sosor Dolok memiliki berbagai organisasi desa yang dibentuk untuk membantu pengelolaan pemerintah, pembangunan dan pemberdayaan masyarakat.
            </p>
            <a href="#organisasi-desa" class="inline-block bg-teal-700 text-white font-semibold py-3 px-4 md:py-4 md:px-5 text-sm md:text-base rounded-md hover:bg-teal-800 transition">
                LIHAT ORGANISASI DESA →
            </a>
        </div>
    </section>

</div>
@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', () => ({
            currentIndex: 0
            , itemsPerView: 3
            , slideWidth: 0
            , containerWidth: 0
            , totalItems: {
                {
                    isset($perangkatDesa) ? count($perangkatDesa) : 1
                }
            }, // Handle null/empty data

            init() {
                this.updateItemsPerView();
                this.calculateSlideWidth();

                // Add resize listener for responsiveness
                window.addEventListener('resize', () => {
                    this.updateItemsPerView();
                    this.calculateSlideWidth();
                    // Adjust current index to stay within bounds
                    if (this.currentIndex > this.maxIndex) {
                        this.currentIndex = this.maxIndex;
                    }
                });
            },

            updateItemsPerView() {
                // Responsive items per view based on screen width
                const screenWidth = window.innerWidth;

                if (screenWidth < 640) { // sm breakpoint (Tailwind default)
                    this.itemsPerView = 1;
                } else if (screenWidth < 768) { // md breakpoint (Tailwind default) 
                    this.itemsPerView = 2;
                } else { // lg breakpoint and above (Tailwind default)
                    this.itemsPerView = 3;
                }
            },

            calculateSlideWidth() {
                const container = this.$refs.carouselContainer;
                if (container) {
                    this.containerWidth = container.offsetWidth;
                    this.slideWidth = this.containerWidth / this.itemsPerView;
                }
            },

            get maxIndex() {
                return Math.max(0, this.totalItems - this.itemsPerView);
            },

            get totalPages() {
                return Math.ceil(this.totalItems / this.itemsPerView);
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                }
            },

            next() {
                if (this.currentIndex < this.maxIndex) {
                    this.currentIndex++;
                }
            },

            goToPage(pageIndex) {
                const newIndex = pageIndex * this.itemsPerView;
                if (newIndex <= this.maxIndex) {
                    this.currentIndex = newIndex;
                } else {
                    this.currentIndex = this.maxIndex;
                }
            }
        }));
    });

</script>
@endpush
