<?php

namespace App\Livewire\Admin\Masyarakat\Berita;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AdminBeritaEditController extends Component
{
    use WithFileUploads;

    public $id_berita;

    public $existingGambarBerita;

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

    public function mount($id_berita)
    {
        $this->id_berita = $id_berita;
        $this->loadBerita();
    }

    public function loadBerita()
    {
        $berita = DB::table('berita')->where('id_berita', $this->id_berita)->first();

        $this->existingGambarBerita = $berita->gambar;
        $this->judul = $berita->judul;
        $this->deskripsi = $berita->deskripsi;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        if ($this->gambar) {
            // Delete old image if exists
            if ($this->existingGambarBerita && Storage::disk('public')->exists($this->existingGambarBerita)) {
                Storage::disk('public')->delete($this->existingGambarBerita);
            }

            // Store new image
            $imagePath = $this->gambar->store('images/berita', 'public');
        }
        // If no new image is uploaded, keep the existing image
        $validated['gambar'] = $imagePath ?? $this->existingGambarBerita ?? null; // Use existing image if no new image is uploaded
        $validated['id_dibuat_oleh'] = auth()->id();
        DB::table('berita')->where('id_berita', $this->id_berita)->update($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.berita')->with('success', 'Data Berita berhasil diubah!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.berita-desa.edit');
    }
}
