<div>
    <div class="container mx-auto my-4 ">
        <div class="bg-teal-700 mb-4 p-2">
            <h5 class="text-xl text-white font-semibold text-center">Detail Orgarnisasi Desa</h5>
        </div>

        <div class="profil flex justify-center space-x-10 items-center mb-4">
            <!-- Added items-center here -->
            <div class="logo">
                <img src="{{ asset('storage/'.$organisasiDesa->logo_organisasi) }}" class="object-cover border border-black" width="500" height="500" alt="{{ $organisasiDesa->nama_organisasi ?? 'Perangkat Desa' }}">
            </div>
            <div class="detail flex items-center">
                <!-- Added flex and items-center here -->
                <div class="text-black text-md sm:text-xl space-y-2">
                    <div class="flex">
                        <span class="w-42 sm:w-50 font-semibold">Nama Organisasi</span>
                        <span class="ml-2">: {{ $organisasiDesa->nama_organisasi ?? 'Belum ada nama' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-42 sm:w-50 font-semibold">Tahun Berdiri</span>
                        <span class="ml-2">: {{ $organisasiDesa->tanggal_berdiri ?? 'Belum ada tahun' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-42 sm:w-50">Ketua</span>
                        <span class="ml-2">: {{ $organisasiDesa->ketua ?? 'Belum ada ketua' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-42 sm:w-50 font-semibold">Alamat</span>
                        <span class="ml-2">: {{ $organisasiDesa->alamat ?? 'Belum ada ketua' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-teal-700 my-10 p-2">
            <h5 class="text-xl text-white font-semibold text-center">Struktur Orgarnisasi Desa</h5>
        </div>

        <div class=" mx-auto p-6 bg-white rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex border-2 bg-teal-800 border-teal-700 shadow-md hover:shadow-lg transition-shadow">
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
                <div class="flex border-2 bg-teal-800 border-teal-700 shadow-md hover:shadow-lg transition-shadow">
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
                <div class="flex border-2 bg-teal-800 border-teal-700 shadow-md hover:shadow-lg transition-shadow">
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

        <div class="visi-misi my-10 space-y-10">
            <div class="visi">
                <h1 class="text-teal-700 font-bold text-xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    Visi {{ $organisasiDesa->nama_organisasi ?? 'Organisasi Desa' }}
                </h1>
                <div class="text-slate-800 text-sm md:text-base mb-3">
                    {!! Str::of($organisasiDesa->misi)->stripTags('p,br') !!}
                </div>
            </div>

            <div class="misi">
                <h1 class="text-teal-700 font-bold text-xl md:text-3xl flex items-center space-x-2 mb-6 md:mb-8">
                    Misi {{ $organisasiDesa->nama_organisasi ?? 'Organisasi Desa' }}
                </h1>
                <div class="text-slate-800 text-sm md:text-base mb-3">
                    {{ nl2br(strip_tags($organisasiDesa->misi)) }}
                </div>
            </div>
        </div>


    </div>
</div>
