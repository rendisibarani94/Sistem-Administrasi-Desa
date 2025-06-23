<?php

namespace App\Livewire\Admin\Masyarakat\Apbdes;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class AdminApbdesCreateController extends Component
{
    use WithFileUploads;

    // #[Rule('required', message: 'Dokumen APBDesa harus diunggah!')]
    // #[Rule('file', message: 'File yang diunggah tidak valid!')]
    // #[Rule('max:10240', message: 'Ukuran file maksimal 10MB!')] // 10MB = 10240KB
    // public $dokumen_apbdes;

    #[Rule('required', message: 'Tahun Anggaran APBDesa harus Diisi!')]
    public $tahun_anggaran;

    // APBDesa Pendapata
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $hasil_usaha = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $hasil_aset = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $swadaya_partisipasi_gotong_royong = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pendapatan_asli_lain = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $dana_desa = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $bagian_pajak_daerah = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $retribusi_daerah = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $alokasi_dana_desa = 0;

    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $bantuan_keuangan_provinsi = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $bantuan_keuangan_kabupaten = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $penerimaan_kerja_sama = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $bantuan_perusahaan_di_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $hibah_sumbangan_pihak_ketiga = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $koreksi_kesalahan_belanja = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $bunga_bank_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pendapatan_lain_sah = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_hasil_usaha = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_hasil_aset = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_swadaya_partisipasi_gotong_royong = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pendapatan_asli_lain = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_dana_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_bagian_pajak_daerah = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_retribusi_daerah = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_alokasi_dana_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_bantuan_keuangan_provinsi = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_bantuan_keuangan_kabupaten = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_penerimaan_kerja_sama = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_bantuan_perusahaan_di_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_hibah_sumbangan_pihak_ketiga = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_koreksi_kesalahan_belanja = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_bunga_bank_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pendapatan_lain_sah = 0;

    // APBDesa Belanja Des
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $penyelenggaraan_pemerintahan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pelaksanaan_pembangunan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pembinaan_kemasyarakatan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pemberdayaan_masyarakat = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $penanggulangan_bencana_darurat_mendesak = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $belanja_tak_terduga = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_penyelenggaraan_pemerintahan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pelaksanaan_pembangunan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pembinaan_kemasyarakatan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pemberdayaan_masyarakat = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_penanggulangan_bencana_darurat_mendesak = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_belanja_tak_terduga = 0;

    // APBDesa Pembiayaan Des
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $silpa_tahun_sebelumnya = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pencairan_dana_cadangan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $hasil_penjualan_kekayaan_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $pembentukan_dana_cadangan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $penyertaan_modal = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_silpa_tahun_sebelumnya = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pencairan_dana_cadangan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_hasil_penjualan_kekayaan_desa = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_pembentukan_dana_cadangan = 0;
    #[Rule('required', message: 'Isi Dengan 0 jika kosong!')]
    public $r_penyertaan_modal = 0;


    public function store()
    {
        $validated = $this->validate();

        //APBDesa pendapatan
        $pendapatan['hasil_usaha'] = $this->hasil_usaha;
        $pendapatan['hasil_aset'] = $this->hasil_aset;
        $pendapatan['swadaya_partisipasi_gotong_royong'] = $this->swadaya_partisipasi_gotong_royong;
        $pendapatan['pendapatan_asli_lain'] = $this->pendapatan_asli_lain;
        $pendapatan['dana_desa'] = $this->dana_desa;
        $pendapatan['bagian_pajak_daerah'] = $this->bagian_pajak_daerah;
        $pendapatan['retribusi_daerah'] = $this->retribusi_daerah;
        $pendapatan['alokasi_dana_desa'] = $this->alokasi_dana_desa;
        $pendapatan['bantuan_keuangan_provinsi'] = $this->bantuan_keuangan_provinsi;
        $pendapatan['bantuan_keuangan_kabupaten'] = $this->bantuan_keuangan_kabupaten;
        $pendapatan['penerimaan_kerja_sama'] = $this->penerimaan_kerja_sama;
        $pendapatan['bantuan_perusahaan_di_desa'] = $this->bantuan_perusahaan_di_desa;
        $pendapatan['hibah_sumbangan_pihak_ketiga'] = $this->hibah_sumbangan_pihak_ketiga;
        $pendapatan['koreksi_kesalahan_belanja'] = $this->koreksi_kesalahan_belanja;
        $pendapatan['bunga_bank_desa'] = $this->bunga_bank_desa;
        $pendapatan['pendapatan_lain_sah'] = $this->pendapatan_lain_sah;
        $pendapatan['r_hasil_usaha'] = $this->r_hasil_usaha;
        $pendapatan['r_hasil_aset'] = $this->r_hasil_aset;
        $pendapatan['r_swadaya_partisipasi_gotong_royong'] = $this->r_swadaya_partisipasi_gotong_royong;
        $pendapatan['r_pendapatan_asli_lain'] = $this->r_pendapatan_asli_lain;
        $pendapatan['r_dana_desa'] = $this->r_dana_desa;
        $pendapatan['r_bagian_pajak_daerah'] = $this->r_bagian_pajak_daerah;
        $pendapatan['r_retribusi_daerah'] = $this->r_retribusi_daerah;
        $pendapatan['r_alokasi_dana_desa'] = $this->r_alokasi_dana_desa;
        $pendapatan['r_bantuan_keuangan_provinsi'] = $this->r_bantuan_keuangan_provinsi;
        $pendapatan['r_bantuan_keuangan_kabupaten'] = $this->r_bantuan_keuangan_kabupaten;
        $pendapatan['r_penerimaan_kerja_sama'] = $this->r_penerimaan_kerja_sama;
        $pendapatan['r_bantuan_perusahaan_di_desa'] = $this->r_bantuan_perusahaan_di_desa;
        $pendapatan['r_hibah_sumbangan_pihak_ketiga'] = $this->r_hibah_sumbangan_pihak_ketiga;
        $pendapatan['r_koreksi_kesalahan_belanja'] = $this->r_koreksi_kesalahan_belanja;
        $pendapatan['r_bunga_bank_desa'] = $this->r_bunga_bank_desa;
        $pendapatan['r_pendapatan_lain_sah'] = $this->r_pendapatan_lain_sah;

        $belanja['penyelenggaraan_pemerintahan'] = $this->penyelenggaraan_pemerintahan;
        $belanja['pelaksanaan_pembangunan'] = $this->pelaksanaan_pembangunan;
        $belanja['pembinaan_kemasyarakatan'] = $this->pembinaan_kemasyarakatan;
        $belanja['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat;
        $belanja['penanggulangan_bencana_darurat_mendesak'] = $this->penanggulangan_bencana_darurat_mendesak;
        $belanja['belanja_tak_terduga'] = $this->belanja_tak_terduga;
        $belanja['r_penyelenggaraan_pemerintahan'] = $this->r_penyelenggaraan_pemerintahan;
        $belanja['r_pelaksanaan_pembangunan'] = $this->r_pelaksanaan_pembangunan;
        $belanja['r_pembinaan_kemasyarakatan'] = $this->r_pembinaan_kemasyarakatan;
        $belanja['r_pemberdayaan_masyarakat'] = $this->r_pemberdayaan_masyarakat;
        $belanja['r_penanggulangan_bencana_darurat_mendesak'] = $this->r_penanggulangan_bencana_darurat_mendesak;
        $belanja['r_belanja_tak_terduga'] = $this->r_belanja_tak_terduga;

        //APBDesa pembiayaan
        $pembiayaan['silpa_tahun_sebelumnya'] = $this->silpa_tahun_sebelumnya;
        $pembiayaan['pencairan_dana_cadangan'] = $this->pencairan_dana_cadangan;
        $pembiayaan['hasil_penjualan_kekayaan_desa'] = $this->hasil_penjualan_kekayaan_desa;
        $pembiayaan['pembentukan_dana_cadangan'] = $this->pembentukan_dana_cadangan;
        $pembiayaan['penyertaan_modal'] = $this->penyertaan_modal;
        $pembiayaan['r_silpa_tahun_sebelumnya'] = $this->r_silpa_tahun_sebelumnya;
        $pembiayaan['r_pencairan_dana_cadangan'] = $this->r_pencairan_dana_cadangan;
        $pembiayaan['r_hasil_penjualan_kekayaan_desa'] = $this->r_hasil_penjualan_kekayaan_desa;
        $pembiayaan['r_pembentukan_dana_cadangan'] = $this->r_pembentukan_dana_cadangan;
        $pembiayaan['r_penyertaan_modal'] = $this->r_penyertaan_modal;


        $pendapatanId = DB::table('pendapatan_desa')->insertGetId($pendapatan);

        $pembiayaanId = DB::table('pembiayaan_desa')->insertGetId($pembiayaan);

        $belanjaId = DB::table('belanja_desa')->insertGetId($belanja);

        $apbdes['tahun_anggaran'] = $this->tahun_anggaran;
        $apbdes['pendapatan_desa'] = $pendapatanId;
        $apbdes['pembiayaan_desa'] = $pembiayaanId;
        $apbdes['belanja_desa'] = $belanjaId;
        $apbdes['id_dibuat_oleh'] = auth()->id();
        DB::table('apbdes')->insert($apbdes);

        $this->reset();

        return redirect()->route('admin.apbdes')->with('success', 'Data APBDesa berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.apbdes.create');
    }
}
