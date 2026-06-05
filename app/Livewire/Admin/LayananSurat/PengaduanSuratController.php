<?php

namespace App\Livewire\Admin\LayananSurat;

use App\Models\Pengaduan;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PengaduanSuratController extends Component
{
    public $selectedPengaduan = null;
    public $showDetailModal = false;
    public $catatanAdmin = '';

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $query = Pengaduan::with('user.penduduk')->latest();

        if (request('search')) {
            $query->where(function ($sub) {
                $sub->where('judul', 'like', '%' . request('search') . '%')
                    ->orWhere('isi', 'like', '%' . request('search') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('penduduk', function ($qp) {
                                $qp->where('nama_lengkap', 'like', '%' . request('search') . '%')
                                    ->orWhere('nik', 'like', '%' . request('search') . '%');
                            });
                    });
            });
        }

        if (request('status')) {
            if (request('status') === 'terbaca') {
                $query->whereIn('status', ['baru', 'diproses']);
            } else {
                $query->where('status', request('status'));
            }
        }

        // Hitung statistik untuk grid
        $totalPengaduan = Pengaduan::count();
        $totalTerbaca = Pengaduan::whereIn('status', ['baru', 'diproses'])->count();
        $totalDisetujui = Pengaduan::where('status', 'selesai')->count();
        $totalDitolak = Pengaduan::where('status', 'ditolak')->count();

        $pengaduan = $query->get();

        return view('livewire.admin.layanan-surat.pengaduan-surat-controller', compact(
            'pengaduan',
            'totalPengaduan',
            'totalTerbaca',
            'totalDisetujui',
            'totalDitolak'
        ));
    }

    public function showDetail($id)
    {
        $pengaduan = Pengaduan::with('user.penduduk')->find($id);
        if ($pengaduan) {
            $this->selectedPengaduan = $pengaduan;
            $this->catatanAdmin = $pengaduan->catatan_admin ?? '';
            $this->showDetailModal = true;

            // Jika status masih baru/menunggu, tandai sebagai diproses (terbaca)
            if ($pengaduan->status === 'baru') {
                $pengaduan->status = 'diproses';
                $pengaduan->save();
            }
        }
    }

    public function closeDetailModal()
    {
        $this->selectedPengaduan = null;
        $this->showDetailModal = false;
        $this->catatanAdmin = '';
    }

    public function simpanCatatan($status)
    {
        if ($this->selectedPengaduan) {
            $pengaduan = Pengaduan::find($this->selectedPengaduan->id_pengaduan);
            if ($pengaduan) {
                // Guard: jika sudah final (ditolak/selesai), tidak bisa diubah lagi
                if (in_array($pengaduan->status, ['ditolak', 'selesai'])) {
                    session()->flash('success', 'Pengaduan ini sudah diproses dan tidak dapat diubah lagi.');
                    $this->closeDetailModal();
                    return;
                }

                $pengaduan->status = $status;
                $pengaduan->catatan_admin = $this->catatanAdmin;
                $pengaduan->save();

                $label = $status === 'selesai' ? 'disetujui' : 'ditolak';
                session()->flash('success', "Pengaduan berhasil {$label}!");
                $this->closeDetailModal();
            }
        }
    }
}
