<?php

namespace App\Livewire\Admin\Master;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BidangKeahlianController extends Component
{
    use WithPagination;

    public $bidang_keahlian;
    public $bidangKeahlianId;
    public $search;
    public $deleteId;


    protected $rules = [
        'bidang_keahlian' => 'required|string|max:100',
    ];

    public function store()
    {
        $this->validate();
        DB::table('bidang_keahlian')->insert([
            'bidang_keahlian' => $this->bidang_keahlian,
        ]);
        $this->reset();
        return redirect()->route('bidang_keahlian')->with('success', 'Data Bidang Keahlian Berhasil Ditambahkan.');
    }

    public function loadDusun($id)
    {
        $bk = DB::table('bidang_keahlian')->where('id_bidang_keahlian', $id)->first();

        if ($bk) {
            $this->bidangKeahlianId = $bk->id_bidang_keahlian;
            $this->bidang_keahlian = $bk->bidang_keahlian;
            // Use dispatch() to trigger browser event
            $this->dispatch('show-edit-modal');
        } else {
            session()->flash('error', 'Data Bidang Keahlian tidak ditemukan.');
        }
    }

    public function hideEditModal()
    {
        $this->reset(['bidangKeahlianId', 'bidang_keahlian']);
    }

    public function resetBidangKeahlian()
    {
        $this->dispatch('hide-edit-modal');
        $this->reset('bidang_keahlian');
    }

    public function edit()
    {
        $this->validate([
            'bidang_keahlian' => 'required|string|max:100',
        ]);

        DB::table('bidang_keahlian')
            ->where('id_bidang_keahlian', $this->bidangKeahlianId)
            ->update([
                'bidang_keahlian' => $this->bidangKeahlianId,
            ]);

        $this->dispatch('hide-edit-modal');
        $this->hideEditModal();
        // session()->flash('success', 'Data Dusun Berhasil Diubah.');

        return redirect()->route('bidang_keahlian')->with('success', 'Data Bidang Keahlian Berhasil Diubah.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Bidang Keahlian ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }
    
    public function delete()
    {
        DB::table('bidang_keahlian')
            ->where('id_bidang_keahlian', $this->deleteId)
            ->update(['is_deleted' => 1]);
        
        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Bidang Keahlian berhasil dihapus.',
        ]);
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.master.bidang-keahlian.index', [
            'bidangKeahlianData' => DB::table('bidang_keahlian')
                ->when($this->search, function ($query) {
                    return $query->where('bidang_keahlian', 'like', '%' . $this->search . '%');
                })
                ->where('is_deleted', 0)
                ->orderBy('id_bidang_keahlian', 'desc')
                ->paginate(10)
        ]);
    }
}