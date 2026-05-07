<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KartuKeluargaController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $deleteId;
    public $search = '';

    // Reset pagination saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data kartu keluarga ini akan dihapus.',
            'icon' => 'warning',
            'cancelButtonText' => 'Batal',
            'confirmButtonText' => 'Ya, hapus!',
        ]);
    }

    public function delete()
    {
        DB::table('kartu_keluarga')
            ->where('id_kartu_keluarga', $this->deleteId)
            ->update([
                'is_deleted' => 1,
                'updated_at' => now()
            ]);

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data kartu keluarga berhasil dihapus.',
            'icon' => 'success',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $kartu_keluargaData = DB::table('kartu_keluarga')
            ->leftJoin('penduduk', function ($join) {
                $join->on('kartu_keluarga.id_kartu_keluarga', '=', 'penduduk.id_kartu_keluarga')
                    ->where('penduduk.kedudukan_keluarga', 'KEPALA KELUARGA')
                    ->where('penduduk.is_deleted', 0)
                    ->where('penduduk.is_mutated', 0);
            })
            ->select(
                'kartu_keluarga.*',
                'penduduk.nama_lengkap as nama_kepala_keluarga'
            )
            ->where('kartu_keluarga.is_deleted', 0)

            ->when($this->search, function ($query) {
                $query->where(function ($sub) {
                    $sub->where('kartu_keluarga.nomor_kartu_keluarga', 'like', '%' . $this->search . '%')
                        ->orWhere('kartu_keluarga.alamat_kk', 'like', '%' . $this->search . '%')
                        ->orWhere('penduduk.nama_lengkap', 'like', '%' . $this->search . '%');
                });
            })

            ->orderByDesc('kartu_keluarga.id_kartu_keluarga')
            ->paginate(10);

        return view(
            'admin.kependudukan.kartu-keluarga.index',
            [
                'kartu_keluargaData' => $kartu_keluargaData
            ]
        );
    }
}