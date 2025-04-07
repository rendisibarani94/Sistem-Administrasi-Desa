<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class PekerjaanController extends Component
{
    use WithPagination;

    // Form Variable
    public $pekerjaan;

    // Edit
    public $pekerjaanId;

    // Delete
    public $deleteId;

    // Search variable
    public $search;
    public $sortField = '';
    public $sortDirection = 'desc';

    protected $rules = [
        'pekerjaan' => 'required|string|max:50',
    ];

    public function store()
    {
        $this->validate();
        DB::table('pekerjaan')->insert([
            'pekerjaan' => $this->pekerjaan,
        ]);
        $this->reset();
        return redirect()->route('pekerjaan')->with('success', 'Data Pekerjaan Berhasil Ditambahkan.');
    }

    public function loadPekerjaan($id)
    {
        $pekerjaan = DB::table('pekerjaan')->where('id_pekerjaan', $id)->first();

        if ($pekerjaan) {
            $this->pekerjaanId = $pekerjaan->id_pekerjaan;
            $this->pekerjaan = $pekerjaan->pekerjaan;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            return redirect()->route('pekerjaan')->with('error', 'Data pekerjaan tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['pekerjaanId', 'pekerjaan']);
    }

    public function resetPekerjaan()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('pekerjaan');
    }

    public function edit()
    {
        $this->validate([
            'pekerjaan' => 'required|string|max:50',
        ]);

        DB::table('pekerjaan')
            ->where('id_pekerjaan', $this->pekerjaanId)
            ->update([
                'pekerjaan' => $this->pekerjaan,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();

        return redirect()->route('pekerjaan')->with('success', 'Data pekerjaan berhasil diperbarui.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Pekerjaan ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('pekerjaan')
            ->where('id_pekerjaan', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Pekerjaan berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.pekerjaan.index', [
            'pekerjaanData' => DB::table('pekerjaan')
                ->when($this->search, function ($query) {
                    return $query->where('pekerjaan', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_pekerjaan', 'desc')
                ->paginate(10)
        ]);
    }
}
