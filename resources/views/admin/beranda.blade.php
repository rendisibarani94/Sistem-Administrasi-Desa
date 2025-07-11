<div class="p-4">
    <x-slot:judul>
        Main
    </x-slot:judul>

    {{-- Slot Component --}}
    <h1 class="text-xl font-bold text-gray-950 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">
        <!-- Card Peraturan Desa -->
        <a href="{{ route('PeraturanDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Peraturan Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['peraturan_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Keputusan Kepala Desa -->
        <a href="{{ route('keputusanKepalaDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Keputusan Kepala Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['keputusan_kepala_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Aparatur Desa -->
        <a href="{{ route('AparaturDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Aparatur Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['aparatur_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Tanah Kas Desa -->
        <a href="{{ route('TanahKasDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Tanah Kas Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['tanah_kas_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Tanah Desa -->
        <a href="{{ route('TanahDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Tanah Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['tanah_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Inventaris Desa -->
        <a href="{{ route('InventarisDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Inventaris Desa</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['inventaris_desa'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Agenda Surat -->
        <a href="{{ route('AgendaSuratDesa') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Agenda Surat</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['agenda_surat'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Penduduk -->
        <a href="{{ route('indukPenduduk') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Penduduk</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['penduduk'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Kartu Keluarga -->
        <a href="{{ route('kartuKeluarga') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Kartu Keluarga</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['kartu_keluarga'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Penduduk Sementara -->
        <a href="{{ route('pendudukSementara') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Penduduk Sementara</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['penduduk_sementara'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Kader Pemberdayaan -->
        <a href="{{ route('KaderPemberdayaanMasyarakat') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Kader Pemberdayaan</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['kader_pemberdayaan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Pembangunan -->
        <a href="{{ route('Pembangunan') }}">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border-3 border-sky-700 transition-all hover:shadow-lg h-full">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-teal-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-500">Pembangunan</h3>
                            <p class="text-2xl font-bold text-sky-700">{{ $stats['pembangunan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </div> </a>

</div>
