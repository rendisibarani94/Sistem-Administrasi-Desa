<?php

namespace App\Livewire\Masyarakat\Pengumuman;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DetailPengumumanController extends Component
{
    public $id_pengumuman;

    public function mount($id_pengumuman)
    {
        $this->id_pengumuman = $id_pengumuman;
    }

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $pengumuman = DB::table('pengumuman')
            ->join('users', 'pengumuman.id_dibuat_oleh', '=', 'users.id')
            ->where('pengumuman.id_pengumuman', $this->id_pengumuman)
            ->where('pengumuman.is_deleted', 0)
            ->select('pengumuman.*', 'users.name as nama_pembuat')
            ->first();
            
        $daftarBerita = DB::table('berita')
            ->join('users', 'berita.id_dibuat_oleh', '=', 'users.id')
            ->where('berita.is_deleted', 0)
            ->select('berita.*', 'users.name as nama_pembuat')
            ->limit(5)
            ->get();

        return view('masyarakat.pengumuman.detail-pengumuman', [
            'pengumuman' => $pengumuman,
            'daftarBerita' => $daftarBerita,
        ]);
    }
}
