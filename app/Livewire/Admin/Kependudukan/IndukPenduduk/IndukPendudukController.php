<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IndukPendudukController extends Component
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

    public function mutasi($id_penduduk)
    {

        $penduduk = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('id_penduduk', $id_penduduk)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->first();

        $familyCardId = DB::table('penduduk')->where('id_penduduk', $id_penduduk)->value('id_kartu_keluarga');


        // 1. Check if he is a non-deleted Head
        $isHead = DB::table('penduduk')
            ->where('id_penduduk', $id_penduduk)
            ->where('is_deleted', 0)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->exists();

        // 2. Check if he is the only one in his family
        $isOnlyMember = DB::table('penduduk')
            ->where('id_kartu_keluarga', $familyCardId) // Get this from the first query if needed
            ->where('is_deleted', 0)
            ->count() == 1; // Only 1 member left?

        $isLoneHead = $isHead && $isOnlyMember;

        if ($isLoneHead) {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
        if ($penduduk) {
            return $this->redirect(route('indukPenduduk.mutasi.kepala-keluarga', ['id' => $id_penduduk]));
        } else {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.induk-penduduk.index',
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
                    ->where('is_deleted', 0)
                    ->where('is_mutated', 0)
                    // ->whereNull('tanggal_pengurangan')
                    ->paginate(10)
            ]
        );
    }
}
