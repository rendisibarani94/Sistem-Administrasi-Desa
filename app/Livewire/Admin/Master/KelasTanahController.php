<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KelasTanahController extends Component
{
    use WithPagination;

    public $kelas_tanah;
    public $kelas_tanahId;
    public $search;
    public $deleteId;

    protected $rules = [
        'kelas_tanah' => 'required|string|max:20',
    ];

    public function store()
    {
        $this->validate();
        DB::table('kelas_tanah')->insert([
            'kelas_tanah' => $this->kelas_tanah,
        ]);
        $this->reset();

        return redirect()->route('kelasTanah')->with('success', 'Data Kelas Tanah Berhasil Ditambahkan.');
    }

    public function loadKelasTanah($id)
    {
        $kt = DB::table('kelas_tanah')->where('id_kelas_tanah', $id)->first();

        if ($kt) {
            $this->kelas_tanahId = $kt->id_kelas_tanah;
            $this->kelas_tanah = $kt->kelas_tanah;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            session()->flash('error', 'Data Kelas Tanah tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['kelas_tanahId', 'kelas_tanah']);
    }

    public function resetKelasTanah()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('kelas_tanah');
    }

    public function edit()
    {
        $this->validate([
            'kelas_tanah' => 'required|string|max:20',
        ]);

        DB::table('kelas_tanah')
            ->where('id_kelas_tanah', $this->kelas_tanahId)
            ->update([
                'kelas_tanah' => $this->kelas_tanah,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();

        return redirect()->route('kelasTanah')->with('success', 'Data Kelas Tanah Berhasil Diubah.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Kelas Tanah ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('kelas_tanah')
            ->where('id_kelas_tanah', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Kelas tanah berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.kelas-tanah.index', [
            'kelasTanahData' => DB::table('kelas_tanah')
                ->when($this->search, function ($query) {
                    return $query->where('kelas_tanah', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_kelas_tanah', 'asc')
                ->paginate(10)
        ]);
    }
}
