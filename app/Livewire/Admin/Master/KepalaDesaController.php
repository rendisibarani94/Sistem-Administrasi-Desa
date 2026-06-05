<?php

namespace App\Livewire\Admin\Master;

use App\Models\KepalaDesa;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KepalaDesaController extends Component
{
    use WithFileUploads;

    // Form fields
    public $nama = '';
    public $nip = '';
    public $file_ttd;
    public $is_active = true;

    // State
    public $editingId = null;
    public $showModal = false;
    public $deleteId = null;

    protected function rules(): array
    {
        $hasExistingTtd = false;
        if ($this->editingId) {
            $hasExistingTtd = (bool) KepalaDesa::where('id_kepala_desa', $this->editingId)->value('file_ttd');
        }

        return [
            'nama'      => 'required|string|max:150',
            'nip'       => 'required|string|size:18',
            'file_ttd'  => $hasExistingTtd ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'is_active' => 'boolean',
        ];
    }

    protected $messages = [
        'nama.required'     => 'Nama kepala desa wajib diisi.',
        'nip.required'      => 'NIP wajib diisi.',
        'nip.size'          => 'NIP harus 18 digit.',
        'file_ttd.required' => 'Gambar tanda tangan wajib diisi.',
        'file_ttd.image'    => 'File tanda tangan harus berupa gambar.',
        'file_ttd.max'      => 'Ukuran gambar maksimal 2MB.',
    ];

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $list = KepalaDesa::orderByDesc('is_active')->orderByDesc('id_kepala_desa')->get();
        return view('livewire.admin.master.kepala-desa', compact('list'));
    }

    public function openCreateModal(): void
    {
        $this->reset(['nama', 'nip', 'file_ttd', 'is_active', 'editingId']);
        $this->is_active = true;
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $kd = KepalaDesa::findOrFail($id);
        $this->editingId = $id;
        $this->nama      = $kd->nama;
        $this->nip       = $kd->nip ?? '';
        $this->is_active = $kd->is_active;
        $this->file_ttd  = null; // reset, upload ulang jika ingin ganti
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['nama', 'nip', 'file_ttd', 'is_active', 'editingId']);
    }

    public function simpan(): void
    {
        $this->validate();

        // Upload file TTD jika ada
        $ttdPath = null;
        if ($this->file_ttd) {
            $ttdPath = $this->file_ttd->store('kepala-desa', 'public');
        }

        if ($this->editingId) {
            // Update
            $kd = KepalaDesa::findOrFail($this->editingId);

            // Hapus TTD lama jika upload baru
            if ($ttdPath && $kd->file_ttd) {
                Storage::disk('public')->delete($kd->file_ttd);
            }

            $kd->update([
                'nama'      => $this->nama,
                'nip'       => $this->nip ?: null,
                'is_active' => $this->is_active,
                'file_ttd'  => $ttdPath ?? $kd->file_ttd,
            ]);

            session()->flash('success', 'Data kepala desa berhasil diperbarui.');
        } else {
            // Jika set aktif, nonaktifkan yang lain
            if ($this->is_active) {
                KepalaDesa::where('is_active', true)->update(['is_active' => false]);
            }

            KepalaDesa::create([
                'nama'      => $this->nama,
                'nip'       => $this->nip ?: null,
                'is_active' => $this->is_active,
                'file_ttd'  => $ttdPath,
            ]);

            session()->flash('success', 'Data kepala desa berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function setAktif(int $id): void
    {
        // Nonaktifkan semua lalu aktifkan yang dipilih
        KepalaDesa::where('is_active', true)->update(['is_active' => false]);
        KepalaDesa::findOrFail($id)->update(['is_active' => true]);
        session()->flash('success', 'Kepala desa aktif berhasil diubah.');
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
        $this->dispatch('swal:confirm', [
            'title'             => 'Hapus Data Kepala Desa?',
            'text'              => 'Data ini akan dihapus permanen dan tidak dapat dikembalikan.',
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Hapus!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function delete(): void
    {
        if ($this->deleteId) {
            $kd = KepalaDesa::find($this->deleteId);
            if ($kd) {
                if ($kd->file_ttd) {
                    Storage::disk('public')->delete($kd->file_ttd);
                }
                $kd->delete();
            }
            $this->deleteId = null;
            session()->flash('success', 'Data kepala desa berhasil dihapus.');
        }
    }
}
