<?php

namespace App\Livewire\Masyarakat\Pengumuman;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PengumumanController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.pengumuman.pengumuman');
    }

}
