<div>
    <x-slot:judul>
        Data Settings
    </x-slot:judul>

    <div class="mx-auto py-8 px-4">

        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Data Settings</h1>

        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('beranda.admin') }}"
                        class="inline-flex items-center text-sm text-black hover:text-sky-700">
                        <svg class="w-3 h-3 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm font-semibold text-gray-500">
                            Settings
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form -->
        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">

            <!-- Informasi Umum -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-black mb-4">
                    Informasi Umum
                </h2>

                <div class="space-y-5">

                    <!-- Logo -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-black mb-2">
                            Logo Website
                        </label>

                        @if($existingLogo)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $existingLogo) }}"
                                    class="mx-auto w-40 h-40 object-contain border rounded">
                            </div>
                        @endif

                        @if($logo)
                            <div class="mb-4">
                                <p class="text-sm font-semibold text-center mb-2">
                                    Preview Logo Baru
                                </p>

                                <img src="{{ $logo->temporaryUrl() }}"
                                    class="mx-auto w-40 h-40 object-contain border rounded">
                            </div>
                        @endif

                        <input type="file"
                            id="logo"
                            wire:model="logo"
                            accept="image/*"
                            class="block w-full text-sm border border-gray-300 rounded file:bg-sky-700 file:text-white file:border-0 file:px-4 file:py-2">

                        @error('logo')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Desa -->
                    <div>
                        <label for="nama_desa"
                            class="block mb-2 text-sm font-semibold text-gray-900">
                            Nama Desa
                        </label>

                        <input type="text"
                            id="nama_desa"
                            wire:model.live="nama_desa"
                            placeholder="Masukkan Nama Desa"
                            class="w-full border rounded p-2.5 text-sm">

                        @error('nama_desa')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kabupaten -->
                    <div>
                        <label for="kabupaten"
                            class="block mb-2 text-sm font-semibold text-gray-900">
                            Kabupaten
                        </label>

                        <input type="text"
                            id="kabupaten"
                            wire:model.live="kabupaten"
                            placeholder="Masukkan Kabupaten (Contoh: KABUPATEN TOBA)"
                            class="w-full border rounded p-2.5 text-sm">

                        @error('kabupaten')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="kecamatan"
                            class="block mb-2 text-sm font-semibold text-gray-900">
                            Kecamatan
                        </label>

                        <input type="text"
                            id="kecamatan"
                            wire:model.live="kecamatan"
                            placeholder="Masukkan Kecamatan (Contoh: KECAMATAN BALIGE)"
                            class="w-full border rounded p-2.5 text-sm">

                        @error('kecamatan')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat Desa -->
                    <div>
                        <label for="alamat_desa"
                            class="block mb-2 text-sm font-semibold text-gray-900">
                            Alamat & Detail Kontak Desa (Kop Surat)
                        </label>

                        <input type="text"
                            id="alamat_desa"
                            wire:model.live="alamat_desa"
                            placeholder="Masukkan Alamat, Kode Pos, Website"
                            class="w-full border rounded p-2.5 text-sm">

                        @error('alamat_desa')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi Footer -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900">
                            Deskripsi Footer
                        </label>

                        <div wire:ignore>
                            <div id="editor-container"
                                class="bg-white border rounded"
                                style="height: 220px;"></div>

                            <input type="hidden"
                                id="deskripsi-input"
                                wire:model="deskripsi_footer">
                        </div>

                        @error('deskripsi_footer')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Sosial Media -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-black mb-4">
                    Informasi Sosial Media
                </h2>

                <div class="grid md:grid-cols-2 gap-4">

                    @foreach([
                        'link_fb' => 'Facebook',
                        'link_ig' => 'Instagram',
                        'link_twt' => 'Twitter',
                        'link_wa' => 'WhatsApp',
                        'link_yt' => 'YouTube'
                    ] as $field => $label)

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900">
                                {{ $label }}
                            </label>

                            <input type="text"
                                wire:model.live="{{ $field }}"
                                placeholder="https://"
                                class="w-full border rounded p-2.5 text-sm">

                            @error($field)
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                    @endforeach

                </div>
            </div>

            <!-- Kontak -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-black mb-4">
                    Informasi Kontak
                </h2>

                <div class="space-y-4">

                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            Nomor HP
                        </label>

                        <input type="text"
                            wire:model.live="nomor_hp"
                            placeholder="+62..."
                            class="w-full border rounded p-2.5 text-sm">

                        @error('nomor_hp')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            Email
                        </label>

                        <input type="email"
                            wire:model.live="email"
                            placeholder="contact@desa.id"
                            class="w-full border rounded p-2.5 text-sm">

                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-between">
                <a href="/admin"
                    class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-sky-700 text-white px-6 py-2 rounded hover:bg-sky-800">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:init', function () {

    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Masukkan Deskripsi Footer',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
            ]
        }
    });

    const hiddenInput = document.getElementById('deskripsi-input');

    // set isi awal
    quill.root.innerHTML = hiddenInput.value || '';

    // update livewire
    quill.on('text-change', function () {
        let html = quill.root.innerHTML;
        hiddenInput.value = html;
        @this.set('deskripsi_footer', html, false);
    });

    // refresh jika component rerender
    Livewire.hook('morph.updated', ({ el, component }) => {
        if (component.id === @this.__instance.id) {
            let content = hiddenInput.value;
            if (quill.root.innerHTML !== content) {
                quill.root.innerHTML = content;
            }
        }
    });

});
</script>
@endpush