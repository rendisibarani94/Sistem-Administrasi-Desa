<?php

namespace App\Livewire\Masyarakat\Pembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DetailPembangunanController extends Component
{
    public $id_pembangunan;

    public function mount($id_pembangunan){
        $this->id_pembangunan = $id_pembangunan;
    }

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $pembangunan = DB::table('pembangunan')
            ->where('id_pembangunan', $this->id_pembangunan)
            ->where('is_deleted', 0)
            ->first();

        return view('masyarakat.pembangunan.detail-pembangunan', [
            'pembangunan' => $pembangunan,
        ]);
    }

}
