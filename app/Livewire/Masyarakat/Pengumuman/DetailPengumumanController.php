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
            ->where('id_pengumuman', $this->id_pengumuman)
            ->where('is_deleted', 0)
            ->first();

        return view('masyarakat.pengumuman.detail-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }

}
