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
                ->where('is_deleted', 0)
                ->orderBy('id_agenda', 'desc')
                ->paginate(5);

        return view('masyarakat.agenda-desa.agenda-desa', [
            'agendaData' => $agenda,
        ]);
    }

}
