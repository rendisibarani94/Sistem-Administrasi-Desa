@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<body>

    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-700 -translate-x-full sm:translate-x-0 " aria-label="Sidebar">
        <div class="longbar h-14 bg-teal-700 flex justify-center items-center text-center">
            <span class="p-4 text-xl text-white font-medium">
                Administrasi Desa
            </span>
        </div>

        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 shadow-sm shadow-black">
            <ul class="space-y-2 font-medium">
                @php
                $masterIcon = '
                <path d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />';
                $masterChildLinks = [
                [
                'route' => 'pekerjaan',
                'text' => 'Pekerjaan',
                ],
                [
                'route' => 'dusun',
                'text' => 'Dusun',
                ],
                [
                'route' => 'jabatan',
                'text' => 'Jabatan Aparatur',
                ],
                [
                'route' => 'kelasTanah',
                'text' => 'Kelas Tanah',
                ],
                [
                'route' => 'jenisInventaris',
                'text' => 'Jenis Inventaris Desa',
                ]
                ];
                @endphp
                <x-nav-plus-link title="Data Master" :icon="$masterIcon" :childLinks="$masterChildLinks" id="data-master-dropdown" />
                @php
                $umumIcon = '
                <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd" />';
                $childLinks = [
                [
                'route' => 'PeraturanDesa',
                'text' => 'Peraturan Desa',
                ],
                [
                'route' => 'keputusanKepalaDesa',
                'text' => 'Keputusan Kepala Desa',
                ],
                [
                'route' => 'AparaturDesa',
                'text' => 'Aparatur Desa',
                ],
                [
                'route' => 'TanahKasDesa',
                'text' => 'Tanah Kas Desa',
                ],
                [
                'route' => 'InventarisDesa',
                'text' => 'Inventaris Desa',
                ],
                [
                'route' => 'TanahDesa',
                'text' => 'Tanah Desa',
                ],
                [
                'route' => 'AgendaDesa',
                'text' => 'Agenda Desa',
                ],
                ];
                @endphp
                <x-nav-plus-link title="Administrasi Umum" :icon="$umumIcon" :childLinks="$childLinks" id="beda-aja" />
                @php
                $kependudukanIcon = '
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />';
                $childLinks = [
                [
                'route' => 'indukPenduduk',
                'text' => 'Induk Penduduk',
                ],
                [
                'route' => 'kartuKeluarga',
                'text' => 'Kartu Keluarga',
                ],
                [
                'route' => 'pendudukSementara',
                'text' => 'Penduduk Sementara',
                ],
                ];
                @endphp
                <x-nav-plus-link title="Kependudukan" :icon="$kependudukanIcon" :childLinks="$childLinks" id="ecommerce-dropdown" />

                @php
                $pembangunanIcon = '
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />';
                $childLinks = [
                
                ];
                @endphp
                <x-nav-plus-link title="Pembangunan" :icon="$pembangunanIcon" :childLinks="$childLinks" id="pembangunan-dropdown" />

            </ul>
        </div>
    </aside>

    <!-- Fixed Header (Longbar) -->
    <div class="longbar fixed top-0 left-0 w-full h-14 bg-teal-700 z-50">
        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-zinc-950 dark:hover:bg-teal-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-7 h-7 text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
    </div>

    <!-- Main Content (with top padding to avoid overlap with header) -->
    <div class="main p-4 sm:ml-64 pt-14" id="main-content">
        {{ $slot }}
    </div>

    {{-- Script --}}
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                title: 'Sukses!'
                , text: "{{ session('success') }}"
                , imageUrl: "{{ asset('vendor/sweetalert/success/sukses.gif') }}"
                , imageWidth: 250
                , imageHeight: 250
                , imageAlt: 'Custom GIF'
                , confirmButtonText: 'OK'
                , confirmButtonColor: '#0f766e'
            });
            @elseif(session('error'))
            Swal.fire({
                title: 'Gagal!'
                , text: "{{ session('error') }}"
                , icon: 'error'
                , confirmButtonText: 'OK'
            });
            @endif
        });

    </script>
    <script>
        // Listen for clicks on the document
        document.addEventListener('click', function(event) {
            // Only run on small devices
            if (window.innerWidth < 640) {
                const sidebar = document.getElementById('sidebar-multi-level-sidebar');
                const toggleButton = document.querySelector('[data-drawer-toggle="sidebar-multi-level-sidebar"]');
                // Check if the sidebar is open (it's open when it doesn't have the "-translate-x-full" class)
                if (!sidebar.classList.contains('-translate-x-full')) {
                    // Check if the click occurred outside the sidebar and outside the toggle button
                    if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                        // Trigger a click on the toggle button to close the sidebar
                        toggleButton.click();
                    }
                }
            }
        });

    </script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @livewireScripts
</body>
</html>
