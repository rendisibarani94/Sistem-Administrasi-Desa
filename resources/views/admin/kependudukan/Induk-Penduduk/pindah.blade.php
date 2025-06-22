<div>
    <x-slot:judul>
        Penduduk Pindah
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <h1 class="font-bold text-3xl text-black mt-8">Penduduk Pindah</h1>
        {{-- Create Button & Table Search Section --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <div class="flex flex-wrap gap-2">
                <!-- Tambah Induk Penduduk Button -->
                <a href="{{ route('indukPenduduk') }}" type="button" class="cursor-pointer bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                    </svg>
                    <span>Induk Penduduk</span>
                </a>
            </div>

            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" type="search" wire:model.live="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari Data Penduduk" required />
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
                            Status Perkawinan
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
                            {{ $item->status_perkawinan }}
                        </td>
                        <td class="px-6 py-4 font-semibold flex space-x-4 justify-center">
                            <!-- Detail Button -->

                            <a href="{{ route('indukPenduduk.mutasi.detail', $item->id_penduduk) }}" class="text-teal-600 hover:text-teal-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                                <span>Detail</span>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('indukPenduduk.mutasi.edit', $item->id_penduduk) }}" class="text-blue-600 hover:text-blue-900 font-medium transition rounded-sm duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.121 2.121 0 0 1 3 3L7.487 18.862l-3.75.75.75-3.75L16.862 3.487Z" />
                                </svg>
                                <span>Edit</span>
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
