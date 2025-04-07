<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaCreateController extends Component
{
    #[Rule('required', message: 'Kolom Jenis Barang Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Jenis Barang Terlalu Panjang!')]
    public $jenis_inventaris;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_desa = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_pemerintah = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_provinsi = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_kabupaten = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_sumbangan = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_baik = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_rusak = 0;

    #[Rule('max:255', message: 'Kolom Keterangan Terlalu Panjang!')]
    public $keterangan;

    public function store()
    {
        $validated = $this->validate();

        DB::table('inventaris_desa')->insert($validated);

        $this->reset();

        return redirect()->route('InventarisDesa')->with('success', 'Data Inventaris Desa berhasil disimpan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.create');
    }
}
