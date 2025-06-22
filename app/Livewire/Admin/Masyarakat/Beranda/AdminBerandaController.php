<?php

namespace App\Livewire\Admin\Masyarakat\Beranda;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AdminBerandaController extends Component
{
   use WithFileUploads;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $deskripsi_beranda;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $deskripsi_singkat_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $deskripsi_singkat_organisasi;

    public $existingGambar;

    #[Rule('nullable|image|max:4096', message: 'File harus berupa gambar dan maksimal 4MB!')]
    public $gambar_landing_page;

    public function mount()
    {
        // Load existing profil using Query Builder
        $profil = DB::table('profil')->pluck('value', 'key');

        $this->deskripsi_beranda = $profil['deskripsi_beranda'] ?? null;
        $this->deskripsi_singkat_desa = $profil['deskripsi_singkat_desa'] ?? null;
        $this->deskripsi_singkat_organisasi = $profil['deskripsi_singkat_organisasi'] ?? null;
        $this->existingGambar = $profil['gambar_landing_page'] ?? null;
    }

    private function saveProfil($key, $value)
    {
        DB::table('profil')->updateOrInsert(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public function save()
    {
        // Validate the form data
        $this->validate();

        // Handle image upload
        if ($this->gambar_landing_page) {
            // Delete old image if exists
            if ($this->existingGambar && Storage::disk('public')->exists($this->existingGambar)) {
                Storage::disk('public')->delete($this->existingGambar);
            }

            // Store new image
            $imagePath = $this->gambar_landing_page->store('images/beranda', 'public');

            // Clean up temporary file using Livewire's method
            if ($this->gambar_landing_page instanceof TemporaryUploadedFile) {
                $this->gambar_landing_page->delete();
            }

            // Save image path to database
            $this->saveProfil('gambar_landing_page', $imagePath);
        }

        $this->saveProfil('deskripsi_beranda', $this->deskripsi_beranda);
        $this->saveProfil('deskripsi_singkat_desa', $this->deskripsi_singkat_desa);
        $this->saveProfil('deskripsi_singkat_organisasi', $this->deskripsi_singkat_organisasi);

        return redirect()->route('admin.beranda')->with('success', 'Informasi Beranda berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.beranda.index');
    }
}
