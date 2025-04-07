<?php

namespace App\Livewire\Admin\Kependudukan\PendudukSementara;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class PendudukSementaraController extends Component
{
    public $deleteId;
    public $search;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Penduduk Sementara ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('penduduk_sementara')
            ->where('id_penduduk', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Penduduk Sementara berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render(){
        return view('admin.kependudukan.penduduk-sementara.index',
        [
            'pendudukSementaraData' => DB::table('penduduk_sementara')
            ->when($this->search, function ($query) {
                return $query->where(function ($subQuery) {
                    $subQuery->where('nama_lengkap', 'like', '%' . $this->search . '%')
                        ->orWhere('nomor_pengenal', 'like', '%' . $this->search . '%');
                });
            })
            ->where('is_deleted', 0)
            ->paginate(10),
        ]
    );
    }
}