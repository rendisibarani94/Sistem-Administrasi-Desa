<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IndukPendudukPindahController extends Component
{
    use WithPagination;

    public $deleteId;
    public $search;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data penduduk ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('penduduk')
            ->where('id_penduduk', $this->deleteId)
            ->update(['is_deleted' => 1, 'updated_at' => now()]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data penduduk berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.induk-penduduk.pindah',
            [
                'pendudukData' => DB::table('penduduk')
                    ->when($this->search, function ($query) {
                        return $query->where(function ($subQuery) {
                            $subQuery->where('nama_lengkap', 'like', '%' . $this->search . '%')
                                ->orWhere('nik', 'like', '%' . $this->search . '%')
                                ->orWhere('alamat', 'like', '%' . $this->search . '%')
                                ->orWhere('status_perkawinan', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->where([
                        ['is_deleted', '=', 0],
                        ['is_mutated', '=', 1],
                    ])
                    // ->whereNull('tanggal_pengurangan')
                    ->paginate(10)
            ]
        );
    }
}
