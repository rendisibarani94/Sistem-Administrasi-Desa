<div>
    <style>[x-cloak] { display: none !important; }</style>
    <x-slot:judul>
        Induk Penduduk
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Induk Penduduk</h1>
        </div>

        <div class="flex justify-between mx-4 ">
            <nav class="flex mr-30" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700 ">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Induk Penduduk</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex space-x-2">
                <a href="/B1" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                    </svg>
                    <span>Buku Induk Penduduk</span>
                </a>
                <a href="/B2" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                    </svg>
                    <span>Buku Mutasi Penduduk</span>
                </a>
                <a href="/B3" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                    </svg>
                    <span>Buku Rekapitulasi Jumlah Penduduk</span>
                </a>
            </div>
        </div>

        {{-- Create Button & Table Search Section --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <div class="flex flex-wrap gap-2">
                <!-- Tambah Induk Penduduk Button -->
                <a href="{{ route('indukPenduduk.create') }}" type="button" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Data Induk Penduduk</span>
                </a>

                <!-- Tambah Induk Penduduk Dengan Excel Button -->
                <a href="{{ route('indukPenduduk.create.excel') }}" type="button" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Data Induk Penduduk Dengan Excel</span>
                </a>

                <!-- Tambah Induk Penduduk Button -->
                <a href="{{ route('indukPenduduk.pindah') }}" type="button" class="cursor-pointer bg-orange-500 text-white focus:ring-2 focus:outline-none focus:ring-orange-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd" />
                    </svg>
                    <span>Penduduk Pindah</span>
                </a>

                <!-- Unduh Pertinggal Akun Button -->
                @if(file_exists(public_path('excel/pertinggal_akun_warga.csv')))
                <a href="{{ asset('excel/pertinggal_akun_warga.csv') }}" download class="cursor-pointer bg-green-600 hover:bg-green-700 text-white focus:ring-2 focus:outline-none focus:ring-green-500 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto" title="Unduh spreadsheet pertinggal pembuatan akun baru (dengan password polos)">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                    </svg>
                    <span>Unduh Pertinggal Akun (.csv)</span>
                </a>
                @endif

                <!-- Ekspor Semua Akun Warga Button -->
                <button wire:click="exportAllAccounts" type="button" class="cursor-pointer bg-teal-600 hover:bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-500 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto" title="Unduh spreadsheet seluruh akun warga yang ada di database">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                    </svg>
                    <span>Ekspor Semua Akun (Excel)</span>
                </button>
            </div>

            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" type="search" wire:model.live="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-sky-500 focus:border-sky-500" placeholder="Cari Data Penduduk" required />
            </div>
        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 mb-6 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed" id="dataTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Status Kedudukan Keluarga
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($pendudukData as $index => $item)
                    <tr class="page-row bg-white hover:bg-gray-300 transition duration-200 border-b-2 border-gray-300 @if($loop->index >= 10) hidden @endif" data-index="{{ $index }}">
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nik }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->alamat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->kedudukan_keluarga }}
                        </td>
                        <td class="px-6 py-4 font-semibold flex space-x-3 justify-center items-center">
                            <!-- Account Status / Create Account Button -->
                            @php
                                $userAcc = DB::table('users')->where('nik', $item->nik)->first();
                            @endphp
                            @if($userAcc)
                                <div class="flex flex-col items-center space-y-1">
                                    <div class="inline-flex items-center text-teal-700 font-bold bg-teal-50 border border-teal-200 px-2 py-0.5 rounded text-xs space-x-1" title="Email: {{ $userAcc->email }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4.13-5.58Z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Akun Aktif</span>
                                    </div>
                                    <a wire:click="openResetPasswordModal({{ $item->id_penduduk }})" class="text-orange-600 hover:text-orange-950 font-bold text-[10px] underline cursor-pointer" title="Ubah kata sandi akun ini">
                                        Ubah Sandi
                                    </a>
                                </div>
                            @else
                                <a wire:click="openCreateAccountModal({{ $item->id_penduduk }})" class="text-sky-600 hover:text-sky-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1 cursor-pointer" title="Buatkan akun untuk warga ini">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6 6 0 0 1 6-6h.75a6 6 0 0 1 6 6v.11m-12 0A1.75 1.75 0 0 0 4.75 21h8.5A1.75 1.75 0 0 0 15 19.235" />
                                    </svg>
                                    <span class="text-xs">Buat Akun</span>
                                </a>
                            @endif

                            <div class="h-4 w-px bg-gray-300 mx-1"></div>

                            <!-- Edit Button -->
                            <a href="{{ route('indukPenduduk.edit', $item->id_penduduk) }}" class="text-green-600 hover:text-green-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span class="text-xs">Edit</span>
                            </a>

                            <!-- Mutasi Button -->
                            <a wire:click="mutasi({{ $item->id_penduduk }})" class="text-orange-500 hover:text-orange-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1 cursor-pointer">
                                <svg class="w-4 h-4 text-orange-500 hover:text-orange-850" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs">Mutasi</span>
                            </a>

                            <!-- Delete Button -->
                            <a wire:click="confirmDelete({{ $item->id_penduduk }})" type="button" class="text-red-600 hover:text-red-900 font-medium transition duration-200 flex items-center space-x-1 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                <span class="text-xs">Hapus</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pendudukData->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

    {{-- Modal Buat Akun Warga --}}
    @if($showAccountModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black opacity-40"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-md mx-auto my-6 z-50">
            <div class="relative flex flex-col w-full bg-white border-0 rounded-xl shadow-2xl outline-none focus:outline-none">
                <!-- Header -->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t">
                    <h3 class="text-xl font-bold text-gray-900">
                        {{ $isEditMode ? 'Ubah Sandi Akun 🔒' : 'Buat Akun Masyarakat 👤' }}
                    </h3>
                    <button type="button" wire:click="closeAccountModal" class="p-1 ml-auto bg-transparent border-0 text-gray-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none hover:text-red-500 transition duration-150">
                        ×
                    </button>
                </div>
                
                <!-- Body -->
                <div class="relative p-6 flex-auto">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" class="shadow-sm border rounded-lg w-full py-2 px-3 text-gray-600 bg-gray-100 leading-tight focus:outline-none" value="{{ $selectedPendudukName }}" disabled />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
                        <input type="text" class="shadow-sm border rounded-lg w-full py-2 px-3 text-gray-600 bg-gray-100 leading-tight focus:outline-none" value="{{ $selectedPendudukNik }}" disabled />
                    </div>
                    
                    <form wire:submit.prevent="saveAccount">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email Warga <span class="text-red-500">*</span></label>
                            <input type="email" wire:model="email" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('email') border-red-500 @enderror @if($isEditMode) bg-gray-100 text-gray-500 cursor-not-allowed @endif" placeholder="warga@domain.com" required @if($isEditMode) disabled @endif />
                            @error('email') <span class="text-red-500 text-xs font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password Field with Show/Hide -->
                        <div class="mb-4" x-data="{ showPw: false }">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input :type="showPw ? 'text' : 'password'" wire:model="password" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('password') border-red-500 @enderror" placeholder="{{ $isEditMode ? 'Masukkan sandi baru' : 'Minimal 6 karakter' }}" required />
                                <button type="button" @click="showPw = !showPw" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-sky-700 focus:outline-none">
                                    <svg x-show="!showPw" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPw" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-500 text-xs font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password Field with Show/Hide -->
                        <div class="mb-6" x-data="{ showConfirmPw: false }">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input :type="showConfirmPw ? 'text' : 'password'" wire:model="confirm_password" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 pr-10 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('confirm_password') border-red-500 @enderror" placeholder="{{ $isEditMode ? 'Ulangi sandi baru' : 'Minimal 6 karakter' }}" required />
                                <button type="button" @click="showConfirmPw = !showConfirmPw" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-sky-700 focus:outline-none">
                                    <svg x-show="!showConfirmPw" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showConfirmPw" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('confirm_password') <span class="text-red-500 text-xs font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Footer Actions -->
                        <div class="flex items-center justify-end space-x-2 pt-4 border-t border-solid border-gray-200 rounded-b">
                            <button type="button" wire:click="closeAccountModal" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                                Batal
                            </button>
                            <button type="submit" class="bg-sky-700 hover:bg-sky-800 text-white font-bold py-2 px-4 rounded-lg transition duration-150 flex items-center">
                                <svg wire:loading wire:target="saveAccount" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ $isEditMode ? 'Simpan Sandi' : 'Buat Akun' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle the confirmation dialog
        @this.on('swal:confirm', (parameters) => {
            Swal.fire({
                title: parameters[0].title
                , text: parameters[0].text
                , icon: parameters[0].icon
                , showCancelButton: true
                , confirmButtonColor: '#d33'
                , cancelButtonColor: '#3085d6'
                , confirmButtonText: parameters[0].confirmButtonText
                , cancelButtonText: parameters[0].cancelButtonText
                , reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.delete();
                }
            });
        });

        // Handle the success message with custom GIF
        @this.on('swal:success', (parameters) => {
            Swal.fire({
                title: parameters[0].title
                , text: parameters[0].text
                , imageUrl: "{{ asset('vendor/sweetalert/success/sukses.gif') }}"
                , imageWidth: 250
                , imageHeight: 250
                , imageAlt: 'Custom GIF'
                , confirmButtonText: 'OK'
                , confirmButtonColor: '#0f766e'
            });
        });
    });

</script>
@endpush
