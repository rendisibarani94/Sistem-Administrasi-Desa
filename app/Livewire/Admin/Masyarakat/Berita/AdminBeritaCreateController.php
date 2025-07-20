<?php

namespace App\Livewire\Admin\Masyarakat\Berita;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class AdminBeritaCreateController extends Component
{
    use WithFileUploads;

    public $existingGambarBerita;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $gambar;

    #[Rule('required', message: 'Kolom Judul Harus Diisi!')]
    #[Rule('max:150', message: 'Input Judul maksimal 150 digit karakter!')]
    public $judul;

    #[Rule('required', message: 'Kolom Deksripsi Harus Diisi!')]
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
            if ($this->existingGambarBerita && Storage::disk('public')->exists($this->existingGambarBerita)) {
                Storage::disk('public')->delete($this->existingGambar);
            }

            // Store new image
            $imagePath = $this->gambar->store('images/berita', 'public');
        }
        $validated['gambar'] = $imagePath ?? null;
        $validated['id_dibuat_oleh'] = auth()->id();
        DB::table('berita')->insert($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.berita')->with('success', 'Data Berita berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.berita-desa.create');
    }
}
