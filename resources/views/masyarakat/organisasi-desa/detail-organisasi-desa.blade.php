<x-slot:judul>
    Detail Organisasi Desa
</x-slot:judul>
<div>
    <div class="container mx-auto my-4 ">
        {{-- <div class="bg-sky-600 mb-4 p-2">
            <h5 class="text-xl text-white font-semibold text-center">Detail Orgarnisasi Desa</h5>
        </div> --}}
        <h3 class="text-sky-700 font-extrabold text-2xl md:text-3xl mb-4 my-10 p-2">
            Detail Orgarnisasi Desa
        </h3>

        <div class="profil flex flex-col md:flex-row justify-center items-center md:space-x-4 lg:space-x-10 mb-4 gap-4 md:gap-0">
            <!-- Logo Section -->
            <div class="logo w-full md:w-auto px-4 md:px-0">
                <img src="{{ asset('storage/'.$organisasiDesa->logo_organisasi) }}" class="object-cover border border-black w-full max-w-xs mx-auto md:w-64 lg:w-80 xl:w-96" alt="{{ $organisasiDesa->nama_organisasi ?? 'Perangkat Desa' }}">
            </div>

            <!-- Details Section -->
            <div class="detail w-full md:w-auto px-4 md:px-0">
                <div class="text-black text-sm sm:text-base md:text-lg space-y-2">
                    <div class="flex flex-wrap">
                        <span class="w-32 sm:w-36 font-semibold">Nama Organisasi</span>
                        <span class="ml-2 flex-1 min-w-[50%]">: {{ $organisasiDesa->nama_organisasi ?? 'Belum ada nama' }}</span>
                    </div>
                    <div class="flex flex-wrap">
                        <span class="w-32 sm:w-36 font-semibold">Tahun Berdiri</span>
                        <span class="ml-2 flex-1 min-w-[50%]">: {{ \Carbon\Carbon::parse($organisasiDesa->tanggal_berdiri)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="flex flex-wrap">
                        <span class="w-32 sm:w-36 font-semibold">Ketua</span>
                        <span class="ml-2 flex-1 min-w-[50%]">: {{ $organisasiDesa->ketua ?? 'Belum ada ketua' }}</span>
                    </div>
                    <div class="flex flex-wrap">
                        <span class="w-32 sm:w-36 font-semibold">Alamat</span>
                        <span class="ml-2 flex-1 min-w-[50%]">: {{ $organisasiDesa->alamat ?? 'Belum ada ketua' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="bg-sky-600 my-10 p-2">
            <h5 class="text-xl text-white font-semibold text-center">Struktur Orgarnisasi Desa</h5>
        </div> --}}
        <h3 class="text-sky-700 font-extrabold text-2xl md:text-3xl mb-4 my-10 p-2">
            Struktur Orgarnisasi Desa
        </h3>

        <div class=" mx-auto p-6 bg-white rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex border-2 bg-sky-800 border-sky-700 shadow-md hover:shadow-lg transition-shadow">
                    <!-- Image Container (3x4 ratio) -->
                    <div class="image w-1/2 relative">
                        <div class="pb-[133.33%]">
                            <!-- 4/3 = 1.3333 (133.33%) -->
                            <div class="absolute inset-0 bg-gray-300">
                                <!-- Your image would go here -->
                                <img src="{{ asset('storage/'.$organisasiDesa->foto_ketua) }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- Text Container (centered content) -->
                    <div class="text w-1/2 flex items-center justify-center p-4">
                        <div class="text-center text-white">
                            <h2 class="text-xl font-bold mb-2 border-b pb-1">Ketua</h2>
                            <p>{{ $organisasiDesa->ketua }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex border-2 bg-sky-800 border-sky-700 shadow-md hover:shadow-lg transition-shadow">
                    <!-- Image Container (3x4 ratio) -->
                    <div class="image w-1/2 relative">
                        <div class="pb-[133.33%]">
                            <!-- 4/3 = 1.3333 (133.33%) -->
                            <div class="absolute inset-0 bg-gray-300">
                                <!-- Your image would go here -->
                                <img src="{{ asset('storage/'.$organisasiDesa->foto_sekretaris) }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- Text Container (centered content) -->
                    <div class="text w-1/2 flex items-center justify-center p-4">
                        <div class="text-center text-white">
                            <h2 class="text-xl font-bold mb-2 border-b pb-1">Sekretaris</h2>
                            <p>{{ $organisasiDesa->sekretaris }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex border-2 bg-sky-800 border-sky-700 shadow-md hover:shadow-lg transition-shadow">
                    <!-- Image Container (3x4 ratio) -->
                    <div class="image w-1/2 relative">
                        <div class="pb-[133.33%]">
                            <!-- 4/3 = 1.3333 (133.33%) -->
                            <div class="absolute inset-0 bg-gray-300">
                                <!-- Your image would go here -->
                                <img src="{{ asset('storage/'.$organisasiDesa->foto_bendahara) }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- Text Container (centered content) -->
                    <div class="text w-1/2 flex items-center justify-center p-4">
                        <div class="text-center text-white">
                            <h2 class="text-xl font-bold mb-2 border-b pb-1">Bendahara</h2>
                            <p>{{ $organisasiDesa->bendahara }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="visi-misi my-10 space-y-10 py-4 px-8">
            <div class="visi">
                <h1 class="text-sky-700 font-bold text-xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    Visi {{ $organisasiDesa->nama_organisasi ?? 'Organisasi Desa' }}
                </h1>
                <div class="text-slate-800 md:text-base mb-3 text-lg text-justify">
                    {!! App\Helpers\HtmlSanitizer::cleanList($organisasiDesa->visi) !!}
                </div>
            </div>

            <div class="misi">
                <h1 class="text-sky-700 font-bold text-xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    Misi {{ $organisasiDesa->nama_organisasi ?? 'Organisasi Desa' }}
                </h1>
                <div class="text-slate-800 md:text-base mb-3 text-lg text-justify">
                    {!! App\Helpers\HtmlSanitizer::cleanList($organisasiDesa->misi) !!}
                </div>
            </div>
        </div>
    </div>
</div>
