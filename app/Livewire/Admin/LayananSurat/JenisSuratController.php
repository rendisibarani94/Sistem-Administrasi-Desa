<?php

namespace App\Livewire\Admin\LayananSurat;

use App\Models\JenisSurat;
use App\Models\PersyaratanSurat;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class JenisSuratController extends Component
{
    use WithPagination;

    // ── State: Daftar & Search ─────────────────────────────────
    public string $search = '';

    // ── State: Form Jenis Surat ────────────────────────────────
    public ?int $editingId = null;
    public string $nama_surat   = '';
    public string $deskripsi    = '';
    public string $body_template = '';
    public bool   $is_active    = true;
    public bool   $showModal    = false;

    // ── State: Persyaratan (field dinamis) ─────────────────────
    // Format: [['nama_field' => '...', 'tipe_field' => 'text', 'is_required' => true], ...]
    public array $persyaratan = [];

    // ── State: Konfirmasi hapus ────────────────────────────────
    public ?int $deleteId = null;

    protected function rules(): array
    {
        $uniqueRule = $this->editingId
            ? 'required|string|max:255|unique:jenis_surat,nama_surat,' . $this->editingId . ',id_jenis_surat'
            : 'required|string|max:255|unique:jenis_surat,nama_surat';

        return [
            'nama_surat'                      => $uniqueRule,
            'deskripsi'                       => 'nullable|string',
            'body_template'                   => 'nullable|string',
            'is_active'                       => 'boolean',
            'persyaratan'                     => 'array',
            'persyaratan.*.nama_field'        => 'required|string|max:255',
            'persyaratan.*.tipe_field'        => 'required|in:text,number,date,file_image',
            'persyaratan.*.is_required'       => 'boolean',
        ];
    }

    protected array $messages = [
        'nama_surat.required'                    => 'Nama surat wajib diisi.',
        'persyaratan.*.nama_field.required'      => 'Nama field persyaratan wajib diisi.',
        'persyaratan.*.tipe_field.in'            => 'Tipe field tidak valid.',
    ];

    // ─────────────────────────────────────────────────────────
    //  BUKA/TUTUP MODAL
    // ─────────────────────────────────────────────────────────

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $jenisSurat = JenisSurat::withTrashed()->findOrFail($id);
        $this->editingId  = $jenisSurat->id_jenis_surat;
        $this->nama_surat = $jenisSurat->nama_surat;
        $this->deskripsi  = $jenisSurat->deskripsi ?? '';
        $this->body_template = $jenisSurat->body_template ?? '';
        $this->is_active  = (bool) $jenisSurat->is_active;

        // Muat persyaratan yang sudah ada
        $this->persyaratan = PersyaratanSurat::where('jenis_surat_id', $id)
            ->get()
            ->map(fn($p) => [
                'id'          => $p->id,
                'nama_field'  => $p->nama_field,
                'tipe_field'  => $p->tipe_field,
                'is_required' => (bool) $p->is_required,
            ])
            ->toArray();

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->resetForm();
        $this->showModal = false;
    }

    // ─────────────────────────────────────────────────────────
    //  MANAJEMEN FIELD PERSYARATAN (di dalam modal)
    // ─────────────────────────────────────────────────────────

    public function tambahField(): void
    {
        $this->persyaratan[] = [
            'id'          => null,
            'nama_field'  => '',
            'tipe_field'  => 'text',
            'is_required' => true,
        ];
    }

    public function hapusField(int $index): void
    {
        array_splice($this->persyaratan, $index, 1);
        $this->persyaratan = array_values($this->persyaratan);
    }

    // ─────────────────────────────────────────────────────────
    //  SIMPAN (Create / Update)
    // ─────────────────────────────────────────────────────────

    public function simpan(): void
    {
        $this->validate();

        DB::transaction(function () {
            if ($this->editingId) {
                // --- UPDATE ---
                $jenisSurat = JenisSurat::findOrFail($this->editingId);
                $jenisSurat->update([
                    'nama_surat'    => $this->nama_surat,
                    'deskripsi'     => $this->deskripsi ?: null,
                    'body_template' => $this->body_template ?: null,
                    'is_active'     => $this->is_active,
                ]);

                // Hapus persyaratan lama, lalu insert ulang
                PersyaratanSurat::where('jenis_surat_id', $this->editingId)->delete();
            } else {
                // --- CREATE ---
                $jenisSurat = JenisSurat::create([
                    'nama_surat'    => $this->nama_surat,
                    'deskripsi'     => $this->deskripsi ?: null,
                    'body_template' => $this->body_template ?: null,
                    'is_active'     => $this->is_active,
                ]);
            }

            // Insert persyaratan baru
            foreach ($this->persyaratan as $field) {
                PersyaratanSurat::create([
                    'jenis_surat_id' => $jenisSurat->id_jenis_surat,
                    'nama_field'     => $field['nama_field'],
                    'tipe_field'     => $field['tipe_field'],
                    'is_required'    => $field['is_required'] ?? true,
                ]);
            }
        });

        $pesan = $this->editingId
            ? "Jenis surat '{$this->nama_surat}' berhasil diperbarui."
            : "Jenis surat '{$this->nama_surat}' berhasil ditambahkan.";

        $this->closeModal();
        session()->flash('success', $pesan);
    }

    // ─────────────────────────────────────────────────────────
    //  TOGGLE AKTIF / NONAKTIF
    // ─────────────────────────────────────────────────────────

    public function toggleAktif(int $id): void
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->update(['is_active' => !$jenisSurat->is_active]);

        $status = $jenisSurat->fresh()->is_active ? 'diaktifkan' : 'dinonaktifkan';
        session()->flash('success', "Jenis surat berhasil {$status}.");
    }

    // ─────────────────────────────────────────────────────────
    //  HAPUS
    // ─────────────────────────────────────────────────────────

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
        $this->dispatch('swal:confirm', [
            'title'             => 'Hapus Jenis Surat?',
            'text'              => 'Semua persyaratan / field terkait juga akan ikut terhapus. Aksi ini tidak dapat dibatalkan.',
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Hapus!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function delete(): void
    {
        if (!$this->deleteId) return;

        DB::transaction(function () {
            PersyaratanSurat::where('jenis_surat_id', $this->deleteId)->delete();
            JenisSurat::findOrFail($this->deleteId)->delete();
        });

        $this->deleteId = null;
        session()->flash('success', 'Jenis surat berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────
    //  HELPERS
    // ─────────────────────────────────────────────────────────

    private function resetForm(): void
    {
        $this->editingId  = null;
        $this->nama_surat = '';
        $this->deskripsi  = '';
        $this->body_template = '';
        $this->is_active  = true;
        $this->persyaratan = [];
        $this->resetValidation();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    // ─────────────────────────────────────────────────────────
    //  RENDER
    // ─────────────────────────────────────────────────────────

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $jenisSuratList = JenisSurat::withCount('persyaratanSurat')
            ->when($this->search, fn($q) =>
                $q->where('nama_surat', 'like', '%' . $this->search . '%')
            )
            ->orderByDesc('id_jenis_surat')
            ->paginate(10);

        return view('livewire.admin.layanan-surat.jenis-surat', [
            'jenisSuratList' => $jenisSuratList,
            'tipeOptions'    => [
                'text'       => 'Teks',
                'number'     => 'Angka',
                'date'       => 'Tanggal',
                'file_image' => 'Foto / File',
            ],
        ]);
    }
}
