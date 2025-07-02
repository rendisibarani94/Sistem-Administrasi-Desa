<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KaderPemberdayaanController extends Component
{
    use WithPagination;

    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Kader Pemberdayaan ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('kader_pemberdayaan')
            ->where('id_kader_pemberdayaan', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Kader Pemberdayaan Masyarakat berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.pembangunan.kader-pemberdayaan-masyarakat.index',
            [
                'kaderPemberdayaanData' => DB::table('kader_pemberdayaan')
                ->join('bidang_keahlian', 'kader_pemberdayaan.bidang_keahlian', '=', 'bidang_keahlian.id_bidang_keahlian') // Adjust FK if needed
                ->select('kader_pemberdayaan.*', 'bidang_keahlian.bidang_keahlian') // Select required fields
                ->when($this->search, function ($query) {
                        return $query->where(function ($subQuery) {
                            $subQuery->where('kader_pemberdayaan.nama_lengkap', 'like', '%' . $this->search . '%')
                                ->orWhere('kader_pemberdayaan.jenis_kelamin', 'like', '%' . $this->search . '%')
                                ->orWhere('bidang_keahlian.bidang_keahlian', 'like', '%' . $this->search . '%');
                        });
                    })
                ->where('kader_pemberdayaan.is_deleted', 0)
                ->orderBy('kader_pemberdayaan.id_kader_pemberdayaan', 'desc')
                ->paginate(10),
            ]
        );
    }


}
