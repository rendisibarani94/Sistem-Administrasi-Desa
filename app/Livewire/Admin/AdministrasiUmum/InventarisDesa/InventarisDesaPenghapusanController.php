<?php

namespace App\Livewire\Admin\AdministrasiUmum\InventarisDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InventarisDesaPenghapusanController extends Component
{
    use WithPagination;

    public $search;

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.inventaris-desa.penghapusan',
            [
                'inventarisDesaData' => DB::table('inventaris_desa')
                ->where('is_deleted', 1)
                ->orderBy('id_inventaris_desa', 'desc')
                ->paginate(10),
            ]
        );
    }
}