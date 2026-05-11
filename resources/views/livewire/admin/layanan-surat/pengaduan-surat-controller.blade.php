<div>
    <x-slot:judul>
        Pengaduan Surat
    </x-slot:judul>

    <div class="bg-white rounded-lg shadow-md mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Pengaduan Surat</h1>
        </div>

        <div class="flex justify-between mx-4 ">
            <nav class="flex mr-30" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700 ">
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
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Pengaduan Surat</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-between">
            <button type="button" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Pengaduan</span>
            </button>
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-sky-500 focus:border-sky-500" placeholder="Cari Pengaduan" />
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-fixed">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">No</th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">Subjek</th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">Pengirim</th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500">Status</th>
                        <th scope="col" class="w-auto px-6 py-4 font-semibold border-b-3 border-gray-500 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 font-semibold">Data belum tersedia.</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 mb-4 px-4">
                {{-- Pagination Links Here --}}
            </div>
        </div>
    </div>
</div>
