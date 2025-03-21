<div>
    <x-slot:judul>
        Induk Penduduk
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        {{-- Information Container --}}
        <div class="my-6 rounded-sm border-2 border-gray-300 p-4 md:p-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Cards - Stack vertically on mobile, horizontally on larger screens -->
            <div class="card rounded-xl border-2 shadow-lg shadow-gray-500/50 border-gray-300 w-full md:w-1/5 mb-4 md:mb-0">
                <div class="p-4 md:p-8 text-center">
                    <h4 class="font-bold">Total Penduduk</h4>
                    <h4 class="font-bold text-teal-700">60 Orang</h4>
                </div>
            </div>
            <div class="card rounded-xl border-2 shadow-lg shadow-gray-500/50 border-gray-300 w-full md:w-1/5 mb-4 md:mb-0">
                <div class="p-4 md:p-8 text-center">
                    <h4 class="font-bold">Total Penduduk</h4>
                    <h4 class="font-bold text-teal-700">60 Orang</h4>
                </div>
            </div>
            <div class="card rounded-xl border-2 shadow-lg shadow-gray-500/50 border-gray-300 w-full md:w-1/5 mb-4 md:mb-0">
                <div class="p-4 md:p-8 text-center">
                    <h4 class="font-bold">Total Penduduk</h4>
                    <h4 class="font-bold text-teal-700">60 Orang</h4>
                </div>
            </div>

            <!-- Button - Full width on mobile -->
            <a type="button" class="cursor-pointer bg-teal-700 text-white font-bold py-2 px-4 h-10 rounded flex items-center justify-center md:justify-start space-x-2 w-full md:w-auto">
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                </svg>
                <span>Cetak Data Kependudukan</span>
            </a>
        </div>

        {{-- Create Button & Table Search Section --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <!-- Button -->
            <a href="{{ route('indukPenduduk.create') }}" type="button" class="cursor-pointer bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Data Induk Penduduk</span>
            </a>

            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" type="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari Data Penduduk" required />
            </div>
        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-fixed" id="dataTable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer text-center">
                            Nama
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer text-center">
                            NIK
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer text-center">
                            Alamat
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer text-center">
                            Status Perkawinan
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer text-center">
                            Agama
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($pendudukData as $index => $item)
                    <tr class="page-row bg-white hover:bg-gray-300 transition duration-200 border-b-2 border-gray-300 @if($loop->index >= 10) hidden @endif" data-index="{{ $index }}" >  
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold">
                            {{ $item->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold text-center">
                            {{ $item->nik }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold text-center">
                            {{ $item->alamat }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold text-center">
                            {{ $item->status_perkawinan }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold text-center">
                            {{ $item->agama }}
                        </td>
                        <td class="px-6 py-4 font-semibold flex space-x-4 justify-center">
                            <!-- Edit Button -->
                            <a href="{{ route('indukPenduduk.edit', $item->id_penduduk) }}" class="text-blue-600 hover:text-blue-800 hover:font-bold font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <!-- Delete Button -->
                            <a wire:click="confirmDelete({{ $item->id_penduduk }})" type="button" class="text-red-600 hover:text-red-800 hover:font-bold font-medium transition duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{-- {{ $pekerjaanData->links('vendor.pagination.tailwind') }} --}}
            </div>
        </div>
    </div>
    
        <!-- Delete Modal -->
        <div id="delete-modal" wire:key="delete-modal" class="fixed inset-0 z-50 items-center justify-center {{ $deletePendudukId ? 'flex' : 'hidden' }}">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black opacity-50" wire:click="hideDeleteModal"></div>
    
            <!-- Modal Content -->
            <div class="relative p-4 w-full max-w-md z-50">
                <div class="relative bg-white rounded-lg shadow-md border border-gray-300">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" wire:click="hideDeleteModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
    
                    <!-- Modal body -->
                    <div class="p-4">
                        <p class="text-sm text-gray-700">Apakah Anda yakin ingin menghapus data Induk Penduduk ini?</p>
                    </div>
    
                    <!-- Modal footer -->
                    <div class="flex justify-end p-4 space-x-2 border-t border-gray-200">
                        <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 cursor-pointer" wire:click="hideDeleteModal">
                            Tidak
                        </button>
                        <button type="button" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-900 cursor-pointer" wire:click="delete">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>
