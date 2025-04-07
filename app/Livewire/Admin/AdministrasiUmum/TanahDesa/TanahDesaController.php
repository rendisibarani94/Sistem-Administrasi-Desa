<?php

namespace App\Livewire\Admin\AdministrasiUmum\TanahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class TanahDesaController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Tanah Desa ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('tanah_desa')
            ->where('id_tanah_desa', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Tanah Desa berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        $tanahDesaData = DB::table('tanah_desa')
        ->select(
            '*',
            DB::raw('
                luas_hm +
                luas_hgb +
                luas_hp +
                luas_hgu +
                luas_hpl +
                luas_ma +
                luas_vi +
                luas_tn +
                luas_perumahan +
                luas_perdagangan +
                luas_perkantoran +
                luas_industri +
                luas_fasilitas_umum +
                luas_sawah +
                luas_tegalan +
                luas_perkebunan +
                luas_peternakan_perikanan +
                luas_hutan_belukar +
                luas_hutan_lebat +
                luas_tanah_kosong +
                luas_tanah_lain AS volume
            ')
        )
        ->where('is_deleted', 0)
        ->orderBy('id_tanah_desa', 'desc')
        ->paginate(10);

        return view('admin.umum.tanah-desa.index',compact('tanahDesaData'));
    }
}
