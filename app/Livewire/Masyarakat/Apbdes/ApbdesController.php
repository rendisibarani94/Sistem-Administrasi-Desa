<?php

namespace App\Livewire\Masyarakat\Apbdes;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ApbdesController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $apbdes = DB::table('apbdes')
            ->where('is_deleted', 0)
            ->orderBy('tahun_anggaran', 'desc')
            ->get();

        $daftarBerita = DB::table('berita')
            ->join('users', 'berita.id_dibuat_oleh', '=', 'users.id')
            ->where('berita.is_deleted', 0)
            ->select('berita.*', 'users.name as nama_pembuat')
            ->limit(5)
            ->get();

        return view('masyarakat.apbdes.apbdes', [
            'apbdesData' => $apbdes,
            'daftarBerita' => $daftarBerita,
    ]);
    }

}
