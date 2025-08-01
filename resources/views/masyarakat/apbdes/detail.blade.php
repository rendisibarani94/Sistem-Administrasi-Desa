<x-slot:judul>
    Detail APBDes
</x-slot:judul>

<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 py-10 px-5">
        <!-- Main Berita -->
        <section class="berita md:col-span-3 p-5 rounded-lg mx-5">
            <div class="header-section mb-10">
                <h3 class="text-sky-700 font-extrabold text-2xl md:text-3xl mb-4 border-b-2 pb-2 border-gray-500">
                    Grafik Laporan Kuangan Tahun {{ $apbdes->tahun_anggaran }}
                </h3>

            <div class="flex space-x-4">
                <div class="date flex space-x-2 w-full md:w-auto">
                    <svg class="w-5 h-5 text-sky-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                    </svg>
                    <p class="text-sm md:text-sm font-semibold text-sky-900">{{ \Carbon\Carbon::parse($apbdes->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                </div>
                <div class="flex items-center space-x-2 text-gray-600 mb-4">
                    <svg class="w-6 h-6 text-sky-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm md:text-sm font-semibold text-sky-900w">{{$apbdes->nama_pembuat}}</span>
                </div>
            </div>
            </div>

            <div class="apbdes-pelaksanaan mb-8">
                <div class="header-apbdes-pelaksanaan mb-2">
                    <h1 class="text-lg font-semibold text-center text-sky-700">APBDes {{ $apbdes->tahun_anggaran }} Pelaksanaan</h1>
                    <h1 class="text-lg font-bold text-center text-sky-700">Realisasi | Anggaran</h1>
                </div>
                <div class="content-apbdes-pelaksanaan space-y-2">
                    <div class="pendapatan_desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pendapatan Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->realisasiPendapatan) | @rupiah($apbdes->anggaranPendapatan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->anggaranPendapatan > 0 ? ($apbdes->realisasiPendapatan / $apbdes->anggaranPendapatan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->anggaranPendapatan > 0 ? ($apbdes->realisasiPendapatan / $apbdes->anggaranPendapatan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="belanja_desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Belanja Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->realisasiBelanja) | @rupiah($apbdes->anggaranBelanja)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->anggaranBelanja > 0 ? ($apbdes->realisasiBelanja / $apbdes->anggaranBelanja) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->anggaranBelanja > 0 ? ($apbdes->realisasiBelanja / $apbdes->anggaranBelanja) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pembiayaan_desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pembiayaan Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->realisasiPembiayaan) | @rupiah($apbdes->anggaranPembiayaan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->anggaranPembiayaan > 0 ? ($apbdes->realisasiPembiayaan / $apbdes->anggaranPembiayaan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->anggaranPembiayaan > 0 ? ($apbdes->realisasiPembiayaan / $apbdes->anggaranPembiayaan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="apbdes-pendapatan mb-4">
                <div class="header-apbdes-pendapatan mb-2">
                    <h1 class="text-lg font-semibold text-center text-sky-700">APBDes {{ $apbdes->tahun_anggaran }} Pendapatan</h1>
                    <h1 class="text-lg font-bold text-center text-sky-700">Realisasi | Anggaran</h1>
                </div>
                <div class="content-apbdes-pendapatan space-y-2">
                    <div class="hasil-usaha space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Hasil Usaha Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_hasil_usaha) | @rupiah($apbdes->hasil_usaha)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->hasil_usaha > 0 ? ($apbdes->r_hasil_usaha / $apbdes->hasil_usaha) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->hasil_usaha > 0 ? ($apbdes->r_hasil_usaha / $apbdes->hasil_usaha) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="hasil-aset space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Hasil Aset Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_hasil_aset) | @rupiah($apbdes->hasil_aset)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->hasil_aset > 0 ? ($apbdes->r_hasil_aset / $apbdes->hasil_aset) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->hasil_aset > 0 ? ($apbdes->r_hasil_aset / $apbdes->hasil_aset) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="swadaya-partisipasi-gotong-royong space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Hasil Swadaya Partisipasi Gotong Royong Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_swadaya_partisipasi_gotong_royong) | @rupiah($apbdes->swadaya_partisipasi_gotong_royong)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->swadaya_partisipasi_gotong_royong > 0 ? ($apbdes->r_swadaya_partisipasi_gotong_royong / $apbdes->swadaya_partisipasi_gotong_royong) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->swadaya_partisipasi_gotong_royong > 0 ? ($apbdes->r_swadaya_partisipasi_gotong_royong / $apbdes->swadaya_partisipasi_gotong_royong) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pendapatan-asli-lain space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pendapatan Asli Lain Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pendapatan_asli_lain) | @rupiah($apbdes->pendapatan_asli_lain)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pendapatan_asli_lain > 0 ? ($apbdes->r_pendapatan_asli_lain / $apbdes->pendapatan_asli_lain) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pendapatan_asli_lain > 0 ? ($apbdes->r_pendapatan_asli_lain / $apbdes->pendapatan_asli_lain) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="dana-desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Dana Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_dana_desa) | @rupiah($apbdes->dana_desa)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->dana_desa > 0 ? ($apbdes->r_dana_desa / $apbdes->dana_desa) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->dana_desa > 0 ? ($apbdes->r_dana_desa / $apbdes->dana_desa) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="bagian-pajak-daerah space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Bagian Pajak Daerah</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_bagian_pajak_daerah) | @rupiah($apbdes->bagian_pajak_daerah)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->bagian_pajak_daerah > 0 ? ($apbdes->r_bagian_pajak_daerah / $apbdes->bagian_pajak_daerah) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->bagian_pajak_daerah > 0 ? ($apbdes->r_bagian_pajak_daerah / $apbdes->bagian_pajak_daerah) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="retribusi-daerah space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Retribusi Daerah</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_retribusi_daerah) | @rupiah($apbdes->retribusi_daerah)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->retribusi_daerah > 0 ? ($apbdes->r_retribusi_daerah / $apbdes->retribusi_daerah) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->retribusi_daerah > 0 ? ($apbdes->r_retribusi_daerah / $apbdes->retribusi_daerah) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="alokasi-dana-desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Alokasi Dana Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_alokasi_dana_desa) | @rupiah($apbdes->alokasi_dana_desa)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->alokasi_dana_desa > 0 ? ($apbdes->r_alokasi_dana_desa / $apbdes->alokasi_dana_desa) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->alokasi_dana_desa > 0 ? ($apbdes->r_alokasi_dana_desa / $apbdes->alokasi_dana_desa) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="bantuan-keuangan-provinsi space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Bantuan Keuangan Provinsi</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_bantuan_keuangan_provinsi) | @rupiah($apbdes->bantuan_keuangan_provinsi)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->bantuan_keuangan_provinsi > 0 ? ($apbdes->r_bantuan_keuangan_provinsi / $apbdes->bantuan_keuangan_provinsi) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->bantuan_keuangan_provinsi > 0 ? ($apbdes->r_bantuan_keuangan_provinsi / $apbdes->bantuan_keuangan_provinsi) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="bantuan-keuangan-kabupaten space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Bantuan Keuangan Kabupaten</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_bantuan_keuangan_kabupaten) | @rupiah($apbdes->bantuan_keuangan_kabupaten)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->bantuan_keuangan_kabupaten > 0 ? ($apbdes->r_bantuan_keuangan_kabupaten / $apbdes->bantuan_keuangan_kabupaten) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->bantuan_keuangan_kabupaten > 0 ? ($apbdes->r_bantuan_keuangan_kabupaten / $apbdes->bantuan_keuangan_kabupaten) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="penerimaan-kerja-sama space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Penerimaan Kerja Sama</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_penerimaan_kerja_sama) | @rupiah($apbdes->penerimaan_kerja_sama)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->penerimaan_kerja_sama > 0 ? ($apbdes->r_penerimaan_kerja_sama / $apbdes->penerimaan_kerja_sama) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->penerimaan_kerja_sama > 0 ? ($apbdes->r_penerimaan_kerja_sama / $apbdes->penerimaan_kerja_sama) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="bantuan-perusahaan-di-desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Bantuan Perusahaan Di Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_bantuan_perusahaan_di_desa) | @rupiah($apbdes->bantuan_perusahaan_di_desa)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->bantuan_perusahaan_di_desa > 0 ? ($apbdes->r_bantuan_perusahaan_di_desa / $apbdes->bantuan_perusahaan_di_desa) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->bantuan_perusahaan_di_desa > 0 ? ($apbdes->r_bantuan_perusahaan_di_desa / $apbdes->bantuan_perusahaan_di_desa) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="hibah-sumbangan-pihak-ketiga space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Hibah Sumbangan Pihak Ketiga</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_hibah_sumbangan_pihak_ketiga) | @rupiah($apbdes->hibah_sumbangan_pihak_ketiga)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->hibah_sumbangan_pihak_ketiga > 0 ? ($apbdes->r_hibah_sumbangan_pihak_ketiga / $apbdes->hibah_sumbangan_pihak_ketiga) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->hibah_sumbangan_pihak_ketiga > 0 ? ($apbdes->r_hibah_sumbangan_pihak_ketiga / $apbdes->hibah_sumbangan_pihak_ketiga) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="koreksi-kesalahan-belanja space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Koreksi Kesalahan belanja</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_koreksi_kesalahan_belanja) | @rupiah($apbdes->koreksi_kesalahan_belanja)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->koreksi_kesalahan_belanja > 0 ? ($apbdes->r_koreksi_kesalahan_belanja / $apbdes->koreksi_kesalahan_belanja) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->koreksi_kesalahan_belanja > 0 ? ($apbdes->r_koreksi_kesalahan_belanja / $apbdes->koreksi_kesalahan_belanja) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="bunga-bank-desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Bunga Bank Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_bunga_bank_desa) | @rupiah($apbdes->bunga_bank_desa)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->bunga_bank_desa > 0 ? ($apbdes->r_bunga_bank_desa / $apbdes->bunga_bank_desa) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->bunga_bank_desa > 0 ? ($apbdes->r_bunga_bank_desa / $apbdes->bunga_bank_desa) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pendapatan-lain-sah space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pendapatan Lain Sah Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pendapatan_lain_sah) | @rupiah($apbdes->pendapatan_lain_sah)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pendapatan_lain_sah > 0 ? ($apbdes->r_pendapatan_lain_sah / $apbdes->pendapatan_lain_sah) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pendapatan_lain_sah > 0 ? ($apbdes->r_pendapatan_lain_sah / $apbdes->pendapatan_lain_sah) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="apbdes-belanja mb-4">
                <div class="header-apbdes-belanja mb-2">
                    <h1 class="text-lg font-semibold text-center text-sky-700">APBDes {{ $apbdes->tahun_anggaran }} Belanja</h1>
                    <h1 class="text-lg font-bold text-center text-sky-700">Realisasi | Anggaran</h1>
                </div>
                <div class="content-apbdes-belanja space-y-2">
                    <div class="penyelenggaraan-pemerintahan space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Penyelenggaraan Pemerintahan</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_penyelenggaraan_pemerintahan) | @rupiah($apbdes->penyelenggaraan_pemerintahan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->penyelenggaraan_pemerintahan > 0 ? ($apbdes->r_penyelenggaraan_pemerintahan / $apbdes->penyelenggaraan_pemerintahan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->penyelenggaraan_pemerintahan > 0 ? ($apbdes->r_penyelenggaraan_pemerintahan / $apbdes->penyelenggaraan_pemerintahan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pelaksanaan-pembangunan space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pelaksanaan Pembangunan</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pelaksanaan_pembangunan) | @rupiah($apbdes->pelaksanaan_pembangunan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pelaksanaan_pembangunan > 0 ? ($apbdes->r_pelaksanaan_pembangunan / $apbdes->pelaksanaan_pembangunan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pelaksanaan_pembangunan > 0 ? ($apbdes->r_pelaksanaan_pembangunan / $apbdes->pelaksanaan_pembangunan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pembinaan-kemasyarakatan space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pembinaan Kemasyarakatan</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pembinaan_kemasyarakatan) | @rupiah($apbdes->pembinaan_kemasyarakatan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pembinaan_kemasyarakatan > 0 ? ($apbdes->r_pembinaan_kemasyarakatan / $apbdes->pembinaan_kemasyarakatan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pembinaan_kemasyarakatan > 0 ? ($apbdes->r_pembinaan_kemasyarakatan / $apbdes->pembinaan_kemasyarakatan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pemberdayaan-masyarakat space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pemberdayaan Masyarakat</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pemberdayaan_masyarakat) | @rupiah($apbdes->pemberdayaan_masyarakat)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pemberdayaan_masyarakat > 0 ? ($apbdes->r_pemberdayaan_masyarakat / $apbdes->pemberdayaan_masyarakat) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pemberdayaan_masyarakat > 0 ? ($apbdes->r_pemberdayaan_masyarakat / $apbdes->pemberdayaan_masyarakat) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="penanggulangan-bencana-darurat-mendesak space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Penanggulangan Bencana Darurat Mendesak</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_penanggulangan_bencana_darurat_mendesak) | @rupiah($apbdes->penanggulangan_bencana_darurat_mendesak)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->penanggulangan_bencana_darurat_mendesak > 0 ? ($apbdes->r_penanggulangan_bencana_darurat_mendesak / $apbdes->penanggulangan_bencana_darurat_mendesak) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->penanggulangan_bencana_darurat_mendesak > 0 ? ($apbdes->r_penanggulangan_bencana_darurat_mendesak / $apbdes->penanggulangan_bencana_darurat_mendesak) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="belanja-tak-terduga space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Belanja Tak Terduga</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_belanja_tak_terduga) | @rupiah($apbdes->belanja_tak_terduga)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->belanja_tak_terduga > 0 ? ($apbdes->r_belanja_tak_terduga / $apbdes->belanja_tak_terduga) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->belanja_tak_terduga > 0 ? ($apbdes->r_belanja_tak_terduga / $apbdes->belanja_tak_terduga) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="apbdes-pembiayaan mb-4">
                <div class="header-apbdes-pembiayaan mb-2">
                    <h1 class="text-lg font-semibold text-center text-sky-700">APBDes {{ $apbdes->tahun_anggaran }} Pembiayaan</h1>
                    <h1 class="text-lg font-bold text-center text-sky-700">Realisasi | Anggaran</h1>
                </div>
                <div class="content-apbdes-pembiayaan space-y-2">
                    <div class="silpa-tahun-sebelumnya space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Silpa Tahun Sebelumnya</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_silpa_tahun_sebelumnya) | @rupiah($apbdes->silpa_tahun_sebelumnya)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->silpa_tahun_sebelumnya > 0 ? ($apbdes->r_silpa_tahun_sebelumnya / $apbdes->silpa_tahun_sebelumnya) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->silpa_tahun_sebelumnya > 0 ? ($apbdes->r_silpa_tahun_sebelumnya / $apbdes->silpa_tahun_sebelumnya) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pencairan-dana-cadangan space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pencairan Dana Cadangan</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pencairan_dana_cadangan) | @rupiah($apbdes->pencairan_dana_cadangan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pencairan_dana_cadangan > 0 ? ($apbdes->r_pencairan_dana_cadangan / $apbdes->pencairan_dana_cadangan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pencairan_dana_cadangan > 0 ? ($apbdes->r_pencairan_dana_cadangan / $apbdes->pencairan_dana_cadangan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="hasil-penjualan-kekayaan-desa space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Hasil Penjualan Kekayaan Desa</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_hasil_penjualan_kekayaan_desa) | @rupiah($apbdes->hasil_penjualan_kekayaan_desa)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->hasil_penjualan_kekayaan_desa > 0 ? ($apbdes->r_hasil_penjualan_kekayaan_desa / $apbdes->hasil_penjualan_kekayaan_desa) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->hasil_penjualan_kekayaan_desa > 0 ? ($apbdes->r_hasil_penjualan_kekayaan_desa / $apbdes->hasil_penjualan_kekayaan_desa) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="pembentukan-dana-cadangan space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Pembentukan Dana Cadangan</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_pembentukan_dana_cadangan) | @rupiah($apbdes->pembentukan_dana_cadangan)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->pembentukan_dana_cadangan > 0 ? ($apbdes->r_pembentukan_dana_cadangan / $apbdes->pembentukan_dana_cadangan) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->pembentukan_dana_cadangan > 0 ? ($apbdes->r_pembentukan_dana_cadangan / $apbdes->pembentukan_dana_cadangan) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                    <div class="penyertaan-modal space-y-0.5">
                        <h1 class="text-md font-semibold text-sky-700">Penyertaan Modal</h1>
                        <h1 class="text-md font-semibold text-sky-900">@rupiah($apbdes->r_penyertaan_modal) | @rupiah($apbdes->penyertaan_modal)</h1>
                        <div class="w-full bg-sky-900 rounded-full">
                            <div class="bg-sky-700 text-xs font-medium text-sky-100 text-center p-0.5 leading-none rounded-full min-w-[20px] h-5 flex items-center justify-center" style="width: {{ max(0.5, ($apbdes->penyertaan_modal > 0 ? ($apbdes->r_penyertaan_modal / $apbdes->penyertaan_modal) * 100 : 0)) }}%">
                                {{ number_format(($apbdes->penyertaan_modal > 0 ? ($apbdes->r_penyertaan_modal / $apbdes->penyertaan_modal) * 100 : 0), 2, '.', '') }}%
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- Sidebar List Berita -->
        <div class="list_berita-wrapper">
            <section class="list_berita md:col-span-1 p-5 md:mt-5 border border-gray-300 shadow-md shadow-slate-400">
                <h3 class="text-black font-extrabold text-lg md:text-xl mb-6">
                    Berita Desa
                </h3>

                @foreach ($daftarBerita as $beritas)
                    <div class="container space-y-2">
                        <!-- Berita item -->
                        <div class="berita-item flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4 border-2 border-gray-300 p-2 rounded-xs shadow-sm shadow-slate-400">
                            <!-- thumbnail -->
                            <div class="w-full sm:w-1/3">
                                <img src="{{ asset('storage/' . $beritas->gambar) }}" alt="Upacara HUT" class="w-full h-auto object-cover" />
                            </div>
                            <!-- title + link -->
                            <div class="flex flex-col justify-between flex-1 h-full">
                                <h4 class="text-xs font-semibold mb-2">
                                    {{ $beritas->judul }}
                                </h4>
                                <a href="#" class="mt-auto text-sky-600 text-xs underline hover:text-sky-800">
                                    Baca Selengkapnya
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
</div>
