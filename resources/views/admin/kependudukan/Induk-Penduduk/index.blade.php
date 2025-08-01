<div>
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
                        <td class="px-6 py-4 font-semibold flex space-x-4 justify-center">
                            <!-- Edit Button -->
                            <a href="{{ route('indukPenduduk.edit', $item->id_penduduk) }}" class="text-green-600 hover:text-green-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
                            </a>

                            <!-- Edit Button -->
                            <a wire:click="mutasi({{ $item->id_penduduk }})" class="text-orange-500 hover:text-orange-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg class="w-6 h-6 text-orange-500 hover:text-orange-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-6 pt-1">
                                    <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd" />
                                </svg>

                                <span>Mutasi</span>
                            </a>

                            <!-- Delete Button -->
                            <a wire:click="confirmDelete({{ $item->id_penduduk }})" type="button" class="text-red-600 hover:text-red-900 font-medium transition duration-200 flex items-center space-x-1.5 cursor-pointer">
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
                {{ $pendudukData->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

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
