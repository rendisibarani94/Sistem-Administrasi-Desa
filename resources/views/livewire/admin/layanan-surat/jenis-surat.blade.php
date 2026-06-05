@php
    $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
    $activeKadesNama = $activeKades ? $activeKades->nama : 'Haposan Simanjuntak';
@endphp
<div>
    <x-slot:judul>
        Data Jenis Surat
    </x-slot:judul>

    {{-- Full Page Container --}}
    <div class="mx-4">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold mt-6 mb-6">Data Jenis Surat</h1>
        </div>

        <div class="flex justify-between mx-4">
            <nav class="flex " aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('beranda.admin') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-600 ">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            <span translate="no">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('admin.layanan-surat.request.index') }}" class="inline-flex items-center text-sm font-base text-black hover:text-sky-600 ">
                                Layanan Surat
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-semibold text-gray-500 md:ms-2">Jenis Surat</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <button wire:click="openCreateModal" class="cursor-pointer bg-sky-700 hover:bg-sky-800 text-white focus:ring-2 focus:outline-none focus:ring-sky-600 font-bold py-2 px-4 rounded flex items-center space-x-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Jenis Surat</span>
            </button>
        </div>

        {{-- Info Banner --}}
        <div class="my-4 flex items-start gap-3 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-blue-500 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
            </svg>
            <span>
                Jenis surat yang <strong>Aktif</strong> akan otomatis muncul di aplikasi mobile warga.
                Tambahkan <strong>field persyaratan</strong> agar warga dapat mengisi data yang diperlukan saat mengajukan surat.
            </span>
        </div>

        {{-- Create Button & Table Search Row --}}
        <div class="flex flex-wrap justify-between items-center border-2 border-gray-300 rounded-sm my-6 p-4 gap-4 sm:justify-end">
            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" wire:model.live.debounce.300ms="search" autocomplete="off" class="block w-full sm:w-72 p-3 ps-10 text-sm text-gray-900 border border-gray-400 rounded-lg bg-gray-50 focus:ring-sky-500 focus:border-sky-500" placeholder="Cari Jenis Surat..." required />
            </div>
        </div>

        {{-- Table Container --}}
        <div class="relative overflow-x-auto shadow-md mt-4 border-b-2 border-gray-300">
            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-16">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Nama Surat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-32">
                            Jumlah Field
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-32">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider border-b-3 border-gray-500 w-44">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($jenisSuratList as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- No --}}
                            <td class="px-5 py-4 text-gray-500 font-medium">
                                {{ $jenisSuratList->firstItem() + $index }}
                            </td>

                            {{-- Nama Surat --}}
                            <td class="px-5 py-4">
                                <span class="font-semibold text-gray-800">{{ $item->nama_surat }}</span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-5 py-4 text-gray-500 max-w-xs">
                                <span class="line-clamp-2">{{ $item->deskripsi ?? '-' }}</span>
                            </td>

                            {{-- Jumlah Field --}}
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center justify-center rounded-full bg-sky-100 text-sky-700 text-xs font-semibold px-2.5 py-0.5 min-w-[2rem]">
                                    {{ $item->persyaratan_surat_count }} field
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">
                                <button
                                    wire:click="toggleAktif({{ $item->id_jenis_surat }})"
                                    wire:loading.attr="disabled"
                                    title="{{ $item->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}"
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold transition-all
                                        {{ $item->is_active
                                            ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200'
                                            : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit --}}
                                    <button
                                        wire:click="openEditModal({{ $item->id_jenis_surat }})"
                                        class="inline-flex items-center gap-1 rounded-md border border-sky-200 bg-sky-50 px-2.5 py-1.5 text-xs font-medium text-sky-700 hover:bg-sky-100 transition-colors"
                                        title="Edit"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- Hapus --}}
                                    <button
                                        wire:click="confirmDelete({{ $item->id_jenis_surat }})"
                                        class="inline-flex items-center gap-1 rounded-md border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-medium text-red-600 hover:bg-red-100 transition-colors"
                                        title="Hapus"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada jenis surat</p>
                                    <p class="text-xs">Klik tombol "Tambah Jenis Surat" untuk memulai.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($jenisSuratList->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $jenisSuratList->links() }}
            </div>
        @endif
    </div>


    {{-- ══════════════════════════════════════════════════════════════
         MODAL: TAMBAH / EDIT JENIS SURAT
    ══════════════════════════════════════════════════════════════ --}}
    @if ($showModal)
    <div
        class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-black/50 px-4 py-8"
        x-data="{
            isDirty: false,
            confirmClose() {
                if (!this.isDirty) { $wire.closeModal(); return; }
                Swal.fire({
                    title: 'Apakah menyimpan perubahan?',
                    text: 'Ada perubahan yang belum disimpan. Apakah Anda ingin menyimpan sebelum menutup?',
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    denyButtonText: 'Tidak simpan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#0284c7',
                    denyButtonColor: '#6b7280',
                    cancelButtonColor: '#ef4444',
                }).then((result) => {
                    if (result.isConfirmed) { $wire.simpan(); }
                    else if (result.isDenied) { this.isDirty = false; $wire.closeModal(); }
                });
            },
            confirmSimpan() {
                Swal.fire({
                    title: 'Apakah anda sudah yakin?',
                    text: 'Pastikan semua data sudah benar sebelum menyimpan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Cek lagi',
                }).then((result) => {
                    if (result.isConfirmed) { $wire.simpan(); }
                });
            }
        }"
        @input="isDirty = true"
        @click.self="confirmClose()"
        x-on:keydown.escape.window="confirmClose()"
    >
        <div class="relative w-full max-w-7xl rounded-2xl bg-white shadow-xl">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">
                    {{ $editingId ? 'Edit Jenis Surat' : 'Tambah Jenis Surat Baru' }}
                </h2>
                <button type="button" @click="confirmClose()" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 max-h-[78vh] overflow-y-auto">

                {{-- Left Column (Form Inputs) --}}
                <div class="lg:col-span-7 space-y-5">

                {{-- Nama Surat --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Surat <span class="text-red-500">*</span>
                    </label>
                    <input
                        wire:model="nama_surat"
                        type="text"
                        placeholder="Contoh: Surat Keterangan Domisili"
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 @error('nama_surat') border-red-400 bg-red-50 @enderror"
                        @input="trackChange()"
                    />
                    @error('nama_surat')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        wire:model="deskripsi"
                        rows="2"
                        placeholder="Jelaskan kegunaan surat ini..."
                        class="w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 resize-none @error('deskripsi') border-red-400 bg-red-50 @enderror"
                    ></textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Template Isi Surat (Quill Editor) --}}
                <div class="space-y-3"
                     x-data="{
                         value: @entangle('body_template'),
                         quill: null,
                         insertTag(tag) {
                             if (!this.quill) return;
                             this.quill.focus();
                             const range = this.quill.getSelection();
                             if (range) {
                                 this.quill.insertText(range.index, tag);
                                 this.quill.setSelection(range.index + tag.length);
                             } else {
                                 const length = this.quill.getLength();
                                 this.quill.insertText(length - 1, tag);
                                 this.quill.setSelection(length - 1 + tag.length);
                             }
                             // Update the wire entangle value
                             this.value = this.quill.root.innerHTML;
                         }
                     }"
                >
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-semibold text-gray-700">
                            Template Isi Surat <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <button type="button" wire:click="loadDefaultTemplate" class="text-xs font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                            🔄 Gunakan Format Default
                        </button>
                    </div>

                    {{-- Tag Helper Section --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50/50 p-4 space-y-2.5">
                        <p class="text-xs text-blue-800 flex items-center gap-1.5 font-medium">
                            <span class="inline-flex items-center justify-center bg-blue-100 text-blue-700 rounded-full w-5 h-5 text-[10px]">💡</span>
                            <span>Tips: Klik tag di bawah ini untuk memasukkan data warga secara otomatis ke dalam surat.</span>
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" @click="insertTag('{nama}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-blue-200 text-xs font-semibold text-blue-700 hover:bg-blue-50 active:bg-blue-100 transition duration-150 shadow-sm cursor-pointer hover:border-blue-300">
                                <span>{nama}</span>
                                <span class="text-[10px] text-blue-400 font-normal">(Nama Pemohon)</span>
                            </button>
                            <button type="button" @click="insertTag('{nik}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-blue-200 text-xs font-semibold text-blue-700 hover:bg-blue-50 active:bg-blue-100 transition duration-150 shadow-sm cursor-pointer hover:border-blue-300">
                                <span>{nik}</span>
                                <span class="text-[10px] text-blue-400 font-normal">(NIK)</span>
                            </button>
                            <button type="button" @click="insertTag('{alamat}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-blue-200 text-xs font-semibold text-blue-700 hover:bg-blue-50 active:bg-blue-100 transition duration-150 shadow-sm cursor-pointer hover:border-blue-300">
                                <span>{alamat}</span>
                                <span class="text-[10px] text-blue-400 font-normal">(Alamat Warga)</span>
                            </button>
                            <button type="button" @click="insertTag('{keperluan}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-blue-200 text-xs font-semibold text-blue-700 hover:bg-blue-50 active:bg-blue-100 transition duration-150 shadow-sm cursor-pointer hover:border-blue-300">
                                <span>{keperluan}</span>
                                <span class="text-[10px] text-blue-400 font-normal">(Keperluan Surat)</span>
                            </button>
                            <button type="button" @click="insertTag('{nomor_surat}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-blue-200 text-xs font-semibold text-blue-700 hover:bg-blue-50 active:bg-blue-100 transition duration-150 shadow-sm cursor-pointer hover:border-blue-300">
                                <span>{nomor_surat}</span>
                                <span class="text-[10px] text-blue-400 font-normal">(Nomor Surat)</span>
                            </button>
                        </div>
                    </div>

                    {{-- WYSIWYG Quill Container --}}
                    <div wire:ignore 
                         class="bg-white rounded-lg border border-gray-300"
                         x-init="
                             quill = new Quill($refs.editor, {
                                 theme: 'snow',
                                 placeholder: 'Tulis template isi surat di sini...',
                                 modules: {
                                     toolbar: [
                                         [{ header: [1, 2, false] }],
                                         ['bold', 'italic', 'underline'],
                                         [{ list: 'ordered' }, { list: 'bullet' }],
                                         ['clean']
                                     ]
                                 }
                             });
                             
                             // Set initial content
                             quill.root.innerHTML = value || '';
                             
                             // Watch Quill changes -> update Livewire
                             quill.on('text-change', (delta, oldDelta, source) => {
                                 value = quill.root.innerHTML;
                                 if (source === 'user') {
                                     $el.dispatchEvent(new Event('input', { bubbles: true }));
                                 }
                             });
                             
                             // Watch Livewire changes -> update Quill (when editing modal is opened)
                             $watch('value', newVal => {
                                 if (quill.root.innerHTML !== newVal) {
                                     quill.root.innerHTML = newVal || '';
                                 }
                             });
                         "
                     >
                         <div x-ref="editor" style="height: 320px;" class="text-sm"></div>
                     </div>
                </div>

                {{-- Status Aktif --}}
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        wire:click="$set('is_active', !{{ $is_active ? 'true' : 'false' }})"
                        @click="isDirty = true"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none
                            {{ $is_active ? 'bg-sky-600' : 'bg-gray-200' }}"
                        role="switch"
                    >
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out
                            {{ $is_active ? 'translate-x-5' : 'translate-x-0' }}">
                        </span>
                    </button>
                    <span class="text-sm font-medium text-gray-700">
                        Tampilkan di aplikasi mobile
                        <span class="font-semibold {{ $is_active ? 'text-emerald-600' : 'text-gray-400' }}">
                            ({{ $is_active ? 'Aktif' : 'Nonaktif' }})
                        </span>
                    </span>
                </div>

                {{-- Divider --}}
                <hr class="border-gray-100" />

                {{-- Field Persyaratan --}}
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Field Persyaratan</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Data yang harus diisi warga saat mengajukan surat ini</p>
                        </div>
                        <button
                            type="button"
                            wire:click="tambahField"
                            @click="isDirty = true"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-dashed border-sky-400 bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-700 hover:bg-sky-100 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Field
                        </button>
                    </div>

                    @if (count($persyaratan) === 0)
                        <div class="rounded-xl border-2 border-dashed border-gray-200 py-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                            </svg>
                            <p class="text-xs text-gray-400 font-medium">Belum ada field persyaratan</p>
                            <p class="text-xs text-gray-300 mt-0.5">Klik "+ Tambah Field" untuk menambahkan</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($persyaratan as $idx => $field)
                                <div class="flex items-start gap-2 rounded-xl border border-gray-200 bg-gray-50 p-3">
                                    {{-- Nomor --}}
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-sky-100 text-xs font-bold text-sky-700 mt-0.5">
                                        {{ $idx + 1 }}
                                    </span>

                                    {{-- Inputs --}}
                                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-2">
                                        {{-- Nama Field --}}
                                        <div class="sm:col-span-2">
                                            <input
                                                wire:model="persyaratan.{{ $idx }}.nama_field"
                                                type="text"
                                                placeholder="Nama field (Contoh: NIK, Nama Lengkap)"
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-xs placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 @error('persyaratan.'.$idx.'.nama_field') border-red-400 @enderror"
                                            />
                                            @error('persyaratan.'.$idx.'.nama_field')
                                                <p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Tipe Field --}}
                                        <div>
                                            <select
                                                wire:model="persyaratan.{{ $idx }}.tipe_field"
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-xs focus:border-sky-500 focus:ring-1 focus:ring-sky-500"
                                            >
                                                @foreach ($tipeOptions as $val => $label)
                                                    <option value="{{ $val }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Wajib --}}
                                    <label class="flex items-center gap-1.5 shrink-0 cursor-pointer mt-1.5" title="Wajib diisi">
                                        <input
                                            type="checkbox"
                                            wire:model="persyaratan.{{ $idx }}.is_required"
                                            class="h-3.5 w-3.5 rounded border-gray-300 text-sky-600 focus:ring-sky-500"
                                        />
                                        <span class="text-xs text-gray-600 whitespace-nowrap">Wajib</span>
                                    </label>

                                    {{-- Hapus --}}
                                    <button
                                        type="button"
                                        wire:click="hapusField({{ $idx }})"
                                        @click="isDirty = true"
                                        class="shrink-0 rounded-lg p-1.5 text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors mt-0.5"
                                        title="Hapus field ini"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                </div> {{-- End Left Column --}}

                {{-- Right Column (Real-time Preview) --}}
                <div class="lg:col-span-5 bg-gray-50 rounded-2xl p-4 border border-gray-200 flex flex-col justify-between"
                     x-data="{
                         value: @entangle('body_template'),
                         nama_surat: @entangle('nama_surat'),
                         deskripsi: @entangle('deskripsi'),
                         parseTemplate(template) {
                             if (!template) {
                                 return `
                                     <p class='text-justify mb-2 leading-relaxed'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini, Kepala Desa Hutabulu Mejan, Kecamatan Balige, Kabupaten Toba menerangkan bahwa:</p>
                                     <div class='pl-4 my-2 text-[8px] leading-normal'>
                                         <table class='w-full text-left' style='border-collapse: collapse;'>
                                             <tr><td style='width: 30%; text-align: left; padding: 1px 0;'>Nama</td><td style='width: 5%; text-align: center; padding: 1px 0;'>:</td><td style='text-align: left; padding: 1px 0;'><strong>WARGA CONTOH</strong></td></tr>
                                             <tr><td style='text-align: left; padding: 1px 0;'>NIK</td><td style='text-align: center; padding: 1px 0;'>:</td><td style='text-align: left; padding: 1px 0;'>1234567890123456</td></tr>
                                             <tr><td style='text-align: left; padding: 1px 0;'>Alamat</td><td style='text-align: center; padding: 1px 0;'>:</td><td style='text-align: left; padding: 1px 0;'>Desa Hutabulu Mejan, Kecamatan Balige, Kabupaten Toba</td></tr>
                                         </table>
                                     </div>
                                     <p class='text-justify my-2 leading-relaxed'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama tersebut diatas adalah benar merupakan warga / penduduk yang berdomisili di wilayah Desa Hutabulu Mejan.</p>
                                     <p class='text-justify mt-2 leading-relaxed'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikianlah surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>
                                 `;
                             }
                             let parsed = template;
                             const placeholders = {
                                 '{nama}': '<strong>WARGA CONTOH</strong>',
                                 '{nik}': '1234567890123456',
                                 '{no_kk}': '1234567890123456',
                                 '{ttl}': 'Toba, 01 Januari 2000',
                                 '{jenis_kelamin}': 'Laki-laki',
                                 '{pekerjaan}': 'Wiraswasta',
                                 '{alamat}': 'Desa Hutabulu Mejan, Kec. Balige, Kab. Toba',
                                 '{keperluan}': 'Keperluan Administratif',
                                 '{nama_desa}': 'Hutabulu Mejan',
                                 '{kecamatan}': 'Balige',
                                 '{kabupaten}': 'Toba',
                                 '{penghasilan}': 'Rp. 3.000.000,-',
                                 '{nama_usaha}': 'Toko Klontong',
                                 '{nama_anak}': 'Anak Contoh',
                                 '{ttl_anak}': 'Toba, 01 Januari 2010',
                                 '{jenis_kelamin}': 'Laki-laki',
                             };
                             for (const [k, v] of Object.entries(placeholders)) {
                                 parsed = parsed.replaceAll(k, v);
                             }
                             return parsed;
                         }
                     }"
                >
                    <div>
                        <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-200">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-sky-500 animate-pulse"></span>
                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wider">Pratinjau Kertas Hasil PDF</h4>
                        </div>
                        
                        {{-- A4 Paper Sheet Preview --}}
                        <div class="mx-auto w-[290px] min-h-[410px] bg-white rounded-md border border-gray-300 p-4 shadow-md overflow-hidden flex flex-col justify-between font-serif text-[8px] text-black">
                            
                            {{-- Paper content --}}
                            <div>
                                {{-- Kop Surat --}}
                                <div class="flex items-center justify-between border-b-[1.5px] border-black pb-1 mb-2 gap-2">
                                    {{-- Logo Kabupaten Toba on the left --}}
                                    <img src="/images/logo_toba.svg" alt="Logo Kab Toba" class="w-7 h-9 object-contain shrink-0">
                                    
                                    {{-- Kop Text --}}
                                    <div class="flex-1 text-center leading-normal">
                                        <div class="text-[5px] uppercase font-sans font-bold">Pemerintah Kabupaten Toba</div>
                                        <div class="text-[5px] uppercase font-sans font-bold">Kecamatan Balige</div>
                                        <div class="text-[7px] uppercase font-sans font-extrabold">Desa Hutabulu Mejan</div>
                                        <div class="text-[4px] font-sans text-gray-600">Jl. Hutabulu Mejan, Kode Pos : 22312</div>
                                    </div>

                                    {{-- Logo Desa Hutabulu Mejan on the right --}}
                                    <div class="w-7 h-9 shrink-0"></div>
                                </div>

                                {{-- Judul & Nomor Surat --}}
                                <div class="text-center mb-3">
                                    <h5 class="text-[9px] font-extrabold uppercase underline tracking-wide" x-text="nama_surat ? nama_surat.toUpperCase() : 'SURAT KETERANGAN'"></h5>
                                    <div class="text-[7px] text-gray-700 mt-0.5">Nomor : 140 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / Desa / 2026</div>
                                </div>

                                {{-- Body Content (Parsed Template) --}}
                                <div class="space-y-2 leading-relaxed text-justify" x-html="parseTemplate(value)">
                                </div>
                            </div>

                            {{-- Tanda Tangan --}}
                            <div class="flex justify-end mt-4">
                                <div class="text-right w-28 text-[7px] leading-normal">
                                    <div class="mb-8">
                                        <div>Dikeluarkan di : Desa Hutabulu Mejan</div>
                                        <div>Pada Tanggal &nbsp;&nbsp;: 3 Juni 2026</div>
                                        <div class="mt-1 font-bold">KEPALA DESA HUTABULU MEJAN</div>
                                    </div>
                                    <div>
                                        <span class="font-bold underline uppercase">{{ strtoupper($activeKadesNama) }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> {{-- End Right Column --}}
            </div> {{-- End Grid Modal Body --}}

            {{-- Modal Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 px-6 py-4">
                <button
                    type="button"
                    @click="confirmClose()"
                    class="rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 hover:text-red-800 transition-colors"
                >
                    Batal
                </button>
                <button
                    type="button"
                    @click="confirmSimpan()"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-not-allowed"
                    class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 px-5 py-2 text-sm font-semibold text-white transition-colors shadow-sm"
                >
                    <span wire:loading.remove wire:target="simpan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    <span wire:loading wire:target="simpan">
                        <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                    {{ $editingId ? 'Simpan Perubahan' : 'Tambah Jenis Surat' }}
                </button>
            </div>
        </div>
    </div>
    @endif


    {{-- ══════════════════════════════════════════════════════════════
         SCRIPT: SweetAlert confirm delete listener
    ══════════════════════════════════════════════════════════════ --}}
    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:confirm', (params) => {
                const p = Array.isArray(params) ? params[0] : params;
                Swal.fire({
                    title: p.title,
                    text: p.text,
                    icon: p.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: p.confirmButtonText,
                    cancelButtonText: p.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.delete();
                    }
                });
            });
        });
    </script>
    @endpush
    </div>
</div>
