<?php

namespace App\Livewire\Masyarakat\Berita;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DetailBeritaController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.berita-desa.detail-berita');
    }

}
