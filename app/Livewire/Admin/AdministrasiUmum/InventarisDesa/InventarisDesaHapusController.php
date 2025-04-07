<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class InventarisDesaHapusController extends Component
{
    public $id_inventaris_desa;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_dijual = 0;

    #[Rule('required', message: 'Jika Kosong, Diisi 0')]
    public $jumlah_disumbangkan = 0;

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

        $this->keterangan = $id->keterangan;
    }

    public function hapus()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();
        $validated['is_deleted'] = 1;

        DB::table('inventaris_desa')->where('id_inventaris_desa', $this->id_inventaris_desa)->update($validated);

        return redirect()->route('InventarisDesa')->with('success', 'Penghapusan Data Inventaris Desa Berhasil dilakukan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.inventaris-desa.hapus');
    }
}
