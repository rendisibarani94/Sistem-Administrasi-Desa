<?php
namespace App\Livewire\Admin\AdministrasiUmum\TanahKasDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class TanahKasDesaCreateController extends Component
{
    #[Rule('required', message: 'Kolom Asal Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Asal Tanah Kas Desa Terlalu Panjang')]
    public $asal_tkd;

    #[Rule('required', message: 'Kolom Nomor Letter C Harus Diisi!')]
    #[Rule('max:10', message: 'Kolom Nomor Letter C Terlalu Panjang')]
    public $letter_c;

    #[Rule('required', message: 'Kolom Nomor Persil Harus Diisi!')]
    #[Rule('max:10', message: 'Kolom Nomor Persil Terlalu Panjang')]
    public $persil;


    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_desa = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_pemerintah = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_provinsi = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_kabupaten = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $oleh_lain_lain = 0;

    #[Rule('required', message: 'Kolom Tanggal Perolehan Tanah Kas Desa Harus Diisi!')]
    public $tanggal_perolehan;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $sawah = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tegal = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $kebun = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tombak = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanah_kering = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $patok = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanpa_patok = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $papan_nama = 0;

    #[Rule('required', message: 'Jika Tidak Ada, Isi Dengan 0')]
    public $tanpa_papan_nama = 0;

    #[Rule('required', message: 'Kolom Lokasi Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Lokasi Terlalu Panjang')]
    public $lokasi;

    #[Rule('required', message: 'Kolom Peruntukan Tanah Kas Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Peruntukan Terlalu Panjang')]
    public $peruntukan;

    #[Rule('max:255', message: 'Kolom Keterngan Terlalu Panjang')]
    public $keterangan;

    public function store(){
        $validated = $this->validate();

        DB::table('tanah_kas_desa')->insert($validated);

        $this->reset();

        return redirect()->route('TanahKasDesa')->with('success', 'Data Tanah Kas Desa berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.tanah-kas-desa.create'
        );
    }
}
