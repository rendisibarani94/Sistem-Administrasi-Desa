<?php

namespace App\Livewire\Admin\Masyarakat\Organisasi;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AdminOrganisasiEditController extends Component
{
    use WithFileUploads;

    public $id_organisasi;

    #[Rule('required', message: 'Kolom Nama Organisasi Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Organisasi maksimal 255 karakter!')]
    public $nama_organisasi;


    #[Rule('required', message: 'Kolom Alamat Organisasi Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Alamat Organisasi maksimal 255 karakter!')]
    public $alamat;

    #[Rule('required', message: 'Tanggal Organisasi Harus Diisi!')]
    public $tanggal_berdiri;

    #[Rule('required', message: 'Kolom Nama Organisasi Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Organisasi maksimal 255 karakter!')]
    public $ketua;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_ketua;
    public $oldFotoKetua;
    public $existingFotoKetua;

    #[Rule('required', message: 'Kolom Nama Sekretaris Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Sekretaris maksimal 255 karakter!')]
    public $sekretaris;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_sekretaris;
    public $oldFotoSekretaris;
    public $existingFotoSekretaris;

    #[Rule('required', message: 'Kolom Nama Bendahara Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Bendahara maksimal 255 karakter!')]
    public $bendahara;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_bendahara;
    public $oldFotoBendahara;
    public $existingFotoBendahara;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $logo_organisasi;
    public $oldLogoOrganisasi;
    public $existingLogoOrganisasi;

    #[Rule('required', message: 'Deskripsi Visi Organisasi Harus Diisi!')]
    public $visi;

    #[Rule('required', message: 'Deskripsi Misi Organisasi Harus Diisi!')]
    public $misi;

            public function updatedLogoOrganisasi()
    {
        // Clean up previous file if exists
        if ($this->oldLogoOrganisasi) {
            cleanup_livewire_temp_files($this->oldLogoOrganisasi);
        }

        // Store reference to current file
        $this->oldLogoOrganisasi = $this->logo_organisasi;
    }

        public function updatedFotoKetua()
    {
        // Clean up previous file if exists
        if ($this->oldFotoKetua) {
            cleanup_livewire_temp_files($this->oldFotoKetua);
        }

        // Store reference to current file
        $this->oldFotoKetua = $this->foto_ketua;
    }

    public function updatedFotoSekretaris()
    {
        // Clean up previous file if exists
        if ($this->oldFotoSekretaris) {
            cleanup_livewire_temp_files($this->oldFotoSekretaris);
        }

        // Store reference to current file
        $this->oldFotoSekretaris = $this->foto_sekretaris;
    }

    public function updatedFotoBendahara()
    {
        // Clean up previous file if exists
        if ($this->oldFotoBendahara) {
            cleanup_livewire_temp_files($this->oldFotoBendahara);
        }

        // Store reference to current file
        $this->oldFotoBendahara = $this->foto_bendahara;
    }

    public function mount($id_organisasi)
    {
        $this->id_organisasi = $id_organisasi;
        $this->loadOrganisasi();
    }

    public function loadOrganisasi()
    {
        $organisasi = DB::table('organisasi')->where('id_organisasi', $this->id_organisasi)->first();

        $this->nama_organisasi = $organisasi->nama_organisasi;
        $this->alamat = $organisasi->alamat;
        $this->tanggal_berdiri = $organisasi->tanggal_berdiri;
        $this->ketua = $organisasi->ketua;
        $this->existingFotoKetua = $organisasi->foto_ketua;
        $this->sekretaris = $organisasi->sekretaris;
        $this->existingFotoSekretaris = $organisasi->foto_sekretaris;
        $this->bendahara = $organisasi->bendahara;
        $this->existingLogoOrganisasi = $organisasi->logo_organisasi;
        $this->existingFotoBendahara = $organisasi->foto_bendahara;
        $this->visi = $organisasi->visi;
        $this->misi = $organisasi->misi;

    }

public function update()
{
    $validated = $this->validate();

    // Process each image separately
    $imagePathKetua = $this->processImage(
        $this->foto_ketua,
        $this->existingFotoKetua,
        'foto_ketua'
    );

    $imagePathSekretaris = $this->processImage(
        $this->foto_sekretaris,
        $this->existingFotoSekretaris,
        'foto_sekretaris'
    );

    $imagePathBendahara = $this->processImage(
        $this->foto_bendahara,
        $this->existingFotoBendahara,
        'foto_bendahara'
    );

    $imagePathLogo = $this->processImage(
        $this->logo_organisasi,
        $this->existingLogoOrganisasi,
        'logo_organisasi'
    );

    // Assign paths to validated data
    $validated['foto_ketua'] = $imagePathKetua ?? $this->existingFotoKetua;
    $validated['foto_sekretaris'] = $imagePathSekretaris ?? $this->existingFotoSekretaris;
    $validated['foto_bendahara'] = $imagePathBendahara ?? $this->existingFotoBendahara;
    $validated['logo_organisasi'] = $imagePathLogo ?? $this->existingLogoOrganisasi;

    // Update database
    DB::table('organisasi')->where('id_organisasi', $this->id_organisasi)->update($validated);

    // Cleanup temporary files
    collect([$this->foto_ketua, $this->foto_sekretaris, $this->foto_bendahara, $this->logo_organisasi])
        ->filter()
        ->each(fn($file) => cleanup_livewire_temp_files($file));

    return redirect()->route('admin.organisasi')->with('success', 'Data Organisasi berhasil diubah!');
}

private function processImage($newImage, $existingPath, $type)
{
    if (!$newImage) return null;

    // Delete old image if exists
    if ($existingPath && Storage::disk('public')->exists($existingPath)) {
        Storage::disk('public')->delete($existingPath);
    }

    // Store new image
    return $newImage->store("images/organisasi", 'public');
}

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.organisasi.edit');
    }
}
