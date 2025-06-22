<?php

namespace App\Livewire\Masyarakat\Organisasi;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailOrganisasiController extends Component
{
    public $id_organisasi;

    public function mount($id_organisasi)
    {
        $this->id_organisasi = $id_organisasi;
    }

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $organisasiDesa = DB::table('organisasi')
            ->where('id_organisasi', $this->id_organisasi)
            ->where('is_deleted', 0)
            ->first();

        return view(
            'masyarakat.organisasi-desa.detail-organisasi-desa',
            ['organisasiDesa' => $organisasiDesa]
        );
    }

}
