<?php

namespace App\Livewire\Masyarakat\Berita;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetailBeritaController extends Component
{
    public $id_berita_detail;

    public function mount($id_berita)
    {
        $this->id_berita_detail = $id_berita; // Store the ID for use in the render method
    }

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $berita = DB::table('berita')
            ->where('id_berita', $this->id_berita_detail) // $id is the specific ID you're looking for
            ->where('is_deleted', 0)
            ->first();

        return view('masyarakat.berita-desa.detail-berita', ['berita' => $berita]);
    }

}
