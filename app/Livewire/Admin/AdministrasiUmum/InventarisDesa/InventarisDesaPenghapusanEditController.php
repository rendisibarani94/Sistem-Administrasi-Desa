<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class InventarisDesaPenghapusanEditController extends Component
{
    public $id_inventaris_desa;
    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_dijual;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_disumbangkan;

    #[Rule('required', message: 'Kolom Tanggal Penghapusan Harus Diisi!')]
    public $tanggal_penghapusan;

    #[Rule('max:255', message: 'Kolom Keterangan Terlalu Panjang')]
    public $keterangan;

    public function mount($id_inventaris_desa)
    {
        $this->id_inventaris_desa = $id_inventaris_desa;
        $this->loadHapusData();
    }

    public function loadHapusData()
    {
        $id = DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->first();

        $this->jumlah_dijual = $id->jumlah_dijual;
        $this->jumlah_disumbangkan = $id->jumlah_disumbangkan;
        $this->tanggal_penghapusan = $id->tanggal_penghapusan;
        $this->keterangan = $id->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->update($validated);

        return redirect()->route('InventarisDesa.deleted')->with('success', 'Data Penghapusan Inventaris Desa Berhasil Diubah!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.edit-penghapusan');
    }
}
