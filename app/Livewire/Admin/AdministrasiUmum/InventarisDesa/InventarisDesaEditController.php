<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaEditController extends Component
{
    public $id_inventaris_desa;

    #[Rule('required', message: 'Kolom Jenis Barang Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Jenis Barang Terlalu Panjang!')]
    public $jenis_inventaris;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_desa;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_pemerintah;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_provinsi;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_kabupaten;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $oleh_sumbangan;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_baik;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_rusak;

    #[Rule('max:255', message: 'Kolom Keterangan Terlalu Panjang!')]
    public $keterangan;


    public function mount($id_inventaris_desa)
    {
        $this->id_inventaris_desa = $id_inventaris_desa;
        $this->loadEditData();
    }

    public function loadEditData(){
        $id = DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->first();

        $this->jenis_inventaris = $id->jenis_inventaris;
        $this->oleh_desa = $id->oleh_desa;
        $this->oleh_pemerintah = $id->oleh_pemerintah;
        $this->oleh_provinsi = $id->oleh_provinsi;
        $this->oleh_kabupaten = $id->oleh_kabupaten;
        $this->oleh_sumbangan = $id->oleh_sumbangan;
        $this->keterangan = $id->keterangan;
        $this->jumlah_baik = $id->jumlah_baik;
        $this->jumlah_rusak = $id->jumlah_rusak;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->update($validated);

        return redirect()->route('InventarisDesa')->with('success', 'Data Inventaris Desa Berhasil Diubah!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.edit');
    }
}
