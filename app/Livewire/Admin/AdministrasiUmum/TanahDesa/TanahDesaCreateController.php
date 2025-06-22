<?php

namespace App\Livewire\Admin\AdministrasiUmum\TanahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class TanahDesaCreateController extends Component
{
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



    public function store()
    {
        $validated = $this->validate();

        DB::table('tanah_desa')->insert($validated);


        $this->reset();

        return redirect()->route('TanahDesa')->with('success', 'Data Tanah Desa berhasil disimpan!');
    }


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.tanah-desa.create');
    }
}
