<div>
    <x-slot:judul>
        Edit APBDesa
    </x-slot:judul>

    <div class="bg-teal-700 mt-4 mb-1 mx-6 rounded-sm p-2">
        <h5 class="text-xl text-white font-semibold text-center">Formulir Edit APBDesa</h5>
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

        <!-- Add this below form -->
        @if($errors->has('update_error'))
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
                {{ $errors->first('update_error') }}
            </div>
        @endif

        <!-- Form -->
        <form wire:submit="update">
            {{-- Tab Content --}}
            <div class="py-4 px-5">
                <!-- APBDesa Content -->
                <div x-show="activeTab === 'apbdes'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="input-component">
                            <label for="tahun_anggaran" class="block mb-2 text-sm font-semibold text-gray-950">Tahun Anggaran</label>
                            <input type="number" id="tahun_anggaran" min="1901" max="2155" wire:model.live.live="tahun_anggaran" class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error('tahun_anggaran') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="Cth 2021.." autocomplete="off" />
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
                                <x-new-rupiah-input label="Dana Hasil Usaha" name="hasil_usaha" id="hasil_usaha" wire:model.live="hasil_usaha" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Aset" name="hasil_aset" id="hasil_aset" wire:model.live="hasil_aset" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Swadaya Partisipasi Gotong Royong" name="swadaya_partisipasi_gotong_royong" id="swadaya_partisipasi_gotong_royong" wire:model.live="swadaya_partisipasi_gotong_royong" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Desa" name="dana_desa" id="dana_desa" wire:model.live="dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bagian Pajak Daerah" name="bagian_pajak_daerah" id="bagian_pajak_daerah" wire:model.live="bagian_pajak_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Retribusi Daerah" name="retribusi_daerah" id="retribusi_daerah" wire:model.live="retribusi_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Alokasi Dana Desa" name="alokasi_dana_desa" id="alokasi_dana_desa" wire:model.live="alokasi_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Provinsi" name="bantuan_keuangan_provinsi" id="bantuan_keuangan_provinsi" wire:model.live="bantuan_keuangan_provinsi" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Kabupaten" name="bantuan_keuangan_kabupaten" id="bantuan_keuangan_kabupaten" wire:model.live="bantuan_keuangan_kabupaten" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penerimaan Kerja Sama" name="penerimaan_kerja_sama" id="penerimaan_kerja_sama" wire:model.live="penerimaan_kerja_sama" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Perusahaan Di Desa" name="bantuan_perusahaan_di_desa" id="bantuan_perusahaan_di_desa" wire:model.live="bantuan_perusahaan_di_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hibah Sumbangan Pihak Ketiga" name="hibah_sumbangan_pihak_ketiga" id="hibah_sumbangan_pihak_ketiga" wire:model.live="hibah_sumbangan_pihak_ketiga" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Koreksi Kesalahan Belanja" name="koreksi_kesalahan_belanja" id="koreksi_kesalahan_belanja" wire:model.live="koreksi_kesalahan_belanja" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bunga Bank Desa" name="bunga_bank_desa" id="bunga_bank_desa" wire:model.live="bunga_bank_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pendapatan Lain Sah Desa" name="pendapatan_lain_sah" id="pendapatan_lain_sah" wire:model.live="pendapatan_lain_sah" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Usaha" name="r_hasil_usaha" id="r_hasil_usaha" wire:model.live="r_hasil_usaha" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Aset" name="r_hasil_aset" id="r_hasil_aset" wire:model.live="r_hasil_aset" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Swadaya Partisipasi Gotong Royong" name="r_swadaya_partisipasi_gotong_royong" id="r_swadaya_partisipasi_gotong_royong" wire:model.live="r_swadaya_partisipasi_gotong_royong" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Desa" name="r_dana_desa" id="r_dana_desa" wire:model.live="r_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bagian Pajak Daerah" name="r_bagian_pajak_daerah" id="r_bagian_pajak_daerah" wire:model.live="r_bagian_pajak_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Retribusi Daerah" name="r_retribusi_daerah" id="r_retribusi_daerah" wire:model.live="r_retribusi_daerah" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Alokasi Dana Desa" name="r_alokasi_dana_desa" id="r_alokasi_dana_desa" wire:model.live="r_alokasi_dana_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Provinsi" name="r_bantuan_keuangan_provinsi" id="r_bantuan_keuangan_provinsi" wire:model.live="r_bantuan_keuangan_provinsi" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bantuan Keuangan Kabupaten" name="r_bantuan_keuangan_kabupaten" id="r_bantuan_keuangan_kabupaten" wire:model.live="r_bantuan_keuangan_kabupaten" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penerimaan Kerja Sama" name="r_penerimaan_kerja_sama" id="r_penerimaan_kerja_sama" wire:model.live="r_penerimaan_kerja_sama" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Perusahaan Di Desa" name="r_bantuan_perusahaan_di_desa" id="r_bantuan_perusahaan_di_desa" wire:model.live="r_bantuan_perusahaan_di_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hibah Sumbangan Pihak Ketiga" name="r_hibah_sumbangan_pihak_ketiga" id="r_hibah_sumbangan_pihak_ketiga" wire:model.live="r_hibah_sumbangan_pihak_ketiga" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Koreksi Kesalahan Belanja" name="r_koreksi_kesalahan_belanja" id="r_koreksi_kesalahan_belanja" wire:model.live="r_koreksi_kesalahan_belanja" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Bunga Bank Desa" name="r_bunga_bank_desa" id="r_bunga_bank_desa" wire:model.live="r_bunga_bank_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pendapatan Lain Sah Desa" name="r_pendapatan_lain_sah" id="r_pendapatan_lain_sah" wire:model.live="r_pendapatan_lain_sah" />
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
                                <x-new-rupiah-input label="Dana Penyelenggaraan Pemerintahan" name="penyelenggaraan_pemerintahan" id="penyelenggaraan_pemerintahan" wire:model.live="penyelenggaraan_pemerintahan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pelaksanaan Pembangunan" name="pelaksanaan_pembangunan" id="pelaksanaan_pembangunan" wire:model.live="pelaksanaan_pembangunan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembinaan Kemasyarakatan" name="pembinaan_kemasyarakatan" id="pembinaan_kemasyarakatan" wire:model.live="pembinaan_kemasyarakatan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pemberdayaan Masyarakat" name="pemberdayaan_masyarakat" id="pemberdayaan_masyarakat" wire:model.live="pemberdayaan_masyarakat" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penanggulangan Bencana Darurat Mendesak" name="penanggulangan_bencana_darurat_mendesak" id="penanggulangan_bencana_darurat_mendesak" wire:model.live="penanggulangan_bencana_darurat_mendesak" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Belanja Tak Terduga" name="belanja_tak_terduga" id="belanja_tak_terduga" wire:model.live="belanja_tak_terduga" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyelenggaraan Pemerintahan" name="r_penyelenggaraan_pemerintahan" id="r_penyelenggaraan_pemerintahan" wire:model.live="r_penyelenggaraan_pemerintahan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pelaksanaan Pembangunan" name="r_pelaksanaan_pembangunan" id="r_pelaksanaan_pembangunan" wire:model.live="r_pelaksanaan_pembangunan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembinaan Kemasyarakatan" name="r_pembinaan_kemasyarakatan" id="r_pembinaan_kemasyarakatan" wire:model.live="r_pembinaan_kemasyarakatan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pemberdayaan Masyarakat" name="r_pemberdayaan_masyarakat" id="r_pemberdayaan_masyarakat" wire:model.live="r_pemberdayaan_masyarakat" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penanggulangan Bencana Darurat Mendesak" name="r_penanggulangan_bencana_darurat_mendesak" id="r_penanggulangan_bencana_darurat_mendesak" wire:model.live="r_penanggulangan_bencana_darurat_mendesak" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Belanja Tak Terduga" name="r_belanja_tak_terduga" id="r_belanja_tak_terduga" wire:model.live="r_belanja_tak_terduga" />
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
                                <x-new-rupiah-input label="Dana Silpa Tahun Sebelumnya" name="silpa_tahun_sebelumnya" id="silpa_tahun_sebelumnya" wire:model.live="silpa_tahun_sebelumnya" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Penjualan Kekayaan Desa" name="hasil_penjualan_kekayaan_desa" id="hasil_penjualan_kekayaan_desa" wire:model.live="hasil_penjualan_kekayaan_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembentukan Dana Cadangan" name="pembentukan_dana_cadangan" id="pembentukan_dana_cadangan" wire:model.live="pembentukan_dana_cadangan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyertaan Modal" name="penyertaan_modal" id="penyertaan_modal" wire:model.live="penyertaan_modal" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-semibold text-center">Realisasi</h1>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Silpa Tahun Sebelumnya" name="r_silpa_tahun_sebelumnya" id="r_silpa_tahun_sebelumnya" wire:model.live="r_silpa_tahun_sebelumnya" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Hasil Penjualan Kekayaan Desa" name="r_hasil_penjualan_kekayaan_desa" id="r_hasil_penjualan_kekayaan_desa" wire:model.live="r_hasil_penjualan_kekayaan_desa" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Pembentukan Dana Cadangan" name="r_pembentukan_dana_cadangan" id="r_pembentukan_dana_cadangan" wire:model.live="r_pembentukan_dana_cadangan" />
                            </div>
                            <div class="input-component">
                                <x-new-rupiah-input label="Dana Penyertaan Modal" name="r_penyertaan_modal" id="r_penyertaan_modal" wire:model.live="r_penyertaan_modal" />
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('admin.apbdes') }}" class="text-white text-center bg-teal-700 hover:bg-teal-800 focus:ring-2 focus:outline-none focus:ring-teal-600 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 cursor-pointer">Kembali</a>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer">Edit APBDesa Desa</button>
                    </div>
            </div>
        </form>
    </div>

</div>
