<div>
    <x-slot:judul>
        Hapus Inventaris Desa
    </x-slot:judul>

    <div class="bg-sky-600 mt-4 mb-6 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Data Inventaris</h5>
    </div>

    <div class="px-8">
        <div class="border border-gray-400 rounded-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100 border-b border-gray-400">
                    <tr>
                        <th class="py-2 px-4 text-left font-semibold">Informasi</th>
                        <th class="py-2 px-4 text-left font-semibold">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Jenis Inventaris</td>
                        <td class="py-2 px-4">{{ $jenis_inventaris }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Jumlah Inventaris</td>
                        <td class="py-2 px-4">{{ $jumlah_baik + $jumlah_rusak }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-semibold">Tanggal Penerimaan</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($created_at)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="bg-sky-600 my-4 mx-6 rounded-sm p-2 ">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Penghapusan Inventaris Desa</h5>
    </div>

    <div class="mx-6 mt-8">
        <form wire:submit.prevent="hapus">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="input-component">
                    <div class="relative">
                        <label for="jumlah_dijual" class="block mb-2 text-sm font-semibold text-gray-950">Jumlah Inventaris Yang Dijual</label>
                        <input type="number" id="jumlah_dijual" wire:model.live="jumlah_dijual" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('jumlah_dijual') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('jumlah_dijual') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <div class="relative">
                        <label for="jumlah_disumbangkan" class="block mb-2 text-sm font-semibold text-gray-950">Jumlah Inventaris Yang Disumbangkan</label>
                        <input type="number" id="jumlah_disumbangkan" wire:model.live="jumlah_disumbangkan" class="bg-gray-50 pl-4 py-2 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('jumlah_disumbangkan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Jumlah" autocomplete="off" min="0" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-7 pt-7 text-slate-600 text-sm font-semibold select-none">pcs</span>
                    </div>
                    <div class="h-0.25">
                        @error('jumlah_disumbangkan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-950">Keterangan</label>
                    <textarea id="keterangan" wire:model.live="keterangan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full h-26 p-2.5 placeholder:text-slate-600 @error('keterangan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Keterangan Tambahan" autocomplete="off"></textarea>
                    <div class="h-0.25">
                        @error('keterangan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
                <div class="input-component">
                    <label for="tanggal_penghapusan" class="block mb-2 text-sm font-semibold text-gray-950">Tanggal Penghapusan Inventaris</label>
                    <input type="date" id="tanggal_penghapusan" wire:model.live="tanggal_penghapusan" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tanggal_penghapusan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-sky-500 focus:border-sky-500 @enderror" placeholder="Masukan Jenis Barang Tanah Kas Desa" autocomplete="off" />
                    <div class="h-0.25">
                        @error('tanggal_penghapusan') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('InventarisDesa') }}" class="text-white text-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-sky-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>
                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Hapus Inventaris Desa</button>
            </div>
        </form>
    </div>
</div>
