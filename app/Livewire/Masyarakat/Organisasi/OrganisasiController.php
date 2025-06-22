<?php

namespace App\Livewire\Masyarakat\Organisasi;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrganisasiController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $organisasiDesa = DB::table('organisasi')
            ->where('is_deleted', 0)
            ->get();


        return view('masyarakat.organisasi-desa.organisasi-desa',
            ['organisasiDesa' => $organisasiDesa]
        );
    }

}
