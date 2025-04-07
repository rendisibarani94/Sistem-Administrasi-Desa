<div>
    <x-slot:judul>
        Bidang Keahlian
    </x-slot:judul>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Data Bidang Keahlian</h1>
        </div>

        {{-- Create Modals Button & Table Search --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <!-- Button -->
            <button type="button" data-modal-target="store-modal" data-modal-toggle="store-modal" class="cursor-pointer bg-teal-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
                <span>Tambah Data Bidang Keahlian</span>
            </button>

            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" type="search" wire:model.live="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari bidang_keahlian" required />
            </div>
        </div>

        <!-- Table Pekerjaan -->
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-fixed" id="dataTable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" wire:click="sortBy('bidang_keahlian')" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 cursor-pointer">
                            Bidang Keahlian
                        </th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($bidangKeahlianData as $index => $item)
                    <tr class="page-row bg-white hover:bg-gray-300 transition duration-200 border-b-2 border-gray-300 @if($loop->index >= 10) hidden @endif" data-index="{{ $index }}">
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold no-cell ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 text-gray-950 whitespace-nowrap font-semibold no-cell ">
                            {{ $item->bidang_keahlian }}
                        </td>
                        <td class="px-6 py-4 font-semibold flex space-x-4 justify-center">

                            <!-- Edit Button -->
                            <button wire:click="loadBidangKeahlian({{ $item->id_bidang_keahlian }})" class="text-blue-600 hover:text-blue-800 hover:font-bold font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 pt-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" wire:click="confirmDelete({{ $item->id_bidang_keahlian }})" class="text-red-600 hover:text-red-800 hover:font-bold font-medium transition duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $bidangKeahlianData->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>

    <!-- Store modal -->
    <div id="store-modal" tabindex="-1" aria-hidden="true" class="hidden inset-0 bg-black/50 transition-opacity duration-300 ease-out overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full transform transition-all duration-300 ease-out scale-95">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-md border-2 border-gray-500">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Tambah Data bidang_keahlian Baru
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="store-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit.prevent="store" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="bidang_keahlian" class="block mb-2 text-sm font-medium text-gray-900">Bidang Keahlian</label>
                            <input type="text" wire:model="bidang_keahlian" id="bidang_keahlian" autocomplete="off" class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Bidang Keahlian" required>
                        </div>
                    </div>
                    <button type="submit" class="font-semibold text-white inline-flex items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg ml-auto text-sm px-5 py-2.5 text-center cursor-pointer">
                        Tambahkan Bidang Keahlian
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true" class="{{ $this->bidang_keahlianId ? '' : 'hidden' }} flex inset-0 z-40 bg-black/50 transition-opacity duration-300 ease-out overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full transform transition-all duration-300 ease-out scale-95">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-md border-2 border-gray-500">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit Data Bidang Keahlian
                    </h3>
                    <!-- In your edit modal -->
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" wire:click="hideEditModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form wire:submit.prevent="edit" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="bidang_keahlian" class="block mb-2 text-sm font-medium text-gray-900">Bidang Keahlian</label>
                            <input type="text" wire:model="bidang_keahlian" id="bidang_keahlian" autocomplete="off" class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Bidang Keahlian" required>
                            @error('bidang_keahlian') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="font-semibold text-white inline-flex items-center bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg ml-auto text-sm px-5 py-2.5 text-center cursor-pointer">
                        Ubah Data
                    </button>
                </form>
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
                title: parameters[0].title,
                text: parameters[0].text,
                icon: parameters[0].icon,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: parameters[0].confirmButtonText,
                cancelButtonText: parameters[0].cancelButtonText,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.delete();
                }
            });
        });
        
        // Handle the success message with custom GIF
        @this.on('swal:success', (parameters) => {
            Swal.fire({
                title: parameters[0].title,
                text: parameters[0].text,
                imageUrl: "{{ asset('vendor/sweetalert/success/sukses.gif') }}", 
                imageWidth: 250, 
                imageHeight: 250, 
                imageAlt: 'Custom GIF', 
                confirmButtonText: 'OK', 
                confirmButtonColor: '#0f766e'
            });
        });
    });
</script>
@endpush