<?php

namespace App\Livewire\Masyarakat\Pembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PembangunanController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $pembangunan = DB::table('pembangunan')
        ->where('is_deleted', 0)
        ->orderBy('id_pembangunan', 'desc')
        ->paginate(5);

        return view('masyarakat.pembangunan.pembangunan', [
            'pembangunan' => $pembangunan,
            ]);
    }

}
