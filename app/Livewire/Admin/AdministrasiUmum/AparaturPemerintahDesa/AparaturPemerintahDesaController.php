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

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.index',
            [
                'aparaturDesaData' => DB::table('aparatur_desa')
                ->when($this->search, function ($query) {
                    return $query->where(function ($subQuery) {
                        $subQuery->where('nama_lengkap', 'like', '%' . $this->search . '%')
                            ->orWhere('nip', 'like', '%' . $this->search . '%')
                            ->orWhere('nipd', 'like', '%' . $this->search . '%');
                    });
                })
                ->where('is_deleted', 0)
                ->orderBy('id_aparatur', 'desc')
                ->paginate(10),
            ]
        );
    }
}
