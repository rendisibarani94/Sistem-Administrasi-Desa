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

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
</head>
<body>

    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-700 -translate-x-full sm:translate-x-0 " aria-label="Sidebar">
        <div class="longbar h-14 bg-teal-700 flex justify-center items-center text-center">
            <span class="p-4 text-xl text-white font-medium">
                Administrasi Desa
            </span>
        </div>

        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 shadow-sm shadow-black">
            <ul class="space-y-2 font-medium mb-10">
                <a href="{{ route('beranda.admin') }}" class="flex flex-col items-center justify-center mb-4">
                    <img src="{{ asset('storage/'. $settings['logo']) }}" class="h-10 rounded-sm mb-2 border border-gray-500" alt="Flowbite Logo" />
                    <span class="text-md font-semibold whitespace-nowrap text-black">{{ $settings['nama_desa'] }}</span>
                </a>
                <h5 class="text-xs font-semibold text-black pl-3">Administrasi Desa</h5>
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
                'route' => 'bidangKeahlian',
                'text' => 'Bidang Keahlian',
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
                'route' => 'AgendaSuratDesa',
                'text' => 'Agenda Surat Desa',
                ],
                ];
                @endphp
                <x-nav-plus-link title="Administrasi Umum" :icon="$umumIcon" :childLinks="$childLinks" id="beda-aja" />
                @php
                $kependudukanIcon = '
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />';
                $childLinks = [
                // [
                // 'route' => 'statistikKependudukan',
                // 'text' => 'Statistik Kependudukan',
                // ],
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
                <x-nav-plus-link title="Kependudukan" :icon="$kependudukanIcon" :childLinks="$childLinks" id="kependudukan-dropdown" />

                @php
                $pembangunanIcon = '
                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd" />';
                $childLinks = [
                [
                'route' => 'Pembangunan',
                'text' => 'Kegiatan Pembangunan',
                ],
                [
                'route' => 'HasilPembangunan',
                'text' => 'Hasil Pembangunan',
                ],
                [
                'route' => 'KaderPemberdayaanMasyarakat',
                'text' => 'Kader Pemberdayaan',
                ],
                ];
                @endphp
                <x-nav-plus-link title="Pembangunan" :icon="$pembangunanIcon" :childLinks="$childLinks" id="pembangunan-dropdown" />

                <h5 class="text-xs font-semibold text-black pl-3">Informasi Desa</h5>


                <x-nav-link href="{{ route('settings') }}" :active="request()->routeIs('settings')" path='<path d="m2.26726 6.15309c.26172-.80594.69285-1.54574 1.26172-2.1727.09619-.10602.24711-.14381.38223-.0957l1.35948.484c.36857.13115.77413-.06004.90584-.42703.01295-.03609.02293-.07316.02982-.1108l.259-1.41553c.02575-.14074.13431-.25207.27484-.28186.41118-.08714.83276-.13146 1.25987-.13146.42685 0 .84818.04427 1.25912.1313.14049.02976.24904.14102.27485.28171l.25973 1.41578c.07022.38339.43924.63751.82434.5676.0379-.00688.0751-.01681.1113-.02969l1.3595-.48402c.1351-.04811.286-.01032.3822.0957.5689.62696 1 1.36676 1.2618 2.1727.0441.13596.0015.28502-.1079.3775l-1.1019.93152c-.2983.25225-.3348.69756-.0815.99463.0249.02921.0522.05635.0815.08114l1.1019.93153c.1094.09248.152.24154.1079.37751-.2618.80598-.6929 1.54578-1.2618 2.17268-.0962.106-.2471.1438-.3822.0957l-1.3595-.484c-.3685-.1311-.7741.0601-.90581.427-.01295.0361-.02293.0732-.02985.111l-.25971 1.4157c-.02581.1407-.13436.2519-.27485.2817-.41094.087-.83227.1313-1.25912.1313-.42711 0-.84869-.0443-1.25987-.1315-.14053-.0298-.24909-.1411-.27484-.2818l-.25899-1.4155c-.07022-.3834-.43928-.6375-.82433-.5676-.03787.0069-.0751.0168-.11128.0297l-1.35954.484c-.13512.0481-.28604.0103-.38223-.0957-.56887-.6269-1-1.3667-1.26172-2.17268-.04415-.13597-.00158-.28503.10783-.37751l1.1019-.93152c.29835-.25225.33484-.69756.08151-.99463-.02491-.02921-.05217-.05635-.0815-.08114l-1.10191-.93153c-.10941-.09248-.15198-.24154-.10783-.3775zm3.98268 1.84685c0 .9665.7835 1.75 1.75 1.75s1.75-.7835 1.75-1.75-.7835-1.75-1.75-1.75-1.75.7835-1.75 1.75z" fill="#212121"/>' customClass="my-custom-class">
                    Settings
                </x-nav-link>

                <x-nav-link href="{{ route('admin.beranda') }}" :active="request()->routeIs('admin.beranda')" path='<path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/>' viewBox='0 0 24 24' customClass="my-custom-class">
                    Beranda
                </x-nav-link>


                <x-nav-link href="{{ route('admin.profil') }}" :active="request()->routeIs('admin.profil')" path='<path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>' customClass="my-custom-class" viewBox="0 0 24 24">
                    Profil
                </x-nav-link>

                @php
                $masyarakatIcon = '
                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd" />';
                $childIMLinks = [
                [
                'route' => 'admin.agenda',
                'text' => 'Agenda Desa',
                ],
                [
                'route' => 'admin.apbdes',
                'text' => 'APBDesa',
                ],
                [
                'route' => 'admin.berita',
                'text' => 'Berita Desa',
                ],
                [
                'route' => 'admin.organisasi',
                'text' => 'Organisasi Desa',
                ],
                [
                'route' => 'admin.pengumuman',
                'text' => 'Pengumuman Desa',
                ],
                ];
                @endphp
                <x-nav-plus-link title="Informasi Masyarakat" :icon="$masyarakatIcon" :childLinks="$childIMLinks" id="informasi-masyarakat-dropdown" />

                <x-nav-link href="{{ route('beranda') }}" :active="request()->routeIs('beranda')" path='<path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>' customClass="my-custom-class" viewBox="0 0 24 24">
                    Halaman Masyarakat
                </x-nav-link>

                @auth
                <x-nav-form-button method="POST" action="{{ route('logout') }}" icon='<path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z" clip-rule="evenodd" />' text="Logout" />
                @endauth



            </ul>
        </div>
    </aside>

    <!-- Fixed Header (Longbar) -->
    <div class="longbar fixed top-0 left-0 w-full h-14 bg-teal-700 z-50">
        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
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
    @livewireScripts
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
    {{-- <script src="{{ asset('js/rupiah-input.js') }}"></script> --}}
</body>
</html>
