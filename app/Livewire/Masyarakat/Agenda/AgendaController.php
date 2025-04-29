<?php

namespace App\Livewire\Masyarakat\Agenda;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AgendaController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.agenda-desa.agenda-desa');
    }

}
