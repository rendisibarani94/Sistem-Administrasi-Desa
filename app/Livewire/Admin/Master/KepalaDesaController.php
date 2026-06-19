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
    public $statusChangeId = null;

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

            // ── Validasi: tidak boleh menonaktifkan satu-satunya kepala desa aktif ──
            if ($kd->is_active && !$this->is_active) {
                $adaAktifLain = KepalaDesa::where('is_active', true)
                    ->where('id_kepala_desa', '!=', $this->editingId)
                    ->exists();

                if (!$adaAktifLain) {
                    $this->addError('is_active',
                        'Tidak dapat menonaktifkan kepala desa ini. Harus ada minimal satu kepala desa yang aktif sebagai penandatangan surat.');
                    return;
                }
            }

            // ── Jika diaktifkan, nonaktifkan kepala desa aktif lainnya ──
            if ($this->is_active && !$kd->is_active) {
                KepalaDesa::where('is_active', true)
                    ->where('id_kepala_desa', '!=', $this->editingId)
                    ->update(['is_active' => false]);
            }

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
            // Setiap penambahan baru selalu aktif dan menonaktifkan yang lain
            KepalaDesa::where('is_active', true)->update(['is_active' => false]);

            KepalaDesa::create([
                'nama'      => $this->nama,
                'nip'       => $this->nip ?: null,
                'is_active' => true,
                'file_ttd'  => $ttdPath,
            ]);

            session()->flash('success', 'Data kepala desa baru berhasil ditambahkan dan otomatis diaktifkan.');
        }

        $this->closeModal();
    }

    // ── Konfirmasi Aktifkan (dari tombol "Non Aktif") ──
    public function confirmSetAktif(int $id): void
    {
        $kd = KepalaDesa::findOrFail($id);
        $this->statusChangeId = $id;
        $this->dispatch('swal:confirmAktifkan', [
            'title'             => 'Aktifkan Kepala Desa?',
            'text'              => "Apakah Anda yakin ingin mengaktifkan \"{$kd->nama}\" sebagai kepala desa aktif? Kepala desa yang saat ini aktif akan dinonaktifkan secara otomatis.",
            'icon'              => 'question',
            'confirmButtonText' => 'Ya, Aktifkan!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    // ── Konfirmasi Non-Aktifkan (dari badge "Aktif") ──
    public function confirmNonAktif(int $id): void
    {
        $kd = KepalaDesa::findOrFail($id);

        $this->statusChangeId = $id;
        $this->dispatch('swal:confirmNonAktif', [
            'title'             => 'Nonaktifkan Kepala Desa?',
            'text'              => "Apakah Anda yakin ingin menonaktifkan \"{$kd->nama}\"? Data pengajuan surat yang sudah diproses oleh kepala desa ini tidak akan berubah.",
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Nonaktifkan!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function setAktif(): void
    {
        if (!$this->statusChangeId) return;

        // Nonaktifkan semua lalu aktifkan yang dipilih
        // Catatan: Data surat yang sudah diproses oleh kepala desa sebelumnya
        // tetap menyimpan referensi ke kepala desa lama (id_diproses_oleh)
        // sehingga historis tidak berubah.
        KepalaDesa::where('is_active', true)->update(['is_active' => false]);
        KepalaDesa::findOrFail($this->statusChangeId)->update(['is_active' => true]);
        $this->statusChangeId = null;
        session()->flash('success', 'Kepala desa aktif berhasil diubah. Data pengajuan yang sudah diproses sebelumnya tetap terhubung ke kepala desa lama.');
    }

    public function setNonAktif(): void
    {
        if (!$this->statusChangeId) return;

        // Validasi: tidak boleh menonaktifkan satu-satunya kepala desa aktif
        $adaAktifLain = KepalaDesa::where('is_active', true)
            ->where('id_kepala_desa', '!=', $this->statusChangeId)
            ->exists();

        if (!$adaAktifLain) {
            $this->statusChangeId = null;
            $this->dispatch('swal:error', [
                'title' => 'Tidak Dapat Menonaktifkan',
                'text'  => 'Tidak dapat menonaktifkan kepala desa ini karena harus ada minimal satu kepala desa aktif sebagai penandatangan surat.',
                'icon'  => 'error',
            ]);
            return;
        }

        KepalaDesa::findOrFail($this->statusChangeId)->update(['is_active' => false]);
        $this->statusChangeId = null;
        session()->flash('success', 'Kepala desa berhasil dinonaktifkan.');
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
                // Validasi: tidak boleh hapus kepala desa yang sedang aktif
                // jika tidak ada kepala desa aktif lain
                if ($kd->is_active) {
                    $adaAktifLain = KepalaDesa::where('is_active', true)
                        ->where('id_kepala_desa', '!=', $this->deleteId)
                        ->exists();

                    if (!$adaAktifLain) {
                        $this->deleteId = null;
                        session()->flash('error', 'Tidak dapat menghapus kepala desa aktif. Tetapkan kepala desa lain sebagai aktif terlebih dahulu.');
                        return;
                    }
                }

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
