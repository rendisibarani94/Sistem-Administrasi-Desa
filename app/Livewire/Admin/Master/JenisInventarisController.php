<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class JenisInventarisController extends Component
{
    use WithPagination;

    public $jenis_inventaris;
    public $jenis_inventarisId;
    public $search;
    public $deleteId;

    protected $rules = [
        'jenis_inventaris' => 'required|string|max:100',
    ];

    public function store()
    {
        $this->validate();
        DB::table('jenis_inventaris')->insert([
            'jenis_inventaris' => $this->jenis_inventaris,
        ]);
        $this->reset();
        return redirect()->route('jenisInventaris')->with('success', 'Data Jenis Inventaris Berhasil Ditambahkan.');
    }


    public function loadJenisInventaris($id)
    {
        $ji = DB::table('jenis_inventaris')->where('id_jenis_inventaris', $id)->first();

        if ($ji) {
            $this->jenis_inventarisId = $ji->id_jenis_inventaris;
            $this->jenis_inventaris = $ji->jenis_inventaris;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            session()->flash('error', 'Data Jenis Inventaris tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['jenis_inventarisId', 'jenis_inventaris']);
    }

    public function resetJenisInventaris()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('jenis_inventaris');
    }
    public function edit()
    {
        $this->validate([
            'jenis_inventaris' => 'required|string|max:100',
        ]);

        DB::table('jenis_inventaris')
            ->where('id_jenis_inventaris', $this->jenis_inventarisId)
            ->update([
                'jenis_inventaris' => $this->jenis_inventaris,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();

        return redirect()->route('jenisInventaris')->with('success', 'Data Jenis Inventaris Berhasil Diubah.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Jenis Inventaris ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }
    public function delete()
    {
        DB::table('jenis_inventaris')
            ->where('id_jenis_inventaris', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Jenis Inventaris berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.jenis-inventaris.index', [
            'jenisInventarisData' => DB::table('jenis_inventaris')
                ->when($this->search, function ($query) {
                    return $query->where('jenis_inventaris', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_jenis_inventaris', 'desc')
                ->paginate(10)
        ]);
    }
}
