<?php

namespace App\Livewire\Admin\Masyarakat\Agenda;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAgendaController extends Component
{
    public $deleteId;
    public $search;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Agenda ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('agenda')
            ->where('id_agenda', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Agenda Sementara berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.masyarakat.agenda.index',
            [
                'agendaData' => DB::table('agenda')
                    ->when($this->search, function ($query) {
                        return $query->where(function ($subQuery) {
                            $subQuery->where('judul', 'like', '%' . $this->search . '%')
                                ->orWhere('tujuan_agenda', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->where('is_deleted', 0)
                    ->paginate(10),
            ]
        );
    }
}
