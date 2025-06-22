<?php

namespace App\Livewire\Admin\Masyarakat\Pengumuman;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class AdminPengumumanCreateController extends Component
{
    use WithFileUploads;

    public $existingGambarPengumuman;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $gambar;

    #[Rule('required', message: 'Kolom Judul Harus Diisi!')]
    #[Rule('max:255', message: 'Input Judul maksimal 255 karakter!')]
    public $judul;

    #[Rule('required', message: 'Kolom Deksripsi Harus Diisi!')]
    #[Rule('max:255', message: 'Input Deksripsi maksimal 255 karakter!')]
    public $deskripsi;

    public $oldGambar;

        public function updatedGambar()
    {
        // Clean up previous file if exists
        if ($this->oldGambar) {
            cleanup_livewire_temp_files($this->oldGambar);
        }

        // Store reference to current file
        $this->oldGambar = $this->gambar;
    }

    public function store()
    {
        $validated = $this->validate();

        if ($this->gambar) {
            // Delete old image if exists
            if ($this->existingGambarPengumuman && Storage::disk('public')->exists($this->existingGambarPengumuman)) {
                Storage::disk('public')->delete($this->existingGambarPengumuman);
            }

            // Store new image
            $imagePath = $this->gambar->store('images/pengumuman', 'public');
        }
        $validated['gambar'] = $imagePath ?? null;
        DB::table('pengumuman')->insert($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.pengumuman')->with('success', 'Data Pengumuman berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.pengumuman.create');
    }
}
