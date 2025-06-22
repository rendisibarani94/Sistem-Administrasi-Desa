<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\InventarisHasilPembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InventarisHasilPembangunanController extends Component
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
            'admin.pembangunan.inventaris-hasil-pembangunan.index',
            [
                'pembangunanData' => DB::table('pembangunan')
                ->where('is_deleted', 0)
                ->where('status_pengerjaan', 'Selesai')
                ->orderBy('id_pembangunan', 'desc')
                ->paginate(10),
            ]
        );
    }

}
