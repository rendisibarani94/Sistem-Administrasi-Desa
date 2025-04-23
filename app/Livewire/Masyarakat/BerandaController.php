<?php

namespace App\Livewire\Masyarakat;

use Livewire\Attributes\Layout;
use Livewire\Component;

class BerandaController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.beranda');
    }

}
