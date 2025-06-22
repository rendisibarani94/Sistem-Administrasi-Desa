<?php
namespace App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KeputusanKepalaDesaController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Keputusan Kepala Desa ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('keputusan_kepala_desa')
            ->where('id_keputusan_kepala_desa', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Keputusan Kepala Desa berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.keputusan-kepala-desa.index',
            [
                'keputusanKepalaDesaData' => DB::table('keputusan_kepala_desa')
                ->when($this->search, function ($query) {
                    return $query
                    ->where('tentang', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_keputusan_kepala_desa', 'desc')
                ->paginate(10),
            ]
        );
    }
}
