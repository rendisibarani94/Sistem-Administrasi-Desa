<div>
    <x-slot:judul>
        Organisasi Desa
    </x-slot:judul>

    <div class="bg-teal-700 my-4 mx-6 rounded-sm p-2">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah Organisasi Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="store">
            <div class="cointainer space-y-6">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="input-component">
                        <label for="nama_organisasi" class="block mb-2 text-sm font-semibold text-gray-950">Nama Organisasi Desa</label>
                        <input type="text" id="nama_organisasi" wire:model.live="nama_organisasi" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_organisasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Organisasi Desa " autocomplete="off" />
                        <div class="h-0.25">
                            @error('nama_organisasi') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="tanggal_berdiri" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Beridiri Organisasi</label>
                        <input type="date" id="tanggal_berdiri" wire:model.live.debounce.500ms="tanggal_berdiri" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 @error('tanggal_berdiri') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Tanggal Beridiri Organisasi" autocomplete="off" />
                        <div class="h-0.25">
                            @error('tanggal_berdiri') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="ketua" class="block mb-2 text-sm font-semibold text-gray-950">Nama Ketua Organisasi</label>
                        <input type="text" id="ketua" wire:model.live="ketua" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('ketua') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Ketua Organisasi " autocomplete="off" />
                        <div class="h-0.25">
                            @error('ketua') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="foto_ketua" class="block text-sm font-medium text-black mb-2 ">Foto Ketua Organisasi</label>
                        <!-- Show preview of new image if selected -->
                        @if($foto_ketua)
                        <div class="mb-4">
                            <img src="{{ $foto_ketua->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                        </div>
                        @endif
                        <!-- File Input -->
                        <input id="foto_ketua" wire:model="foto_ketua" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-blue-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('foto_ketua') border-red-500 @enderror" type="file">
                        {{-- Error Message --}}
                        <div class="h-0.25">
                            @error('foto_ketua')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-component">
                        <label for="sekretaris" class="block mb-2 text-sm font-semibold text-gray-950">Nama Sekretaris Organisasi</label>
                        <input type="text" id="sekretaris" wire:model.live="sekretaris" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('sekretaris') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama sekretaris Organisasi " autocomplete="off" />
                        <div class="h-0.25">
                            @error('sekretaris') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="foto_sekretaris" class="block text-sm font-medium text-black mb-2 ">Foto Ketua Organisasi</label>
                        <!-- Show preview of new image if selected -->
                        @if($foto_sekretaris)
                        <div class="mb-4">
                            <img src="{{ $foto_sekretaris->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                        </div>
                        @endif
                        <!-- File Input -->
                        <input id="foto_sekretaris" wire:model="foto_sekretaris" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-blue-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('foto_sekretaris') border-red-500 @enderror" type="file">
                        {{-- Error Message --}}
                        <div class="h-0.25">
                            @error('foto_sekretaris')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-component">
                        <label for="bendahara" class="block mb-2 text-sm font-semibold text-gray-950">Nama Bendahara Organisasi</label>
                        <input type="text" id="bendahara" wire:model.live="bendahara" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('bendahara') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Nama Bendahara Organisasi " autocomplete="off" />
                        <div class="h-0.25">
                            @error('bendahara') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="foto_bendahara" class="block text-sm font-medium text-black mb-2 ">Foto Bendahara Organisasi</label>
                        <!-- Show preview of new image if selected -->
                        @if($foto_bendahara)
                        <div class="mb-4">
                            <img src="{{ $foto_bendahara->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                        </div>
                        @endif
                        <!-- File Input -->
                        <input id="foto_bendahara" wire:model="foto_bendahara" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-blue-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('foto_bendahara') border-red-500 @enderror" type="file">
                        {{-- Error Message --}}
                        <div class="h-0.25">
                            @error('foto_bendahara')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-950">Alamat Organisasi Desa</label>
                        <input type="text" id="alamat" wire:model.live="alamat" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukan Alamat Organisasi Desa " autocomplete="off" />
                        <div class="h-0.25">
                            @error('alamat') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                    <div class="input-component">
                        <label for="logo_organisasi" class="block text-sm font-medium text-black mb-2 ">Foto Bendahara Organisasi</label>
                        <!-- Show preview of new image if selected -->
                        @if($logo_organisasi)
                        <div class="mb-4">
                            <img src="{{ $logo_organisasi->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                        </div>
                        @endif
                        <!-- File Input -->
                        <input id="logo_organisasi" wire:model="logo_organisasi" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-blue-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('logo_organisasi') border-red-500 @enderror" type="file">
                        {{-- Error Message --}}
                        <div class="h-0.25">
                            @error('logo_organisasi')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Visi Editor -->
                <div class="input-component">
                    <label for="editor-container-visi" class="block mb-2 text-sm font-semibold text-gray-950">Visi Organisasi</label>
                    <div wire:ignore>
                        <div id="editor-container-visi" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                            {!! $visi !!}
                        </div>
                        <input type="hidden" id="visi-input" wire:model="visi">
                    </div>
                    <div class="h-0.25">
                        @error('visi')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Misi Editor -->
                <div class="input-component">
                    <label for="editor-container-misi" class="block mb-2 text-sm font-semibold text-gray-950">Misi Organisasi</label>
                    <div wire:ignore>
                        <div id="editor-container-misi" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                            {!! $misi !!}
                        </div>
                        <input type="hidden" id="misi-input" wire:model="misi">
                    </div>
                    <div class="h-0.25">
                        @error('misi')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.organisasi') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-8z00 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah Organisasi Desa</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill for Visi
        const quillVisi = new Quill('#editor-container-visi', {
            theme: 'snow',
            placeholder: 'Masukkan Visi Organisasi',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Set initial content for Visi
        quillVisi.root.innerHTML = document.querySelector('#visi-input').value || '';

        // Update Livewire on content change for Visi
        quillVisi.on('text-change', function() {
            const content = quillVisi.root.innerHTML;
            document.querySelector('#visi-input').value = content;
            @this.set('visi', content);
        });

        // Initialize Quill for Misi
        const quillMisi = new Quill('#editor-container-misi', {
            theme: 'snow',
            placeholder: 'Masukkan Misi Organisasi',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Set initial content for Misi
        quillMisi.root.innerHTML = document.querySelector('#misi-input').value || '';

        // Update Livewire on content change for Misi
        quillMisi.on('text-change', function() {
            const content = quillMisi.root.innerHTML;
            document.querySelector('#misi-input').value = content;
            @this.set('misi', content);
        });

        // Handle Livewire updates for both editors
        Livewire.hook('message.processed', (message, component) => {
            if (component.id === @this.__id) {
                // Update Visi editor if Livewire property changed
                const currentVisiContent = quillVisi.root.innerHTML;
                const newVisiContent = component.get('visi');
                if (currentVisiContent !== newVisiContent) {
                    quillVisi.root.innerHTML = newVisiContent;
                }

                // Update Misi editor if Livewire property changed
                const currentMisiContent = quillMisi.root.innerHTML;
                const newMisiContent = component.get('misi');
                if (currentMisiContent !== newMisiContent) {
                    quillMisi.root.innerHTML = newMisiContent;
                }
            }
        });
    });
</script>
@endpush
