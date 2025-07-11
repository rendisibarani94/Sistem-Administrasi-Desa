<x-slot:judul>
    Organisasi Desa
</x-slot:judul>

<div>
    <section class="organisasi">
        <div class="py-5 md:py-10 px-4 md:px-8 lg:px-30">
            <div class="organisasi_desc mb-15">
                <h3 class="text-sky-700 font-extrabold text-2xl md:text-3xl mb-4">ORGANISASI DESA</h3>
                <p class="text-gray-700 text-lg md:text-md leading-relaxed w-full text-justify">
                    Organisasi desa adalah kelompok atau lembaga yang dibentuk di tingkat desa untuk membantu menjalankan pemerintahan, pembangunan, dan pemberdayaan masyarakat. Organisasi ini berperan dalam berbagai aspek kehidupan desa, seperti administrasi, ekonomi, sosial, budaya, dan keamanan.
                </P>
            </div>
        </div>
    </section>

    <div class="wrapper bg-sky-200">
        <section class="card carousel mx-auto max-w-7xl px-4 sm:px-6 py-4 sm:py-6 lg:px-8 mb-15" x-data="carousel()">
            <h1 class="text-3xl font-bold text-sky-700 text-center mb-10">DAFTAR ORGANISASI</h1>
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
                        @if(isset($organisasiDesa) && count($organisasiDesa) > 0)
                        @foreach($organisasiDesa as $item)
                        <div class="flex-shrink-0 px-2 sm:px-4 w-full sm:w-1/2 md:w-1/3">
                            <a href="{{ route('organisasi.desa.detail', $item->id_organisasi) }}" class="block h-full">
                                <div class="card border border-sky-500 bg-white rounded-lg h-full py-8 px-4 sm:py-10 sm:px-6 flex flex-col items-center text-center">
                                    <div class="card-header mb-4">
                                        <img src="{{ asset('storage/'.$item->logo_organisasi) }}" class="w-24 h-24 sm:w-30 sm:h-30 rounded-full object-cover" alt="{{ $item->nama_organisasi ?? 'Perangkat Desa' }}">
                                    </div>
                                    <div class="card-text">
                                        <h4 class="text-black font-bold text-center text-lg sm:text-xl">{{ $item->nama_organisasi ?? 'Tidak ada nama' }}</h4>
                                    </div>
                                </div>
                            </a>

                        </div>
                        @endforeach
                        @else
                        <!-- Empty State -->
                        <div class="flex-shrink-0 px-2 sm:px-4 w-full">
                            <div class="card border border-sky-500 bg-white rounded-lg h-full py-8 px-4 sm:py-10 sm:px-6 flex flex-col items-center text-center">
                                <div class="card-header mb-4">
                                    <img src="{{ asset('images/masyarakat/beranda.png') }}" class="w-24 h-24 sm:w-30 sm:h-30 rounded-full object-cover" alt="Default Image">
                                </div>
                                <div class="card-text">
                                    <h4 class="text-sky-700 font-bold text-center text-lg sm:text-xl">Data Organisasi Belum Tersedia</h4>
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
                    <button @click="goToPage(index)" class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-colors duration-300" :class="{'bg-sky-700': Math.floor(currentIndex / itemsPerView) === index, 'bg-gray-300 hover:bg-gray-400': Math.floor(currentIndex / itemsPerView) !== index}">
                    </button>
                </template>
            </div>
        </section>
    </div>


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
