<?php

namespace App\Livewire\Admin\Masyarakat\Pengumuman;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AdminPengumumanEditController extends Component
{
    use WithFileUploads;

    public $id_pengumuman;

    public $existingGambarPengumuman;

    public $gambar;

    #[Rule('required', message: 'Kolom Judul Harus Diisi!')]
    #[Rule('max:255', message: 'Input Judul maksimal 255 karakter!')]
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

    public function mount($id_pengumuman)
    {
        $this->id_pengumuman = $id_pengumuman;
        $this->loadPengumuman();
    }

    public function loadPengumuman()
    {
        $pengumuman = DB::table('pengumuman')->where('id_pengumuman', $this->id_pengumuman)->first();

        $this->existingGambarPengumuman = $pengumuman->gambar;
        $this->judul = $pengumuman->judul;
        $this->deskripsi = $pengumuman->deskripsi;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();


        if ($this->gambar) {
            // Delete old image if exists
            if ($this->existingGambarPengumuman && Storage::disk('public')->exists($this->existingGambarPengumuman)) {
                Storage::disk('public')->delete($this->existingGambarPengumuman);
            }

            // Store new image
            $imagePath = $this->gambar->store('images/pengumuman', 'public');
        }
        // If no new image is uploaded, keep the existing image
        $validated['gambar'] = $imagePath ?? $this->existingGambarPengumuman; // Use existing image if no new image is uploaded

        DB::table('pengumuman')->where('id_pengumuman', $this->id_pengumuman)->update($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.pengumuman')->with('success', 'Data pengumuman berhasil diubah!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.pengumuman.edit');
    }
}
