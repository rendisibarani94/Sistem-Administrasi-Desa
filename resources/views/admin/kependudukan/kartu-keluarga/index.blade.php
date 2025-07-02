<div>
    <x-slot:judul>
        Kartu Keluarga
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Kartu Keluarga</h1>
        </div>

        <div class="flex justify-between mx-4">
            <nav class="flex " aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-blue-600 ">
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
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Kartu Keluarga</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <a href="/B5" class="cursor-pointer bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                </svg>
                <span>Cetak Buku Kartu Keluarga</span>
            </a>
        </div>

        {{-- Create Modals Button & Table Search --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <!-- Button -->
            <a href="{{ route('kartuKeluarga.create') }}" class="cursor-pointer bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
                <span>Tambah Kartu Keluarga</span>
            </a>

            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" type="search" wire:model.live="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Nomor, Alamat, dan Kepala Keluarga" required />
            </div>
        </div>

        {{-- Table --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed" id="dataTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Nomor Kartu Keluarga
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Kepala Keluarga
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Tanggal Keluar Surat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($kartu_keluargaData as $index => $item)
                    <tr class="page-row bg-white hover:bg-gray-300 transition duration-200 border-b-2 border-gray-300 "> {{-- @if($loop->index >= 10) hidden @endif" data-index="{{ $index }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-center font-semibold">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nomor_kartu_keluarga }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nama_kepala_keluarga  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->alamat_kk  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ \Carbon\Carbon::parse($item->tanggal_keluar)->locale('id')->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold flex justify-center space-x-4">

                            <a href="{{ route('kartuKeluarga.detail', $item->id_kartu_keluarga) }}" class="text-teal-600 hover:text-teal-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span>Detail</span>
                            </a>
                            <!-- Edit Button -->
                            <a href="{{ route('kartuKeluarga.edit', $item->id_kartu_keluarga) }}" class="text-blue-600 hover:text-blue-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 pt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <!-- Delete Button -->
                            <a type="button" wire:click="confirmDelete({{ $item->id_kartu_keluarga }})" class="text-red-600 hover:text-red-900 font-medium transition duration-200 flex items-center space-x-1.5 cursor-pointer">
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
                {{ $kartu_keluargaData->links('vendor.pagination.tailwind') }}
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

        // Handle the success message
        @this.on('swal:success', (parameters) => {
            Swal.fire({
                title: parameters[0].title
                , text: parameters[0].text
                , icon: parameters[0].icon
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
