<div>
    <x-slot:judul>
        Data Settings
    </x-slot:judul>

    <div class="mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Data Beranda</h1>

        <nav class="flex my-4" aria-label="Breadcrumb">
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
                        <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Beranda</span>
                    </div>
                </li>
            </ol>
        </nav>

        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <!-- Image Upload Section -->
                <div class="input-component">
                    <label for="gambar_landing_page" class="block mb-2 text-sm font-semibold text-gray-950">Gambar Landing Page</label>

                    <!-- Show existing image if available -->
                    @if($existingGambar)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $existingGambar) }}" alt="Current landing page image" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif

                    <!-- Show preview of new image if selected -->
                    @if($gambar_landing_page)
                    <div class="mb-4">
                        <p class="text-sm text-black mb-2 font-semibold text-center mb-4">Preview gambar terbaru</p>
                        <img src="{{ $gambar_landing_page->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif

                    <!-- File Input -->
                    <input id="gambar_landing_page" wire:model="gambar_landing_page" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-sky-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('gambar_landing_page') border-red-500 @enderror" type="file">

                    <div class="h-0.25">
                        @error('gambar_landing_page')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>

                    <!-- Loading indicator for file upload -->
                    <div wire:loading wire:target="gambar_landing_page" class="text-sky-500 text-sm mt-2">
                        Uploading...
                    </div>
                </div>

                <div class="input-component">
                    <label for="deskripsi_beranda" class="block mb-2 text-sm font-semibold">Caption Gambar Landing Page</label>
                    <input type="text" id="deskripsi_beranda" wire:model.live="deskripsi_beranda" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('deskripsi_beranda') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Link Iframe Maps " autocomplete="off" />
                    <div class="h-0.25">
                        @error('deskripsi_beranda') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="deskripsi-singkat-desa-container" class="block mb-2 text-sm font-semibold text-gray-950">Deskripsi Singkat Desa</label>
                    <div wire:ignore>
                        <!-- Editor container -->
                        <div id="deskripsi-singkat-desa-container" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                            {!! $deskripsi_singkat_desa !!}
                        </div>
                        <!-- Hidden input for Livewire binding -->
                        <input type="hidden" id="deskripsi-singkat-desa-input" wire:model="deskripsi_singkat_desa">
                    </div>
                    <div class="h-0.25">
                        @error('deskripsi_singkat_desa')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="deskripsi-singkat-organisasi-container" class="block mb-2 text-sm font-semibold text-gray-950">Deskripsi Singkat Organisasi Desa</label>
                    <div wire:ignore>
                        <!-- Editor container -->
                        <div id="deskripsi-singkat-organisasi-container" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                            {!! $deskripsi_singkat_organisasi !!}
                        </div>
                        <!-- Hidden input for Livewire binding -->
                        <input type="hidden" id="deskripsi-singkat-organisasi-input" wire:model="deskripsi_singkat_organisasi">
                    </div>
                    <div class="h-0.25">
                        @error('deskripsi_singkat_organisasi')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="flex justify-between mt-6">
                    <a href="/admin" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                    <button type="submit" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-2 focus:outline-none focus:ring-sky-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Ubah Data</button>
                </div>
        </form>
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {


        const quillDesa = new Quill('#deskripsi-singkat-desa-container', {
            theme: 'snow'
            , placeholder: 'Masukan Deskripsi Singkat Desa'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        const quillOrganisasi = new Quill('#deskripsi-singkat-organisasi-container', {
            theme: 'snow'
            , placeholder: 'Masukan Deskripsi Singkat Organisasi'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        // Set initial content
        quillDesa.root.innerHTML = document.querySelector('#deskripsi-singkat-desa-input').value || '';
        quillOrganisasi.root.innerHTML = document.querySelector('#deskripsi-singkat-organisasi-input').value || '';

        quillDesa.on('text-change', function() {
            const content = quillDesa.root.innerHTML;
            document.querySelector('#deskripsi-singkat-desa-input').value = content;
            @this.set('deskripsi_singkat_desa', content);
        });

        quillOrganisasi.on('text-change', function() {
            const content = quillOrganisasi.root.innerHTML;
            document.querySelector('#deskripsi-singkat-organisasi-input').value = content;
            @this.set('deskripsi_singkat_organisasi', content);
        });

        // Handle Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            if (component.id === @this.__id) {

                const currentDesaContent = quillDesa.root.innerHTML;
                const newDesaContent = component.get('deskripsi_singkat_desa');
                if (currentDesaContent !== newDesaContent) {
                    quillDesa.root.innerHTML = newDesaContent;
                }

                const currentOrganisasiContent = quillOrganisasi.root.innerHTML;
                const newOrganisasiContent = component.get('deskripsi_singkat_organisasi');
                if (currentOrganisasiContent !== newOrganisasiContent) {
                    quillOrganisasi.root.innerHTML = newOrganisasiContent;
                }
            }
        });
    });

</script>
@endpush
