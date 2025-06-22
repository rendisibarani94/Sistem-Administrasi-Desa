<div>
    <x-slot:judul>
        Tambah Data Penduduk Sementara
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-center">
            <h1 class="text-3xl font-semibold my-8">STATISTIK KEPENDUDUKAN</h1>
        </div>

        <div x-data="{ activeTab: 'umur' }" class="w-full mx-auto p-4">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap justify-evenly border-b border-gray-200">
                <button @click="activeTab = 'umur'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'umur', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'umur' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    Umur
                </button>
                <button @click="activeTab = 'dusun'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'dusun', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'dusun' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    DUSUN
                </button>
                <button @click="activeTab = 'pendidikan'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'pendidikan', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'pendidikan' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    PENDIDIKAN
                </button>
                <button @click="activeTab = 'perkawinan'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'perkawinan', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'perkawinan' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    PERKAWINAN
                </button>
                <button @click="activeTab = 'pekerjaan'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'pekerjaan', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'pekerjaan' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    PEKERJAAN
                </button>
                <button @click="activeTab = 'keluarga'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'keluarga', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'keluarga' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    KELUARGA
                </button>
                <button @click="activeTab = 'agama'" :class="{ 'border-slate-500 text-slate-950': activeTab === 'agama', 'border-transparent text-slate-950 hover:text-gray-700 hover:border-gray-300': activeTab !== 'agama' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                    AGAMA
                </button>
            </div>

            <!-- Tab Content -->
            <div class="py-4">
                <!-- Tab 1 Content -->
                <div x-show="activeTab === 'umur'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Umur Content</h2>
                </div>

                <!-- Tab 2 Content -->
                <div x-show="activeTab === 'dusun'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Dusun Content</h2>

                </div>

                <!-- Tab 3 Content -->
                <div x-show="activeTab === 'pendidikan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Pendidikan Content</h2>
                </div>

                <!-- Tab 4 Content -->
                <div x-show="activeTab === 'perkawinan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Perkawinan Content</h2>
                </div>

                <!-- Tab 5 Content -->
                <div x-show="activeTab === 'pekerjaan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Pekerjaan Content</h2>
                </div>

                <!-- Tab 6 Content -->
                <div x-show="activeTab === 'keluarga'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Keluarga Content</h2>
                </div>

                <!-- Tab 7 Content -->
                <div x-show="activeTab === 'agama'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-4 text-center">Agama Content</h2>
                </div>
            </div>
        </div>
    </div>
