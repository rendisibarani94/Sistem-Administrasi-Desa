<?php

namespace App\Livewire\Admin\Masyarakat\Apbdes;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class AdminApbdesEditController extends Component
{
    use WithFileUploads;

    public $id_apbdes;

    #[Rule('required|numeric', message: 'Tahun Anggaran APBDesa harus Diisi!')]
    public $tahun_anggaran;

    public $pendapatan_desa;
    public $pembiayaan_desa;
    public $belanja_desa;

        // APBDesa Pendapata
    public $hasil_usaha;
    public $hasil_aset;
    public $swadaya_partisipasi_gotong_royong;
    public $pendapatan_asli_lain;
    public $dana_desa;
    public $bagian_pajak_daerah;
    public $retribusi_daerah;
    public $alokasi_dana_desa;
    public $bantuan_keuangan_provinsi;
    public $bantuan_keuangan_kabupaten;
    public $penerimaan_kerja_sama;
    public $bantuan_perusahaan_di_desa;
    public $hibah_sumbangan_pihak_ketiga;
    public $koreksi_kesalahan_belanja;
    public $bunga_bank_desa;
    public $pendapatan_lain_sah;
    public $r_hasil_usaha;
    public $r_hasil_aset;
    public $r_swadaya_partisipasi_gotong_royong;
    public $r_pendapatan_asli_lain;
    public $r_dana_desa;
    public $r_bagian_pajak_daerah;
    public $r_retribusi_daerah;
    public $r_alokasi_dana_desa;
    public $r_bantuan_keuangan_provinsi;
    public $r_bantuan_keuangan_kabupaten;
    public $r_penerimaan_kerja_sama;
    public $r_bantuan_perusahaan_di_desa;
    public $r_hibah_sumbangan_pihak_ketiga;
    public $r_koreksi_kesalahan_belanja;
    public $r_bunga_bank_desa;
    public $r_pendapatan_lain_sah;

    // APBDesa Belanja Des
    public $penyelenggaraan_pemerintahan;
    public $pelaksanaan_pembangunan;
    public $pembinaan_kemasyarakatan;
    public $pemberdayaan_masyarakat;
    public $penanggulangan_bencana_darurat_mendesak;
    public $belanja_tak_terduga;
    public $r_penyelenggaraan_pemerintahan;
    public $r_pelaksanaan_pembangunan;
    public $r_pembinaan_kemasyarakatan;
    public $r_pemberdayaan_masyarakat;
    public $r_penanggulangan_bencana_darurat_mendesak;
    public $r_belanja_tak_terduga;

    // APBDesa Pembiayaan Des
    public $silpa_tahun_sebelumnya;
    public $pencairan_dana_cadangan;
    public $hasil_penjualan_kekayaan_desa;
    public $pembentukan_dana_cadangan;
    public $penyertaan_modal;
    public $r_silpa_tahun_sebelumnya;
    public $r_pencairan_dana_cadangan;
    public $r_hasil_penjualan_kekayaan_desa;
    public $r_pembentukan_dana_cadangan;
    public $r_penyertaan_modal;

    public function mount($id_apbdes)
    {
        $this->id_apbdes = $id_apbdes;
        $this->loadApbdes();
    }

    public function loadApbdes()
    {
        $apbdes = DB::table('apbdes')->where('id_apbdes', $this->id_apbdes)->first();

        $this->tahun_anggaran = $apbdes->tahun_anggaran;
        $this->pendapatan_desa = $apbdes->pendapatan_desa;
        $this->pembiayaan_desa = $apbdes->pembiayaan_desa;
        $this->belanja_desa = $apbdes->belanja_desa;

        $pendapatanDesa = DB::table('pendapatan_desa')->where('id_pendapatan_desa', $this->pendapatan_desa)->first();
        $pembiayaaDesa = DB::table('pembiayaan_desa')->where('id_pembiayaan_desa', $this->pembiayaan_desa)->first();
        $belanjaDesa = DB::table('belanja_desa')->where('id_belanja_desa', $this->belanja_desa)->first();


        $this->hasil_usaha = $pendapatanDesa->hasil_usaha;
        $this->hasil_aset = $pendapatanDesa->hasil_aset;
        $this->swadaya_partisipasi_gotong_royong = $pendapatanDesa->swadaya_partisipasi_gotong_royong;
        $this->pendapatan_asli_lain = $pendapatanDesa->pendapatan_asli_lain;
        $this->dana_desa = $pendapatanDesa->dana_desa;
        $this->bagian_pajak_daerah = $pendapatanDesa->bagian_pajak_daerah;
        $this->retribusi_daerah = $pendapatanDesa->retribusi_daerah;
        $this->alokasi_dana_desa = $pendapatanDesa->alokasi_dana_desa;
        $this->bantuan_keuangan_provinsi = $pendapatanDesa->bantuan_keuangan_provinsi;
        $this->bantuan_keuangan_kabupaten = $pendapatanDesa->bantuan_keuangan_kabupaten;
        $this->penerimaan_kerja_sama = $pendapatanDesa->penerimaan_kerja_sama;
        $this->bantuan_perusahaan_di_desa = $pendapatanDesa->bantuan_perusahaan_di_desa;
        $this->hibah_sumbangan_pihak_ketiga = $pendapatanDesa->hibah_sumbangan_pihak_ketiga;
        $this->koreksi_kesalahan_belanja = $pendapatanDesa->koreksi_kesalahan_belanja;
        $this->bunga_bank_desa = $pendapatanDesa->bunga_bank_desa;
        $this->pendapatan_lain_sah = $pendapatanDesa->pendapatan_lain_sah;
        $this->r_hasil_usaha = $pendapatanDesa->r_hasil_usaha;
        $this->r_hasil_aset = $pendapatanDesa->r_hasil_aset;
        $this->r_swadaya_partisipasi_gotong_royong = $pendapatanDesa->r_swadaya_partisipasi_gotong_royong;
        $this->r_pendapatan_asli_lain = $pendapatanDesa->r_pendapatan_asli_lain;
        $this->r_dana_desa = $pendapatanDesa->r_dana_desa;
        $this->r_bagian_pajak_daerah = $pendapatanDesa->r_bagian_pajak_daerah;
        $this->r_retribusi_daerah = $pendapatanDesa->r_retribusi_daerah;
        $this->r_alokasi_dana_desa = $pendapatanDesa->r_alokasi_dana_desa;
        $this->r_bantuan_keuangan_provinsi = $pendapatanDesa->r_bantuan_keuangan_provinsi;
        $this->r_bantuan_keuangan_kabupaten = $pendapatanDesa->r_bantuan_keuangan_kabupaten;
        $this->r_penerimaan_kerja_sama = $pendapatanDesa->r_penerimaan_kerja_sama;
        $this->r_bantuan_perusahaan_di_desa = $pendapatanDesa->r_bantuan_perusahaan_di_desa;
        $this->r_hibah_sumbangan_pihak_ketiga = $pendapatanDesa->r_hibah_sumbangan_pihak_ketiga;
        $this->r_koreksi_kesalahan_belanja = $pendapatanDesa->r_koreksi_kesalahan_belanja;
        $this->r_bunga_bank_desa = $pendapatanDesa->r_bunga_bank_desa;
        $this->r_pendapatan_lain_sah = $pendapatanDesa->r_pendapatan_lain_sah;

        $this->penyelenggaraan_pemerintahan = $belanjaDesa->penyelenggaraan_pemerintahan;
        $this->pelaksanaan_pembangunan = $belanjaDesa->pelaksanaan_pembangunan;
        $this->pembinaan_kemasyarakatan = $belanjaDesa->pembinaan_kemasyarakatan;
        $this->pemberdayaan_masyarakat = $belanjaDesa->pemberdayaan_masyarakat;
        $this->penanggulangan_bencana_darurat_mendesak = $belanjaDesa->penanggulangan_bencana_darurat_mendesak;
        $this->belanja_tak_terduga = $belanjaDesa->belanja_tak_terduga;
        $this->r_penyelenggaraan_pemerintahan = $belanjaDesa->r_penyelenggaraan_pemerintahan;
        $this->r_pelaksanaan_pembangunan = $belanjaDesa->r_pelaksanaan_pembangunan;
        $this->r_pembinaan_kemasyarakatan = $belanjaDesa->r_pembinaan_kemasyarakatan;
        $this->r_pemberdayaan_masyarakat = $belanjaDesa->r_pemberdayaan_masyarakat;
        $this->r_penanggulangan_bencana_darurat_mendesak = $belanjaDesa->r_penanggulangan_bencana_darurat_mendesak;
        $this->r_belanja_tak_terduga = $belanjaDesa->r_belanja_tak_terduga;

        $this->silpa_tahun_sebelumnya = $pembiayaaDesa->silpa_tahun_sebelumnya;
        $this->pencairan_dana_cadangan = $pembiayaaDesa->pencairan_dana_cadangan;
        $this->hasil_penjualan_kekayaan_desa = $pembiayaaDesa->hasil_penjualan_kekayaan_desa;
        $this->pembentukan_dana_cadangan = $pembiayaaDesa->pembentukan_dana_cadangan;
        $this->penyertaan_modal = $pembiayaaDesa->penyertaan_modal;
        $this->r_silpa_tahun_sebelumnya = $pembiayaaDesa->r_silpa_tahun_sebelumnya;
        $this->r_pencairan_dana_cadangan = $pembiayaaDesa->r_pencairan_dana_cadangan;
        $this->r_hasil_penjualan_kekayaan_desa = $pembiayaaDesa->r_hasil_penjualan_kekayaan_desa;
        $this->r_pembentukan_dana_cadangan = $pembiayaaDesa->r_pembentukan_dana_cadangan;
        $this->r_penyertaan_modal = $pembiayaaDesa->r_penyertaan_modal;

    }

    public function update()
    {
        // Validating
        $this->validate();

        try {
        $pendapatanUpdate['hasil_usaha'] = $this->hasil_usaha;
        $pendapatanUpdate['hasil_aset'] = $this->hasil_aset;
        $pendapatanUpdate['swadaya_partisipasi_gotong_royong'] = $this->swadaya_partisipasi_gotong_royong;
        $pendapatanUpdate['pendapatan_asli_lain'] = $this->pendapatan_asli_lain;
        $pendapatanUpdate['dana_desa'] = $this->dana_desa;
        $pendapatanUpdate['bagian_pajak_daerah'] = $this->bagian_pajak_daerah;
        $pendapatanUpdate['retribusi_daerah'] = $this->retribusi_daerah;
        $pendapatanUpdate['alokasi_dana_desa'] = $this->alokasi_dana_desa;
        $pendapatanUpdate['bantuan_keuangan_provinsi'] = $this->bantuan_keuangan_provinsi;
        $pendapatanUpdate['bantuan_keuangan_kabupaten'] = $this->bantuan_keuangan_kabupaten;
        $pendapatanUpdate['penerimaan_kerja_sama'] = $this->penerimaan_kerja_sama;
        $pendapatanUpdate['bantuan_perusahaan_di_desa'] = $this->bantuan_perusahaan_di_desa;
        $pendapatanUpdate['hibah_sumbangan_pihak_ketiga'] = $this->hibah_sumbangan_pihak_ketiga;
        $pendapatanUpdate['koreksi_kesalahan_belanja'] = $this->koreksi_kesalahan_belanja;
        $pendapatanUpdate['bunga_bank_desa'] = $this->bunga_bank_desa;
        $pendapatanUpdate['pendapatan_lain_sah'] = $this->pendapatan_lain_sah;
        $pendapatanUpdate['r_hasil_usaha'] = $this->r_hasil_usaha;
        $pendapatanUpdate['r_hasil_aset'] = $this->r_hasil_aset;
        $pendapatanUpdate['r_swadaya_partisipasi_gotong_royong'] = $this->r_swadaya_partisipasi_gotong_royong;
        $pendapatanUpdate['r_pendapatan_asli_lain'] = $this->r_pendapatan_asli_lain;
        $pendapatanUpdate['r_dana_desa'] = $this->r_dana_desa;
        $pendapatanUpdate['r_bagian_pajak_daerah'] = $this->r_bagian_pajak_daerah;
        $pendapatanUpdate['r_retribusi_daerah'] = $this->r_retribusi_daerah;
        $pendapatanUpdate['r_alokasi_dana_desa'] = $this->r_alokasi_dana_desa;
        $pendapatanUpdate['r_bantuan_keuangan_provinsi'] = $this->r_bantuan_keuangan_provinsi;
        $pendapatanUpdate['r_bantuan_keuangan_kabupaten'] = $this->r_bantuan_keuangan_kabupaten;
        $pendapatanUpdate['r_penerimaan_kerja_sama'] = $this->r_penerimaan_kerja_sama;
        $pendapatanUpdate['r_bantuan_perusahaan_di_desa'] = $this->r_bantuan_perusahaan_di_desa;
        $pendapatanUpdate['r_hibah_sumbangan_pihak_ketiga'] = $this->r_hibah_sumbangan_pihak_ketiga;
        $pendapatanUpdate['r_koreksi_kesalahan_belanja'] = $this->r_koreksi_kesalahan_belanja;
        $pendapatanUpdate['r_bunga_bank_desa'] = $this->r_bunga_bank_desa;
        $pendapatanUpdate['r_pendapatan_lain_sah'] = $this->r_pendapatan_lain_sah;

        $belanjaUpdate['penyelenggaraan_pemerintahan'] = $this->penyelenggaraan_pemerintahan;
        $belanjaUpdate['pelaksanaan_pembangunan'] = $this->pelaksanaan_pembangunan;
        $belanjaUpdate['pembinaan_kemasyarakatan'] = $this->pembinaan_kemasyarakatan;
        $belanjaUpdate['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat;
        $belanjaUpdate['penanggulangan_bencana_darurat_mendesak'] = $this->penanggulangan_bencana_darurat_mendesak;
        $belanjaUpdate['belanja_tak_terduga'] = $this->belanja_tak_terduga;
        $belanjaUpdate['r_penyelenggaraan_pemerintahan'] = $this->r_penyelenggaraan_pemerintahan;
        $belanjaUpdate['r_pelaksanaan_pembangunan'] = $this->r_pelaksanaan_pembangunan;
        $belanjaUpdate['r_pembinaan_kemasyarakatan'] = $this->r_pembinaan_kemasyarakatan;
        $belanjaUpdate['r_pemberdayaan_masyarakat'] = $this->r_pemberdayaan_masyarakat;
        $belanjaUpdate['r_penanggulangan_bencana_darurat_mendesak'] = $this->r_penanggulangan_bencana_darurat_mendesak;
        $belanjaUpdate['r_belanja_tak_terduga'] = $this->r_belanja_tak_terduga;

        $pembiayaanUpdate['silpa_tahun_sebelumnya'] = $this->silpa_tahun_sebelumnya;
        $pembiayaanUpdate['pencairan_dana_cadangan'] = $this->pencairan_dana_cadangan;
        $pembiayaanUpdate['hasil_penjualan_kekayaan_desa'] = $this->hasil_penjualan_kekayaan_desa;
        $pembiayaanUpdate['pembentukan_dana_cadangan'] = $this->pembentukan_dana_cadangan;
        $pembiayaanUpdate['penyertaan_modal'] = $this->penyertaan_modal;
        $pembiayaanUpdate['r_silpa_tahun_sebelumnya'] = $this->r_silpa_tahun_sebelumnya;
        $pembiayaanUpdate['r_pencairan_dana_cadangan'] = $this->r_pencairan_dana_cadangan;
        $pembiayaanUpdate['r_hasil_penjualan_kekayaan_desa'] = $this->r_hasil_penjualan_kekayaan_desa;
        $pembiayaanUpdate['r_pembentukan_dana_cadangan'] = $this->r_pembentukan_dana_cadangan;
        $pembiayaanUpdate['r_penyertaan_modal'] = $this->r_penyertaan_modal;

        $apbdesUpdate['tahun_anggaran'] = $this->tahun_anggaran;
        $apbdesUpdate['updated_at'] = now();
        $apbdesUpdate['id_dibuat_oleh'] = auth()->id();
        DB::table('pendapatan_desa')->where('id_pendapatan_desa', $this->pendapatan_desa)->update($pendapatanUpdate);
        DB::table('pembiayaan_desa')->where('id_pembiayaan_desa', $this->pembiayaan_desa)->update($pembiayaanUpdate);
        DB::table('belanja_desa')->where('id_belanja_desa', $this->belanja_desa)->update($belanjaUpdate);

        DB::table('apbdes')->where('id_apbdes', $this->id_apbdes)->update($apbdesUpdate);

        // FIXED: Redirect BEFORE resetting
        return redirect()->route('admin.apbdes')->with('success', 'Data APBDesa berhasil diubah!');

    } catch (\Exception $e) {
        $this->addError('update_error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.apbdes.edit');
    }
}
