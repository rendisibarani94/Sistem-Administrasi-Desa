<?php

namespace App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AparaturPemerintahDesaController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Aparatur Desa ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('aparatur_desa')
            ->where('id_aparatur', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Aparatur Desa berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.index',
            [
                'aparaturDesaData' => DB::table('aparatur_desa')
                ->join('jabatan', 'aparatur_desa.jabatan', '=', 'jabatan.id_jabatan') // Adjust FK if needed
                ->select('aparatur_desa.*', 'jabatan.jabatan') // Select required fields
                ->when($this->search, function ($query) {
                    return $query->where(function ($subQuery) {
                        $subQuery->where('nama_lengkap', 'like', '%' . $this->search . '%')
                            ->orWhere('nip', 'like', '%' . $this->search . '%')
                            ->orWhere('nipd', 'like', '%' . $this->search . '%')
                            ->orWhere('jabatan.jabatan', 'like', '%' . $this->search . '%');
                    });
                })
                ->where('aparatur_desa.is_deleted', 0)
                ->orderBy('aparatur_desa.id_aparatur', 'desc')
                ->paginate(10),
            ]
        );
    }
}
