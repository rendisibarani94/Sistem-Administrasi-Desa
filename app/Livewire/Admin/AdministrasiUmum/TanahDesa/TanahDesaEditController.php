<?php

namespace App\Livewire\Admin\AdministrasiUmum\TanahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class TanahDesaEditController extends Component
{
    public $id_tanah_desa;

    #[Rule('required', message: 'Kolom Nama Pemegang Hak Tanah Harus Diisi')]
    #[Rule('max:150', message: 'Batas Pengisian Kolom 150 karakter')]
    public $nama_pemegang_hak_tanah;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hm = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hgb = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hp = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hgu = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hpl = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_ma = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_vi = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_tn = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_perumahan = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_perdagangan = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_perkantoran = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_industri = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_fasilitas_umum = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_sawah = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_tegalan = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_perkebunan = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_peternakan_perikanan = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hutan_belukar = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_hutan_lebat = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_tanah_kosong = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $luas_tanah_lain = 0;

    #[Rule('max:255', message: 'Kolom Mutasi Terlalu Panjang')]
    public $mutasi;

    #[Rule('max:255', message: 'Kolom Keterngan Terlalu Panjang')]
    public $keterangan;

    public function mount($id_tanah_desa)
    {
        $this->id_tanah_desa = $id_tanah_desa;
        $this->loadEditData();
    }

    public function loadEditData()
    {
        $td = DB::table('tanah_desa')->where('id_tanah_desa', $this->id_tanah_desa)->first();

        $this->nama_pemegang_hak_tanah = $td->nama_pemegang_hak_tanah;
        $this->luas_hm = $td->luas_hm;
        $this->luas_hgb = $td->luas_hgb;
        $this->luas_hp = $td->luas_hp;
        $this->luas_hgu = $td->luas_hgu;
        $this->luas_hpl = $td->luas_hpl;
        $this->luas_ma = $td->luas_ma;
        $this->luas_vi = $td->luas_vi;
        $this->luas_tn = $td->luas_tn;
        $this->luas_perumahan = $td->luas_perumahan;
        $this->luas_perdagangan = $td->luas_perdagangan;
        $this->luas_perkantoran = $td->luas_perkantoran;
        $this->luas_industri = $td->luas_industri;
        $this->luas_fasilitas_umum = $td->luas_fasilitas_umum;
        $this->luas_sawah = $td->luas_sawah;
        $this->luas_tegalan = $td->luas_tegalan;
        $this->luas_perkebunan = $td->luas_perkebunan;
        $this->luas_peternakan_perikanan = $td->luas_peternakan_perikanan;
        $this->luas_hutan_belukar = $td->luas_hutan_belukar;
        $this->luas_hutan_lebat = $td->luas_hutan_lebat;
        $this->luas_tanah_kosong = $td->luas_tanah_kosong;
        $this->luas_tanah_lain = $td->luas_tanah_lain;
        $this->keterangan = $td->keterangan;
        $this->mutasi = $td->mutasi;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('tanah_desa')->where('id_tanah_desa', $this->id_tanah_desa)->update($validated);

        return redirect()->route('TanahDesa')->with('success', 'Data Tanah Desa berhasil diubah!');
    }


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.tanah-desa.edit');
    }
}
