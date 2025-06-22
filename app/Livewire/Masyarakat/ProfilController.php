<?php

namespace App\Livewire\Masyarakat;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ProfilController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $profil = DB::table('profil')->pluck('value', 'key');


        return view(
            'masyarakat.profil',[
                'profil' => $profil
            ]
    );
    }

}
