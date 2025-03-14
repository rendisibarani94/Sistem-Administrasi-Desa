<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class DusunController extends Component
{
    use WithPagination;

    public $dusun;
    public $dusunId;
    public $search;
    public $deleteDusunId;


    protected $rules = [
        'dusun' => 'required|string|max:100',
    ];

    public function store()
    {
        $this->validate();
        DB::table('dusun')->insert([
            'dusun' => $this->dusun,
        ]);
        $this->reset();
        return redirect()->route('dusun')->with('success', 'Data Dusun Berhasil Ditambahkan.');
    }

    public function loadDusun($id)
    {
        $dusun = DB::table('dusun')->where('id_dusun', $id)->first();

        if ($dusun) {
            $this->dusunId = $dusun->id_dusun;
            $this->dusun = $dusun->dusun;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            session()->flash('error', 'Data dusun tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['dusunId', 'dusun']);
    }

    public function resetDusun()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('dusun');
    }

    public function edit()
    {
        $this->validate([
            'dusun' => 'required|string|max:100',
        ]);

        DB::table('dusun')
            ->where('id_dusun', $this->dusunId)
            ->update([
                'dusun' => $this->dusun,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();
        // session()->flash('success', 'Data Dusun Berhasil Diubah.');

        return redirect()->route('dusun')->with('success', 'Data Dusun Berhasil Diubah.');
    }

    public function confirmDelete($id)
    {
        $this->deleteDusunId = $id;
    }

    public function hideDeleteModal()
    {
        $this->deleteDusunId = null;
    }

    public function delete()
    {
        if ($this->deleteDusunId) {
            DB::table('dusun')->where('id_dusun', $this->deleteDusunId)->update([
                'is_deleted' => 1,
            ]);
        }
        $this->hideDeleteModal();
        redirect()->route('dusun')->with('success', 'Data dusun berhasil dihapus.');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.dusun.index', [
            'dusunData' => DB::table('dusun')
                ->when($this->search, function ($query) {
                    return $query->where('dusun', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_dusun', 'desc')
                ->paginate(10)
        ]);
    }
}
