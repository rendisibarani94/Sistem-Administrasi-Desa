<?php
namespace App\Livewire\Admin\AdministrasiUmum\TanahKasDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class TanahKasDesaController extends Component
{
    use WithPagination;
    
    public $search;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Tanah Kas Desa ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('tanah_kas_desa')
            ->where('id_tkd', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Tanah Kas Desa berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.tanah-kas-desa.index',
            [
                'tanahKasDesaData' => DB::table('tanah_kas_desa')
                ->join('kelas_tanah', 'tanah_kas_desa.kelas', '=', 'kelas_tanah.id_kelas_tanah') 
                ->select('tanah_kas_desa.*', 'kelas_tanah.kelas_tanah')
                ->when($this->search, function ($query) {
                    return $query->where(function ($subQuery) {
                        $subQuery->where('letter_c', 'like', '%' . $this->search . '%')
                            ->orWhere('persil', 'like', '%' . $this->search . '%')
                            ->orWhere('kelas_tanah', 'like', '%' . $this->search . '%');
                    });
                })
                ->where('tanah_kas_desa.is_deleted', 0)
                ->orderBy('tanah_kas_desa.id_tkd', 'desc')
                ->paginate(10),
            ]
        );
    }
}