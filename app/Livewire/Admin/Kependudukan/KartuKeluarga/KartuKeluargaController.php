<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KartuKeluargaController extends Component
{
    use WithPagination;

    public $deleteId;
    public $search;

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
        // Perform soft delete by updating is_deleted to 1
        DB::table('kartu_keluarga')
            ->where('id_kartu_keluarga', $this->deleteId)
            ->update(['is_deleted' => 1, 'updated_at' => now()]);

        // Show success message
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
            ->select('kartu_keluarga.*', 'penduduk.nama_lengkap as nama_kepala_keluarga')
            ->leftJoin('penduduk', function ($join) {
                $join->on('kartu_keluarga.id_kartu_keluarga', '=', 'penduduk.id_kartu_keluarga')
                    ->where('penduduk.kedudukan_keluarga', '=', 'KEPALA KELUARGA');
            })
            ->when($this->search, function ($query) {
                return $query->where(function ($subQuery) {
                    $subQuery->where('kartu_keluarga.nomor_kartu_keluarga', 'like', '%' . $this->search . '%')
                        ->orWhere('kartu_keluarga.alamat_kk', 'like', '%' . $this->search . '%')
                        ->orWhereExists(function ($existsQuery) {
                            $existsQuery->select(DB::raw(1))
                                ->from('penduduk')
                                ->whereColumn('penduduk.id_kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga')
                                ->where('penduduk.kedudukan_keluarga', 'KEPALA KELUARGA')
                                ->where('penduduk.nama_lengkap', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->where('kartu_keluarga.is_deleted', 0)
            ->paginate(10);

        return view(
            'admin.kependudukan.kartu-keluarga.index',
            ['kartu_keluargaData' => $kartu_keluargaData]
        );
    }
}
