<div>
    <x-slot:judul>
        Data Settings
    </x-slot:judul>

    <div class="mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Data Profil</h1>

        <nav class="flex mt-4" aria-label="Breadcrumb">
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
                        <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Profil</span>
                    </div>
                </li>
            </ol>
        </nav>

        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6 my-8">

            <div class="input-component">
                <label for="editor-container-profil-desa" class="block mb-2 text-sm font-semibold text-gray-950">Profil Desa</label>
                <div wire:ignore>
                    <div id="editor-container-profil-desa" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                        {!! $profil_desa !!}
                    </div>
                    <input type="hidden" id="profil-desa-input" wire:model="profil_desa">
                </div>
                <div class="h-0.25">
                    @error('profil_desa')
                    <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                    @enderror
                </div>
            </div>


            <div class="input-component">
                <label for="editor-container-visi-desa" class="block mb-2 text-sm font-semibold text-gray-950">Visi Desa</label>
                <div wire:ignore>
                    <div id="editor-container-visi-desa" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                        {!! $visi_desa !!}
                    </div>
                    <input type="hidden" id="visi-desa-input" wire:model="visi_desa">
                </div>
                <div class="h-0.25">
                    @error('visi_desa')
                    <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                    @enderror
                </div>
            </div>



            <div class="input-component">
                <label for="editor-container-misi-desa" class="block mb-2 text-sm font-semibold text-gray-950">Misi Desa</label>
                <div wire:ignore>
                    <div id="editor-container-misi-desa" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                        {!! $misi_desa !!}
                    </div>
                    <input type="hidden" id="misi-desa-input" wire:model="misi_desa">
                </div>
                <div class="h-0.25">
                    @error('misi_desa')
                    <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                    @enderror
                </div>
            </div>


            <div class="input-component">
                <label for="editor-container-sejarah-desa" class="block mb-2 text-sm font-semibold text-gray-950">Sejarah Desa</label>
                <div wire:ignore>
                    <div id="editor-container-sejarah-desa" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                        {!! $sejarah_desa !!}
                    </div>
                    <input type="hidden" id="sejarah-desa-input" wire:model="sejarah_desa">
                </div>
                <div class="h-0.25">
                    @error('sejarah_desa')
                    <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="link_iframe_maps" class="block mb-2 text-sm font-medium text-semibold-950">Link Iframe Maps</label>
                <input type="text" id="link_iframe_maps" wire:model.live="link_iframe_maps" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_iframe_maps') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Link Iframe Maps " autocomplete="off" />
                <div class="h-0.25">
                    @error('link_iframe_maps') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between mt-6">
                <a href="/admin" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-2 focus:outline-none focus:ring-sky-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill for Profil
        const quillProfil = new Quill('#editor-container-profil-desa', {
            theme: 'snow'
            , placeholder: 'Masukkan Profil Desa Organisasi'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , ['link']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        // Set initial content for Profil
        quillProfil.root.innerHTML = document.querySelector('#profil-desa-input').value || '';

        // Update Livewire on content change for Profil
        quillProfil.on('text-change', function() {
            const content = quillProfil.root.innerHTML;
            document.querySelector('#profil-desa-input').value = content;
            @this.set('profil_desa', content);
        });

        // Initialize Quill for Visi
        const quillVisi = new Quill('#editor-container-visi-desa', {
            theme: 'snow'
            , placeholder: 'Masukkan Visi Desa'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , ['link']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        // Set initial content for Visi
        quillVisi.root.innerHTML = document.querySelector('#visi-desa-input').value || '';

        // Update Livewire on content change for Visi
        quillVisi.on('text-change', function() {
            const content = quillVisi.root.innerHTML;
            document.querySelector('#visi-desa-input').value = content;
            @this.set('visi_desa', content);
        });

        // Initialize Quill for Misi
        const quillMisi = new Quill('#editor-container-misi-desa', {
            theme: 'snow'
            , placeholder: 'Masukkan Misi Desa'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , ['link']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        // Set initial content for Misi
        quillMisi.root.innerHTML = document.querySelector('#misi-desa-input').value || '';

        // Update Livewire on content change for Misi
        quillMisi.on('text-change', function() {
            const content = quillMisi.root.innerHTML;
            document.querySelector('#misi-desa-input').value = content;
            @this.set('misi_desa', content);
        });

        // Initialize Quill for Sejarah
        const quillSejarah = new Quill('#editor-container-sejarah-desa', {
            theme: 'snow'
            , placeholder: 'Masukkan Sejarah Desa'
            , modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }]
                    , ['bold', 'italic', 'underline']
                    , ['link']
                    , [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                    , ['clean']
                ]
            }
        });

        // Set initial content for Misi
        quillSejarah.root.innerHTML = document.querySelector('#sejarah-desa-input').value || '';

        // Update Livewire on content change for Misi
        quillSejarah.on('text-change', function() {
            const content = quillSejarah.root.innerHTML;
            document.querySelector('#sejarah-desa-input').value = content;
            @this.set('sejarah_desa', content);
        });

        // Handle Livewire updates for both editors
        Livewire.hook('message.processed', (message, component) => {
            if (component.id === @this.__id) {

                // Update Profil editor if Livewire property changed
                const currentProfilDesaContent = quillProfil.root.innerHTML;
                const newProfilDesaContent = component.get('profil_desa');
                if (currentProfilDesaContent !== newProfilDesaContent) {
                    quillProfil.root.innerHTML = newProfilDesaContent;
                }

                // Update Visi editor if Livewire property changed
                const currentVisiDesaContent = quillVisi.root.innerHTML;
                const newVisiDesaContent = component.get('visi_desa');
                if (currentVisiDesaContent !== newVisiDesaContent) {
                    quillVisi.root.innerHTML = newVisiDesaContent;
                }

                // Update Misi editor if Livewire property changed
                const currentMisiDesaContent = quillMisi.root.innerHTML;
                const newMisiDesaContent = component.get('misi_desa');
                if (currentMisiDesaContent !== newMisiDesaContent) {
                    quillMisi.root.innerHTML = newMisiDesaContent;
                }

                // Update Sejarah editor if Livewire property changed
                const currentSejarahDesaContent = quillSejarah.root.innerHTML;
                const newSejarahDesaContent = component.get('profil_desa');
                if (currentSejarahDesaContent !== newSejarahDesaContent) {
                    quillSejarah.root.innerHTML = newSejarahDesaContent;
                }

            }
        });
    });

</script>
@endpush
