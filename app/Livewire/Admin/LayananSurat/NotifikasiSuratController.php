<?php

namespace App\Livewire\Admin\LayananSurat;

use Livewire\Component;
use Livewire\Attributes\Layout;

class NotifikasiSuratController extends Component
{
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('livewire.admin.layanan-surat.notifikasi-surat-controller');
    }
}
