<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IndukPendudukController extends Component
{
    use WithPagination;

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.Induk-Penduduk.index');
    }
}