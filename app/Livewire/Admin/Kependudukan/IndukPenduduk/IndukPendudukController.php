<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IndukPendudukController extends Component
{
    use WithPagination;

    public $deletePendudukId;

    public function confirmDelete($id)
    {
        $this->deletePendudukId = $id;
    }

    public function hideDeleteModal()
    {
        $this->deletePendudukId = null;
    }

    public function delete()
    {
        if ($this->deletePendudukId) {
            DB::table('penduduk')->where('id_penduduk', $this->deletePendudukId)->update([
                'is_deleted' => 1,
            ]);
        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Dihapus');  
        }
        $this->hideDeleteModal();
        redirect()->route('indukPenduduk')->with('error', 'Data Induk Penduduk Tidak Ditemukan');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.Induk-Penduduk.index',
            [
                'pendudukData' => DB::table('penduduk')->where('is_deleted', 0)->get(),
            ]
        );
    }
}
