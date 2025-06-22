<div>
    <x-slot:judul>
        Tambah APBDesa
    </x-slot:judul>

    <div class="bg-teal-700 mt-4 mb-1 mx-6 rounded-sm p-2">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Tambah APBDesa</h5>
    </div>

    <div x-data="{ activeTab: 'apbdes' }" class="w-full mx-auto pt-2">
        <!-- Tab Navigation -->
        <div class="flex flex-wrap justify-evenly border-b border-gray-200">
            <button @click="activeTab = 'apbdes'" :class="{ 'border-teal-600 text-slate-950': activeTab === 'apbdes', 'border-transparent text-slate-950 hover:text-gray-600 hover:border-gray-400': activeTab !== 'apbdes' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                APBDesa
            </button>
            <button @click="activeTab = 'pendapatan_desa'" :class="{ 'border-teal-600 text-slate-950': activeTab === 'pendapatan_desa', 'border-transparent text-slate-950 hover:text-gray-600 hover:border-gray-300': activeTab !== 'pendapatan_desa' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                Pendapatan
            </button>
            <button @click="activeTab = 'belanja_desa'" :class="{ 'border-teal-600 text-slate-950': activeTab === 'belanja_desa', 'border-transparent text-slate-950 hover:text-gray-600 hover:border-gray-400': activeTab !== 'belanja_desa' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                Belanja Desa
            </button>
            <button @click="activeTab = 'pembiayaan_desa'" :class="{ 'border-teal-600 text-slate-950': activeTab === 'pembiayaan_desa', 'border-transparent text-slate-950 hover:text-gray-600 hover:border-gray-400': activeTab !== 'pembiayaan_desa' }" class="py-4 px-6 border-b-2 font-medium text-sm cursor-pointer">
                Pembiayaan
            </button>
        </div>

        <!-- Form -->
        <form wire:submit="store">
            {{-- Tab Content --}}
            <div class="py-4 px-5">
                <!-- APBDesa Content -->
                <div x-show="activeTab === 'apbdes'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="input-component">
                            <label for="tahun_anggaran" class="block mb-2 text-sm font-semibold text-gray-950">Tahun Anggaran</label>
                            <input type="number" id="tahun_anggaran" min="1901" max="2155" wire:model.live="tahun_anggaran" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tahun_anggaran') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Cth 2021.." autocomplete="off" />
                            <div class="h-0.25">
                                @error('tahun_anggaran') <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pendapatan Desa Content -->
                <div x-show="activeTab === 'pendapatan_desa'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Anggaran</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Usaha" name="hasil_usaha" wire:model="hasil_usaha" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Aset" name="hasil_aset" wire:model="hasil_aset" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Swadaya Partisipasi Gotong Royong" name="swadaya_partisipasi_gotong_royong" wire:model="swadaya_partisipasi_gotong_royong" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Desa" name="dana_desa" wire:model="dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bagian Pajak Daerah" name="bagian_pajak_daerah" wire:model="bagian_pajak_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Retribusi Daerah" name="retribusi_daerah" wire:model="retribusi_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Alokasi Dana Desa" name="alokasi_dana_desa" wire:model="alokasi_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Provinsi" name="bantuan_keuangan_provinsi" wire:model="bantuan_keuangan_provinsi" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Kabupaten" name="bantuan_keuangan_kabupaten" wire:model="bantuan_keuangan_kabupaten" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penerimaan Kerja Sama" name="penerimaan_kerja_sama" wire:model="penerimaan_kerja_sama" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Perusahaan Di Desa" name="bantuan_perusahaan_di_desa" wire:model="bantuan_perusahaan_di_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hibah Sumbangan Pihak Ketiga" name="hibah_sumbangan_pihak_ketiga" wire:model="hibah_sumbangan_pihak_ketiga" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Koreksi Kesalahan Belanja" name="koreksi_kesalahan_belanja" wire:model="koreksi_kesalahan_belanja" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bunga Bank Desa" name="bunga_bank_desa" wire:model="bunga_bank_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pendapatan Lain Sah Desa" name="pendapatan_lain_sah" wire:model="pendapatan_lain_sah" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Usaha" name="r_hasil_usaha" wire:model="r_hasil_usaha" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Aset" name="r_hasil_aset" wire:model="r_hasil_aset" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Swadaya Partisipasi Gotong Royong" name="r_swadaya_partisipasi_gotong_royong" wire:model="r_swadaya_partisipasi_gotong_royong" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Desa" name="r_dana_desa" wire:model="r_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bagian Pajak Daerah" name="r_bagian_pajak_daerah" wire:model="r_bagian_pajak_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Retribusi Daerah" name="r_retribusi_daerah" wire:model="r_retribusi_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Alokasi Dana Desa" name="r_alokasi_dana_desa" wire:model="r_alokasi_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Provinsi" name="r_bantuan_keuangan_provinsi" wire:model="r_bantuan_keuangan_provinsi" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Kabupaten" name="r_bantuan_keuangan_kabupaten" wire:model="r_bantuan_keuangan_kabupaten" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penerimaan Kerja Sama" name="r_penerimaan_kerja_sama" wire:model="r_penerimaan_kerja_sama" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Perusahaan Di Desa" name="r_bantuan_perusahaan_di_desa" wire:model="r_bantuan_perusahaan_di_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hibah Sumbangan Pihak Ketiga" name="r_hibah_sumbangan_pihak_ketiga" wire:model="r_hibah_sumbangan_pihak_ketiga" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Koreksi Kesalahan Belanja" name="r_koreksi_kesalahan_belanja" wire:model="r_koreksi_kesalahan_belanja" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bunga Bank Desa" name="r_bunga_bank_desa" wire:model="r_bunga_bank_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pendapatan Lain Sah Desa" name="r_pendapatan_lain_sah" wire:model="r_pendapatan_lain_sah" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2 Content -->
                <div x-show="activeTab === 'belanja_desa'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Anggaran</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyelenggaraan Pemerintahan" name="penyelenggaraan_pemerintahan" wire:model="penyelenggaraan_pemerintahan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pelaksanaan Pembangunan" name="pelaksanaan_pembangunan" wire:model="pelaksanaan_pembangunan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembinaan Kemasyarakatan" name="pembinaan_kemasyarakatan" wire:model="pembinaan_kemasyarakatan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pemberdayaan Masyarakat" name="pemberdayaan_masyarakat" wire:model="pemberdayaan_masyarakat" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penanggulangan Bencana Darurat Mendesak" name="penanggulangan_bencana_darurat_mendesak" wire:model="penanggulangan_bencana_darurat_mendesak" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Belanja Tak Terduga" name="belanja_tak_terduga" wire:model="belanja_tak_terduga" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyelenggaraan Pemerintahan" name="r_penyelenggaraan_pemerintahan" wire:model="r_penyelenggaraan_pemerintahan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pelaksanaan Pembangunan" name="r_pelaksanaan_pembangunan" wire:model="r_pelaksanaan_pembangunan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembinaan Kemasyarakatan" name="r_pembinaan_kemasyarakatan" wire:model="r_pembinaan_kemasyarakatan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pemberdayaan Masyarakat" name="r_pemberdayaan_masyarakat" wire:model="r_pemberdayaan_masyarakat" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penanggulangan Bencana Darurat Mendesak" name="r_penanggulangan_bencana_darurat_mendesak" wire:model="r_penanggulangan_bencana_darurat_mendesak" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Belanja Tak Terduga" name="r_belanja_tak_terduga" wire:model="r_belanja_tak_terduga" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3 Content -->
                <div x-show="activeTab === 'pembiayaan_desa'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Anggaran</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Silpa Tahun Sebelumnya" name="silpa_tahun_sebelumnya" wire:model="silpa_tahun_sebelumnya" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Penjualan Kekayaan Desa" name="hasil_penjualan_kekayaan_desa" wire:model="hasil_penjualan_kekayaan_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembentukan Dana Cadangan" name="pembentukan_dana_cadangan" wire:model="pembentukan_dana_cadangan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyertaan Modal" name="penyertaan_modal" wire:model="penyertaan_modal" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Silpa Tahun Sebelumnya" name="r_silpa_tahun_sebelumnya" wire:model="r_silpa_tahun_sebelumnya" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Penjualan Kekayaan Desa" name="r_hasil_penjualan_kekayaan_desa" wire:model="r_hasil_penjualan_kekayaan_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembentukan Dana Cadangan" name="r_pembentukan_dana_cadangan" wire:model="r_pembentukan_dana_cadangan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyertaan Modal" name="r_penyertaan_modal" wire:model="r_penyertaan_modal" />
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('admin.apbdes') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Tambah APBDesa Desa</button>
                    </div>
            </div>
        </form>
    </div>

</div>

