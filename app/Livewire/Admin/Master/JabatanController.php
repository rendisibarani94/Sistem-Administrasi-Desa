<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class JabatanController extends Component
{
    use WithPagination;

    public $jabatan;
    public $jabatanId;
    public $search;
    public $deleteId;

    protected $rules = [
        'jabatan' => 'required|string|max:100',
    ];

    public function store()
    {
        $this->validate();
        DB::table('jabatan')->insert(['jabatan' => $this->jabatan]);
        $this->reset();
        return redirect()->route('jabatan')->with('success', 'Data Jabatan Berhasil Ditambahkan.');
    }

    public function loadEditData($id)
    {
        $jabatan = DB::table('jabatan')->where('id_jabatan', $id)->first();

        if ($jabatan) {
            $this->jabatanId = $jabatan->id_jabatan;
            $this->jabatan = $jabatan->jabatan;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            session()->flash('error', 'Data jabatan tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['jabatanId', 'jabatan']);
    }

    public function resetJabatan()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('jabatan');
    }
    public function edit()
    {
        $this->validate([
            'jabatan' => 'required|string|max:100',
        ]);

        DB::table('jabatan')
            ->where('id_jabatan', $this->jabatanId)
            ->update([
                'jabatan' => $this->jabatan,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();

        return redirect()->route('jabatan')->with('success', 'Data Jabatan Berhasil Diubah.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Jabatan ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('jabatan')
            ->where('id_jabatan', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Jabatan berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.jabatan.index', [
            'jabatanData' => DB::table('jabatan')
                ->when($this->search, function ($query) {
                    return $query->where('jabatan', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_jabatan', 'desc')
                ->paginate(10)
        ]);
    }

}
