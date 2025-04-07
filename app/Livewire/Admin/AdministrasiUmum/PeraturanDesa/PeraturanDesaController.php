<?php

namespace App\Livewire\Admin\AdministrasiUmum\PeraturanDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class PeraturanDesaController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Peraturan Desa ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('peraturan_Desa')
            ->where('id_peraturan_desa', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Peraturan Desa berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.peraturan-desa.index',
            [
                'peraturanDesaData' => DB::table('peraturan_desa')
                    ->join('jenis_peraturan', 'peraturan_desa.jenis_peraturan', '=', 'jenis_peraturan.id_jenis_peraturan') 
                    ->select('peraturan_desa.*', 'jenis_peraturan.jenis_peraturan')
                    ->when($this->search, function ($query) {
                        return $query
                        ->where('tentang', 'like', '%' . $this->search . '%');
                    }) 
                    ->where('peraturan_desa.is_deleted', 0)
                    ->orderBy('peraturan_desa.id_peraturan_desa', 'desc')
                    ->paginate(10),
            ]
        );
    }
}
