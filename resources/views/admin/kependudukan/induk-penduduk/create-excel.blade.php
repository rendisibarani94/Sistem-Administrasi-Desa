<div>
    <x-slot:judul>
        Create Induk Penduduk
    </x-slot:judul>

    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Import Data Penduduk dan Kartu Keluarga </h1>
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
                    <li>
                        <div class="flex items-center">
                            <a href="{{ route('indukPenduduk') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-700 ">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                Induk Penduduk
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Import Data Penduduk dan Kartu Keluarga</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md">
            @if($importSuccess)
            <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-4">
                <p class="text-green-700">
                    Sukses!! Input {{ $importedKKCount }} Data Kartu Keluarga dan {{ $importedPendudukCount }} Data Penduduk !
                </p>
            </div>
            @endif

            @if(count($errors))
            <div class="bg-red-100 border-l-4 border-red-500 p-4 mb-4">
                <h3 class="font-bold text-red-700">Import Errors:</h3>
                <ul class="list-disc pl-5 mt-2">
                    @foreach($errors as $error)
                    <li class="text-red-700 text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="flex justify-between">
                <div>
                    <form wire:submit.prevent="import" enctype="multipart/form-data">
                        <input type="file" wire:model="file" class="mb-4 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer">

                        @error('file')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer mt-4" wire:loading.attr="disabled">
                            <span wire:loading.remove>Import Data</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </form>
                </div>
                <div class="download-template">
                    <button wire:click="downloadTemplate" wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer flex items-center gap-2">

                        <span wire:loading.remove wire:target="downloadTemplate" class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd" />
                            </svg>
                            Download Template
                        </span>

                        <span wire:loading wire:target="downloadTemplate">
                            Preparing...
                        </span>
                    </button>
                </div>
            </div>

        </div>
    </div>
