<?php

namespace App\Livewire\Admin\LayananSurat;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class NotifikasiSuratController extends Component
{
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        // Get all notifications for admin
        $notifikasi = $isAdmin 
            ? Notifikasi::with('user')->latest()->paginate(20)
            : $user->notifikasi()->latest()->paginate(20);

        // Get new request surat (status diajukan)
        $newRequests = PengajuanSurat::with(['jenisSurat', 'penduduk'])
            ->where('status', 'diajukan')
            ->latest()
            ->get();

        // Get new pengaduan (status baru)
        $newPengaduan = Pengaduan::with('user')
            ->where('status', 'baru')
            ->latest()
            ->get();

        // Get counts
        $countNewRequests = $newRequests->count();
        $countNewPengaduan = $newPengaduan->count();
        $countNotifications = Notifikasi::where('is_read', false)
            ->when($isAdmin, fn($q) => $q->where('user_id', $user->id))
            ->count();

        return view('livewire.admin.layanan-surat.notification-center', compact(
            'notifikasi',
            'newRequests',
            'newPengaduan',
            'countNewRequests',
            'countNewPengaduan',
            'countNotifications',
            'isAdmin'
        ));
    }
}
