<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-zinc-950 dark:hover:bg-teal-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-sm shadow-black" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <div class="logo mb-6">
                <a href="#" class="flex items-center ps-2.5">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white dark:text-gray-950">Flowbite</span>
                </a>
            </div>
            
            <ul class="space-y-2 font-medium">
                @php
                    $masterPath = '<path d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z"/>';
                @endphp
                <x-nav-link 
                    href="{{ route('asu') }}" 
                    :active="request()->routeIs('asu')" 
                    :path="$masterPath"
                    >
                    Master
                </x-nav-link>

                @php
                $ecommerceIcon = '<path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />';
                
               $childLinks = [
                    [
                        'route' => 'product',
                        'text' => 'Product',
                    ],
                    [
                        'route' => 'invoice',
                        'text' => 'Invoice',
                    ],
                ];
            @endphp
            <x-nav-plus-link 
                title="E-commerce" 
                :icon="$ecommerceIcon"
                :childLinks="$childLinks"
                id="ecommerce-dropdown"
            />


            @php
                $masterPath = '<path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />';
            @endphp
            <x-nav-link 
                href="{{ route('asi') }}" 
                :active="request()->routeIs('asi')" 
                :path="$masterPath"
                >
                Kanban
            </x-nav-link>
                
            </ul>
        </div>
    </aside>

    <div class="main p-4 sm:ml-64" id="main-content">
        {{ $slot }}
    </div>

{{-- Script --}}
@stack('scripts')
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
</body>
</html>