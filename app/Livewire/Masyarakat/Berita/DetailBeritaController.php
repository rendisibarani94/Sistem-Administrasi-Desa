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
            ->join('users', 'berita.id_dibuat_oleh', '=', 'users.id')
            ->where('berita.id_berita', $this->id_berita_detail)
            ->where('berita.is_deleted', 0)
            ->select('berita.*', 'users.name as nama_pembuat')
            ->first();

        return view('masyarakat.berita-desa.detail-berita', ['berita' => $berita]);
    }
}
