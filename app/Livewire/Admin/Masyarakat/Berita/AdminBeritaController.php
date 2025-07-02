<?php

namespace App\Livewire\Admin\Masyarakat\Berita;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBeritaController extends Component
{
    public $deleteId;
    public $search;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Berita ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('berita')
            ->where('id_berita', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Berita Sementara berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.masyarakat.berita-desa.index',
            [
                'beritaData' => DB::table('berita')
                    ->when($this->search, function ($query) {
                        return $query->where(function ($subQuery) {
                            $subQuery->where('judul', 'like', '%' . $this->search . '%')
                                ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->where('is_deleted', 0)
                    ->paginate(10),
            ]
        );
    }
}
