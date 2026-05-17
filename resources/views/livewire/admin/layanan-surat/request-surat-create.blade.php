<x-layouts.layouts>
    <x-slot:judul>
        Buat Request Surat
    </x-slot:judul>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="mx-4 mb-4 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div>
                <p class="font-medium mb-1">Validasi Gagal</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 pt-6 pb-4 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Buat Request Surat</h1>
                    <p class="text-sm text-gray-500 mt-1">Ajukan permintaan surat keterangan atau dokumen lainnya</p>
                </div>
                <a href="{{ route('admin.layanan-surat.request.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Form --}}
        <div class="px-6 py-6">
            <form action="{{ route('admin.layanan-surat.request.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Pilih Jenis Surat --}}
                <div>
                    <label for="id_jenis_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jenis Surat <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="id_jenis_surat"
                        name="id_jenis_surat"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 text-gray-700 @error('id_jenis_surat') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Pilih Jenis Surat --</option>
                        @foreach ($jenisSuratList as $jenis)
                            <option value="{{ $jenis->id_jenis_surat }}" {{ old('id_jenis_surat') == $jenis->id_jenis_surat ? 'selected' : '' }}>
                                {{ $jenis->nama_surat }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_jenis_surat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Informasi Penting</p>
                            <p class="text-sm text-blue-800 mt-1">Request surat akan diproses oleh admin dalam waktu 1-3 hari kerja. Anda akan menerima notifikasi ketika status berubah.</p>
                        </div>
                    </div>
                </div>

                {{-- Data Tambahan (Optional) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Data Tambahan (Opsional)</label>
                    <p class="text-xs text-gray-500 mb-3">Isi field berikut jika diperlukan untuk jenis surat yang dipilih</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                            <input 
                                type="text"
                                id="keperluan"
                                name="data_form[keperluan]"
                                value="{{ old('data_form.keperluan') }}"
                                placeholder="Cth: Lamaran kerja, Beasiswa, dll"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 text-gray-700"
                            >
                        </div>

                        <div>
                            <label for="instansi_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Instansi/Tempat Tujuan</label>
                            <input 
                                type="text"
                                id="instansi_tujuan"
                                name="data_form[instansi_tujuan]"
                                value="{{ old('data_form.instansi_tujuan') }}"
                                placeholder="Cth: PT ABC, Universitas XYZ"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 text-gray-700"
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                            <textarea 
                                id="keterangan"
                                name="data_form[keterangan]"
                                placeholder="Tambahkan keterangan jika diperlukan..."
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-sky-500 focus:ring-1 focus:ring-sky-500 text-gray-700"
                            >{{ old('data_form.keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.layanan-surat.request.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 active:bg-sky-800 px-4 py-2 text-sm font-medium text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Ajukan Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layouts>
