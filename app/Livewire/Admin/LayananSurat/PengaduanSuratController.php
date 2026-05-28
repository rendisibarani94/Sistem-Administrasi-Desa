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

        $pengaduan = $query->get();

        return view('livewire.admin.layanan-surat.pengaduan-surat-controller', compact('pengaduan'));
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
                $pengaduan->status = $status;
                $pengaduan->catatan_admin = $this->catatanAdmin;
                $pengaduan->save();

                session()->flash('success', 'Status pengaduan berhasil diperbarui!');
                $this->closeDetailModal();
            }
        }
    }
}
