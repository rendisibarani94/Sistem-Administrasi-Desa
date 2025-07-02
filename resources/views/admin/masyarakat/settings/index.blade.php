<div>
    <x-slot:judul>
        Data Settings
    </x-slot:judul>

    <div class="mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Data Settings</h1>

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
                        <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Settings</span>
                    </div>
                </li>
            </ol>
        </nav>

        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
            <!-- Site Identity Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-8">
                <h2 class="text-lg font-semibold text-black mb-4">Informasi Umum</h2>
                <div class="space-y-4">
                    <label for="logo" class="block text-sm font-medium text-black">Logo Website</label>

                    <!-- Show existing image if available -->
                    @if($existingLogo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $existingLogo) }}" alt="Current landing page image" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif

                    <!-- Show preview of new image if selected -->
                    @if($logo)
                    <div class="mb-4">
                        <p class="text-sm text-black font-semibold text-center mb-4">Preview logo terbaru</p>
                        <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="mx-auto w-96 h-auto object-cover border border-gray-300">
                    </div>
                    @endif

                    <!-- File Input -->
                    <input id="logo" wire:model="logo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 focus:outline-none file:cursor-pointer file:bg-blue-600 file:border-0 file:me-4 file:py-2 file:px-4 file:text-sm file:text-white file:font-semibold @error('logo') border-red-500 @enderror" type="file">
                    <div class="h-0.25">
                        @error('logo')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>

                    <div class="h-0.25">
                        @error('gambar_landing_page')
                        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Desa -->
                    <div>
                        <label for="nama_desa" class="block mb-2 text-sm font-semibold text-gray-950">Nama Desa</label>
                        <input type="text" id="nama_desa" wire:model.live="nama_desa" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nama_desa') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Masukkan Nama Desa" autocomplete="off" />
                        <div class="h-0.25">
                            @error('nama_desa') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <div class="input-component">
                        <label for="editor-container" class="block mb-2 text-sm font-semibold text-gray-950">Deskripsi Footer</label>
                        <div wire:ignore>
                            <!-- Editor container -->
                            <div id="editor-container" style="height: 200px;" class="bg-white border border-gray-300 rounded-sm">
                                {!! $deskripsi_footer !!}
                            </div>
                            <!-- Hidden input for Livewire binding -->
                            <input type="hidden" id="deskripsi-input" wire:model="deskripsi_footer">
                        </div>
                        <div class="h-0.25">
                            @error('deskripsi_footer')
                            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <!-- Social Media Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-lg font-semibold text-black my-4">Informasi Sosial Media</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Facebook -->
                    <div>
                        <label for="link_fb" class="block mb-2 text-sm font-semibold text-gray-950">Facebook</label>
                        <input type="text" id="link_fb" wire:model.live="link_fb" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_fb') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="https://facebook.com/..." autocomplete="off" />
                        <div class="h-0.25">
                            @error('link_fb') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label for="link_ig" class="block mb-2 text-sm font-semibold text-gray-950">Instagram</label>
                        <input type="text" id="link_ig" wire:model.live="link_ig" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_ig') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="https://instagram.com/..." autocomplete="off" />
                        <div class="h-0.25">
                            @error('link_ig') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="link_twt" class="block mb-2 text-sm font-semibold text-gray-950">Twitter</label>
                        <input type="text" id="link_twt" wire:model.live="link_twt" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_twt') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="https://twitter.com/..." autocomplete="off" />
                        <div class="h-0.25">
                            @error('link_twt') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="link_wa" class="block mb-2 text-sm font-semibold text-gray-950">WhatsApp</label>
                        <input type="text" id="link_wa" wire:model.live="link_wa" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_wa') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="https://wa.me/..." autocomplete="off" />
                        <div class="h-0.25">
                            @error('link_wa') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- YouTube -->
                    <div>
                        <label for="link_yt" class="block mb-2 text-sm font-semibold text-gray-950">YouTube</label>
                        <input type="text" id="link_yt" wire:model.live="link_yt" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('link_yt') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="https://youtube.com/..." autocomplete="off" />
                        <div class="h-0.25">
                            @error('link_yt') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-lg font-semibold text-black mb-4">Informasi Kontak</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Phone -->
                    <div>
                        <label for="nomor_telp" class="block mb-2 text-sm font-semibold text-gray-950">Nomor Telepon</label>
                        <input type="text" id="nomor_telp" wire:model.live="nomor_telp" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nomor_telp') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="+62 ... .... ...." autocomplete="off" />
                        <div class="h-0.25">
                            @error('nomor_telp') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Mobile -->
                    <div>
                        <label for="nomor_hp" class="block mb-2 text-sm font-semibold text-gray-950">Nomor HP</label>
                        <input type="text" id="nomor_hp" wire:model.live="nomor_hp" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('nomor_hp') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="+62 ... .... ...." autocomplete="off" />
                        <div class="h-0.25">
                            @error('nomor_hp') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-span-full">
                        <label for="email" class="block mb-2 text-sm font-semibold text-gray-950">Email</label>
                        <input type="text" id="email" wire:model.live="email" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="contact@desa.id" autocomplete="off" />
                        <div class="h-0.25">
                            @error('email') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between gap-3">
                <a href="/admin" class="bg-gray-200 text-black px-4 py-2 rounded-md hover:bg-gray-300">Back</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Masukan Deskripsi Footer',
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
            @this.set('deskripsi_footer', content);
        });

        // Handle Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            if (component.id === @this.__id) {
                const currentContent = quill.root.innerHTML;
                const newContent = component.get('deskripsi_footer');
                if (currentContent !== newContent) {
                    quill.root.innerHTML = newContent;
                }
            }
        });
    });
</script>
@endpush
