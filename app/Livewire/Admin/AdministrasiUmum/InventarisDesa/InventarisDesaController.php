<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InventarisDesaController extends Component
{
    use WithPagination;

    public $search;

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.inventaris-desa.index',
            [
                'inventarisDesaData' => DB::table('inventaris_desa')
                ->where('is_deleted', 0)
                ->orderBy('id_inventaris_desa', 'desc')
                ->paginate(10),
            ]
        );
    }

}
