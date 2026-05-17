<?php

namespace App\Livewire\Admin\LayananSurat;

use App\Models\Pengaduan;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PengaduanSuratController extends Component
{
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $query = Pengaduan::with('user')->latest();

        if (request('search')) {
            $query->where(function ($sub) {
                $sub->where('judul', 'like', '%' . request('search') . '%')
                    ->orWhere('isi', 'like', '%' . request('search') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%');
                    });
            });
        }

        $pengaduan = $query->get();

        return view('livewire.admin.layanan-surat.pengaduan-surat-controller', compact('pengaduan'));
    }
}
