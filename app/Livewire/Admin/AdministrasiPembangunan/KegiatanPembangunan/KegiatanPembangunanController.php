<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KegiatanPembangunanController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Rencana Keagiatan ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('pembangunan')
            ->where('id_pembangunan', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Rencana Kegiatan Pembangunan berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.pembangunan.rencana-kegiatan-pembangunan.index',
            [
                'pembangunanData' => DB::table('pembangunan')
                                ->when($this->search, function ($query) {
                    return $query->where(function ($subQuery) {
                        $subQuery->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                            ->orWhere('pelaksana', 'like', '%' . $this->search . '%')
                            ->orWhere('sifat_proyek', 'like', '%' . $this->search . '%')
                            ->orWhere('status_pengerjaan', 'like', '%' . $this->search . '%');
                    });
                })
                ->where('status_pengerjaan', '!=' , 'Selesai')
                ->where('is_deleted', 0)
                ->orderBy('id_pembangunan', 'desc')
                ->paginate(10),
            ]
        );
    }

}
