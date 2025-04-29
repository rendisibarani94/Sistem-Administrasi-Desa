<?php

namespace App\Livewire\Masyarakat\Pembangunan;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DetailPembangunanController extends Component
{

    #[Layout('Components.layouts.masyarakat')]
    public function render()
    {
        return view('masyarakat.pembangunan.detail-pembangunan');
    }

}
