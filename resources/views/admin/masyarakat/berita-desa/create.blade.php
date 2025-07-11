<div>
    <x-slot:judul>
        Penduduk Sementara
    </x-slot:judul>

    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Berita Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <label for="gambar" class="block text-sm font-medium text-black mb-2 ">Gambar Berita Desa</label>
                    <!-- Show existing image if available -->
                    @if($existingGambarBerita)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $existingGambarBerita) }}" alt="Current landing page image" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif
                    <!-- Show preview of new image if selected -->
                    @if($gambar)
                    <div class="mb-4">
                        <img src="{{ $gambar->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif
                    <!-- File Input -->
                    <input id="gambar" wire:model="gambar" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-sky-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('gambar') border-red-500 @enderror" type="file">
                    {{-- Error Message --}}
                    <div class="h-0.25">
                        @error('gambar')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-component">
                    <label for="judul" class="block mb-2 text-sm font-semibold text-gray-950">Judul Berita Desa</label>
                    <input type="text" id="judul" wire:model.live="judul" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('judul') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Judul Berita Desa " autocomplete="off" />
                    <div class="h-0.25">
                        @error('judul') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="input-component">
                <label for="editor-container" class="block mb-2 text-sm font-semibold text-gray-950">Deskripsi Berita</label>
                <div wire:ignore>
                    <!-- Editor container -->
                    <div id="editor-container" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                        {!! $deskripsi !!}
                    </div>
                    <!-- Hidden input for Livewire binding -->
                    <input type="hidden" id="deskripsi-input" wire:model="deskripsi">
                </div>
                <div class="h-0.25">
                    @error('deskripsi')
                    <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.berita') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-2 focus:outline-none focus:ring-sky-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Berita Desa</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Masukan Deskripsi Berita',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Set initial content
        quill.root.innerHTML = document.querySelector('#deskripsi-input').value || '';

        // Update Livewire on content change
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            document.querySelector('#deskripsi-input').value = content;
            @this.set('deskripsi', content);
        });

        // Handle Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            if (component.id === @this.__id) {
                const currentContent = quill.root.innerHTML;
                const newContent = component.get('deskripsi');
                if (currentContent !== newContent) {
                    quill.root.innerHTML = newContent;
                }
            }
        });
    });
</script>
@endpush
