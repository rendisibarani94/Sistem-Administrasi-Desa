<?php

namespace App\Livewire\Admin\AdministrasiUmum\AgendaSuratDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AgendaSuratDesaController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Surat Keluar ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('surat_keluar')
            ->where('id_surat_keluar', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Surat Keluar berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.agenda-surat.index',
            [
                'agendaSuratData' => DB::table('agenda_surat')
                    ->where('is_deleted', 0)
                    ->orderBy('id_agenda_surat', 'desc')
                    ->paginate(10),
            ]
        );
    }
}