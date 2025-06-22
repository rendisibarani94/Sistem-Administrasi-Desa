<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $judul ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col">
    <nav class="bg-teal-700 border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
            <div class="flex items-center space-x-2 rtl:space-x-reverse w-full md:w-auto">
                <!-- Logo and Brand Name -->
                <a href="#" class="flex items-center">
                    <img src="{{ asset('storage/'. $settings['logo']) }}" class="h-10 rounded-sm" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white ml-2">{{ $settings['nama_desa'] }}</span>
                </a>

                <!-- Mobile Menu Button -->
                <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-auto w-10 h-10 justify-center text-sm text-gray-300 rounded-lg md:hidden hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Items -->
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col md:flex-row md:space-x-4 lg:space-x-6 xl:space-x-8 mt-4 md:mt-0 text-sm md:text-base">
                    <!-- Home -->
                    <li>
                        <a href="{{ route('beranda') }}" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            Beranda
                        </a>
                    </li>

                    <!-- Profile -->
                    <li>
                        <a href="{{ route('profil') }}" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            Profil
                        </a>
                    </li>

                    <!-- Information Dropdown -->
                    <li class="relative">
                        <button id="infoDropdownButton" data-dropdown-toggle="infoDropdown" class="flex items-center justify-between w-full py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:p-0 cursor-pointer transition-colors">
                            Informasi Publik
                            <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="infoDropdown" class="absolute z-10 hidden w-48 bg-white shadow-lg rounded-lg md:mt-2 overflow-hidden">
                            <ul class="py-2">
                                <li><a href="{{ route('berita') }}" class="block px-4 py-2 text-gray-800 hover:bg-teal-600 hover:text-white transition-colors">Berita desa</a></li>
                                <li><a href="{{ route('pengumuman') }}" class="block px-4 py-2 text-gray-800 hover:bg-teal-600 hover:text-white transition-colors">Pengumuman</a></li>
                                <li><a href="{{ route('agenda-desa') }}" class="block px-4 py-2 text-gray-800 hover:bg-teal-600 hover:text-white transition-colors">Agenda Desa</a></li>
                                <li><a href="{{ route('pembangunan') }}" class="block px-4 py-2 text-gray-800 hover:bg-teal-600 hover:text-white transition-colors">Pembangunan Desa</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- APBDes Dropdown -->
                    <li>
                        <a href="{{ route('apbdes') }}" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            APBDesa
                        </a>
                    </li>

                    <!-- Organization -->
                    <li>
                        <a href="{{ route('organisasi.desa') }}" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            Organisasi Desa
                        </a>
                    </li>

                    <!-- Statistics -->
                    {{-- <li>
                        <a href="#" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            Statistik Desa
                        </a>
                    </li> --}}

                    <!-- Login -->
                    <li>
                        <a href="login" class="flex items-center py-2 px-3 text-white hover:bg-teal-600 md:hover:bg-transparent md:border-0 md:p-0 transition-colors">
                            Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="main flex-grow" id="main-content">
        {{ $slot }}
    </div>

    <footer class="w-full bg-teal-700">
        <div class="w-full pt-8 px-4 mx-auto max-w-7/8">
            <!-- Main Content -->
            <div class="flex flex-col md:flex-row gap-8 md:gap-0 md:justify-between">
                <!-- Left Column -->
                <div class="w-full md:w-96">
                    <div class="mb-6">
                        <h1 class="text-white font-semibold text-xl mb-4 text-center md:text-left">
                            {{ $settings['nama_desa'] ?? 'Belum Ada Nama Desa' }}
                        </h1>
                        <p class="text-white text-justify md:text-left text-sm md:text-base">
                            {{ strip_tags($settings['deskripsi_footer']) ?? 'Belum Ada Deskripsi' }}
                        </p>
                    </div>
                    <div class="flex justify-center md:justify-start gap-4 text-white">
                        <a href="{{ $settings['link_fb'] ?? '#' }}" class="inline-flex items-center justify-center p-2 transition-opacity hover:opacity-80 border-2 rounded-full border-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ $settings['link_ig'] ?? '#' }}" class="inline-flex items-center justify-center p-2 transition-opacity hover:opacity-80 border-2 rounded-full border-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ $settings['link_twt'] ?? '#' }}" class="inline-flex items-center justify-center p-2 transition-opacity hover:opacity-80 border-2 rounded-full border-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ $settings['link_wa'] ?? '#' }}" class="inline-flex items-center justify-center p-2 transition-opacity hover:opacity-80 border-2 rounded-full border-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd" />
                                <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                            </svg>
                        </a>
                        <a href="{{ $settings['link_yt'] ?? '#' }}" class="inline-flex items-center justify-center p-2 transition-opacity hover:opacity-80 border-2 rounded-full border-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd" />
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- Right Column -->
                <div class="mt-8 md:mt-0 md:mr-8 md:pr-50">
                    <ul class="text-center md:text-left space-y-2.5">
                        <p class="mb-3 text-xl font-semibold text-white flex space-x-3">
                            <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
                            </svg>
                            <span>Hubungi Kami</span>

                        </p>
                        <li>
                            <a href="#" class="flex text-white py-1 hover:opacity-80 text-sm space-x-2.5">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11 4a1 1 0 0 0-1 1v10h10.459l.522-3H16a1 1 0 1 1 0-2h5.33l.174-1H16a1 1 0 1 1 0-2h5.852l.117-.67v-.003A1.983 1.983 0 0 0 20.06 4H11ZM9 18c0-.35.06-.687.17-1h11.66c.11.313.17.65.17 1v1a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1v-1Zm-6.991-7a17.8 17.8 0 0 0 .953 6.1c.198.54 1.61.9 2.237.9h1.34c.17 0 .339-.032.495-.095a1.24 1.24 0 0 0 .41-.27c.114-.114.2-.25.254-.396a1.01 1.01 0 0 0 .055-.456l-.242-2.185a1.073 1.073 0 0 0-.395-.71 1.292 1.292 0 0 0-.819-.286H5.291c-.12-.863-.17-1.732-.145-2.602-.024-.87.024-1.74.145-2.602H6.54c.302 0 .594-.102.818-.286a1.07 1.07 0 0 0 .396-.71l.24-2.185a1.01 1.01 0 0 0-.054-.456 1.088 1.088 0 0 0-.254-.397 1.223 1.223 0 0 0-.41-.269A1.328 1.328 0 0 0 6.78 4H4.307c-.3-.001-.592.082-.838.238a1.335 1.335 0 0 0-.531.634A17.127 17.127 0 0 0 2.008 11Z" clip-rule="evenodd" />
                                </svg>

                                <span>Telepon/Fax : {{ $settings['nomor_telp'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex text-white py-1 hover:opacity-80 text-sm space-x-2.5">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" />
                                </svg>

                                <span>No. HP : {{ $settings['nomor_hp'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex text-white py-1 hover:opacity-80 text-sm space-x-2.5">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                </svg>

                                <span>Email : {{ $settings['email'] }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center w-full py-3 mt-4 border-t border-white">
                <p class="text-sm text-white px-4">
                    Copyright © 2024
                    <a href="https://material-tailwind.com/" class="hover:opacity-80">Material Tailwind</a>.
                    All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> --}}
    @livewireScripts
    @stack('scripts')
</body>
</html>
