<?php

namespace App\Livewire\Admin\Masyarakat\Organisasi;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class AdminOrganisasiCreateController extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Kolom Nama Organisasi Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Nama Organisasi maksimal 100 digit karakter!')]
    public $nama_organisasi;

    #[Rule('required', message: 'Kolom Alamat Organisasi Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Alamat Organisasi maksimal 150 digit karakter!')]
    public $alamat;

    #[Rule('required', message: 'Tanggal Organisasi Harus Diisi!')]
    public $tanggal_berdiri;

    #[Rule('required', message: 'Kolom Nama Organisasi Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Nama Organisasi maksimal 100 digit karakter!')]
    public $ketua;

    #[Rule('required|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_ketua;
    public $oldFotoKetua;
    public $existingFotoKetua;



    #[Rule('required', message: 'Kolom Nama Sekretaris Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Nama Sekretaris maksimal 100 digit karakter!')]
    public $sekretaris;

    #[Rule('required|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_sekretaris;
    public $oldFotoSekretaris;
    public $existingFotoSekretaris;

    #[Rule('required', message: 'Kolom Nama Bendahara Harus Diisi!')]
    #[Rule('max:100', message: 'Kolom Nama Bendahara maksimal 100 digit karakter!')]
    public $bendahara;

    #[Rule('required|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $foto_bendahara;
    public $oldFotoBendahara;
    public $existingFotoBendahara;

    #[Rule('required|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
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

    public function store()
    {
        $validated = $this->validate();

        if ($this->foto_ketua && $this->foto_sekretaris && $this->foto_bendahara && $this->logo_organisasi) {
            // Delete old images if exists
            if ($this->existingFotoKetua && Storage::disk('public')->exists($this->existingFotoKetua)) {
                Storage::disk('public')->delete($this->existingFotoKetua);
            }
            if ($this->existingFotoSekretaris && Storage::disk('public')->exists($this->existingFotoSekretaris)) {
                Storage::disk('public')->delete($this->existingFotoSekretaris);
            }
            if ($this->existingFotoBendahara && Storage::disk('public')->exists($this->existingFotoBendahara)) {
                Storage::disk('public')->delete($this->existingFotoBendahara);
            }

            if ($this->existingLogoOrganisasi && Storage::disk('public')->exists($this->existingLogoOrganisasi)) {
                Storage::disk('public')->delete($this->existingLogoOrganisasi);
            }

            // Store new image
            $imagePathKetua = $this->foto_ketua->store('images/organisasi', 'public');
            $imagePathSekretaris = $this->foto_sekretaris->store('images/organisasi', 'public');
            $imagePathBendahara = $this->foto_bendahara->store('images/organisasi', 'public');
            $imagePathLogo = $this->logo_organisasi->store('images/organisasi', 'public');
        }
        $validated['foto_ketua'] = $imagePathKetua ?? null;
        $validated['foto_sekretaris'] = $imagePathSekretaris ?? null;
        $validated['foto_bendahara'] = $imagePathBendahara ?? null;
        $validated['logo_organisasi'] = $imagePathLogo ?? null;

        DB::table('organisasi')->insert($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->foto_ketua);
        cleanup_livewire_temp_files($this->foto_sekretaris);
        cleanup_livewire_temp_files($this->foto_bendahara);
        cleanup_livewire_temp_files($this->logo_organisasi);

        $this->reset();

        return redirect()->route('admin.organisasi')->with('success', 'Data Berita berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.organisasi.create');
    }
}
