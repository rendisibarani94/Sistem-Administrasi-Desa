<?php

namespace App\Livewire\Masyarakat\Organisasi;

use Livewire\Attributes\Layout;
use Livewire\Component;

class OrganisasiController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.organisasi-desa.organisasi-desa');
    }

}
