<?php

namespace App\Livewire\Masyarakat\Berita;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BeritaController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $berita = DB::table('berita')
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('masyarakat.berita-desa.berita', [
            'beritaData' => $berita,
        ]);
    }

}
