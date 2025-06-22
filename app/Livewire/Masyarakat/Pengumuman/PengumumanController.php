<?php

namespace App\Livewire\Masyarakat\Pengumuman;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $pengumuman = DB::table('pengumuman')
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('masyarakat.pengumuman.pengumuman', [
            'pengumumanData' => $pengumuman,
        ]);
    }

}
