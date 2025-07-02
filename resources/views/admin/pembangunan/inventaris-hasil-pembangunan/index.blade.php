<div>
    <x-slot:judul>
        Data Kegiatan Pembangunan
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Inventaris Hasil Pembangunan</h1>
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
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Inventaris Hasil Pembangunan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <a href="/D3" class="cursor-pointer bg-teal-700 text-white focus:ring-2 focus:outline-none focus:ring-teal-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
                </svg>
                <span>Cetak Laporan Inventaris Hasil Pembangunan</span>
            </a>
        </div>

        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed" id="dataTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Nama Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Pelaksana
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Waktu Mulai
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Waktu Selesai
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Sifat Proyek
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 cursor-pointer">
                            Status Proyek
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    @foreach ($pembangunanData as $index => $item)
                    <tr class="hover:bg-gray-300 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->nama_kegiatan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->pelaksana }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->translatedFormat('d F Y')}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->sifat_proyek }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">
                            {{ $item->status_pengerjaan }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pembangunanData->links('vendor.pagination.tailwind') }}
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
