<?php

namespace App\Livewire\Masyarakat\Agenda;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AgendaController extends Component
{

    public $selectedAgenda; // Store selected agenda data
    public $showModal = false; // Control modal visibility

    // Show agenda details in modal
    public function showAgenda($id)
    {
        $this->selectedAgenda = DB::table('agenda')
            ->join('users', 'agenda.id_dibuat_oleh', '=', 'users.id')
            ->where('agenda.is_deleted', 0)
            ->orderBy('agenda.id_agenda', 'desc')
            ->select('agenda.*', 'users.name as nama_pembuat')
            ->where('id_agenda', $id)
            ->first();

        $this->showModal = true;
    }

    // Close modal
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedAgenda = null;
    }

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $agenda = DB::table('agenda')
            ->join('users', 'agenda.id_dibuat_oleh', '=', 'users.id')
            ->where('agenda.is_deleted', 0)
            ->orderBy('agenda.id_agenda', 'desc')
            ->select('agenda.*', 'users.name as nama_pembuat')
            ->paginate(5);

        return view('masyarakat.agenda-desa.agenda-desa', [
            'agendaData' => $agenda,
        ]);
    }
}
