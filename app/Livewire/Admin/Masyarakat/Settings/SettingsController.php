<?php

namespace App\Livewire\Admin\Masyarakat\Settings;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Component
{
    use WithFileUploads;

    public $existingLogo;

    #[Rule('required', message: 'Kolom Nama Desa Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Desa Maksimal 255 karakter!')]
    public $nama_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Deskripsi Footer Maksimal 255 karakter!')]
    public $deskripsi_footer;

    #[Rule('url', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    #[Rule('nullable', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    public $link_fb;

    #[Rule('url', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    #[Rule('nullable', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    public $link_ig;

    #[Rule('url', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    #[Rule('nullable', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    public $link_twt;

    #[Rule('url', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    #[Rule('nullable', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    public $link_wa;

    #[Rule('url', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    #[Rule('nullable', message: 'Kolom Ini Harus Dalam Bentuk URL!')]
    public $link_yt;

    #[Rule('nullable|max:20', message: 'Kolom Nomor Telepon Maksimal 20 karakter!')]
    public $nomor_telp;

    #[Rule('nullable|max:20', message: 'Kolom Nomor HP Maksimal 20 karakter!')]
    public $nomor_hp;

    #[Rule('nullable|email', message: 'Kolom Harus Dalam Bentuk Email!')]
    public $email;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $logo;

    public $oldLogo;

    public function updatedLogo(){
        // Clean up previous file if exists
        if ($this->oldLogo) {
            cleanup_livewire_temp_files($this->oldLogo);
        }

        // Store reference to current file
        $this->oldLogo = $this->logo;
    }

    public function mount()
    {
        // Load existing settings using Query Builder
        $settings = DB::table('settings')->pluck('value', 'key');

        $this->existingLogo = $settings['logo'] ?? null;
        $this->nama_desa = $settings['nama_desa'] ?? null;
        $this->deskripsi_footer = $settings['deskripsi_footer'] ?? null;
        $this->link_fb = $settings['link_fb'] ?? null;
        $this->link_ig = $settings['link_ig'] ?? null;
        $this->link_twt = $settings['link_twt'] ?? null;
        $this->link_wa = $settings['link_wa'] ?? null;
        $this->link_yt = $settings['link_yt'] ?? null;
        $this->nomor_telp = $settings['nomor_telp'] ?? null;
        $this->nomor_hp = $settings['nomor_hp'] ?? null;
        $this->email = $settings['email'] ?? null;
    }

    private function saveSetting($key, $value)
    {
        DB::table('settings')->updateOrInsert(
            ['key' => $key],
            ['value' => $value]
        );
    }


    public function save()
    {
        // Validate the form data
        $this->validate();

        // Handle logo upload if a new file is provided
        // Handle image upload
        if ($this->logo) {
            // Delete old image if exists
            if ($this->existingLogo && Storage::disk('public')->exists($this->existingLogo)) {
                Storage::disk('public')->delete($this->existingLogo);
            }

            // Store new image
            $imagePath = $this->logo->store('images/logo', 'public');

            // Save image path to database
            $this->saveSetting('logo', $imagePath);
        }

        // Save all text settings
        $this->saveSetting('nama_desa', $this->nama_desa);
        $this->saveSetting('deskripsi_footer', $this->deskripsi_footer);
        $this->saveSetting('link_fb', $this->link_fb);
        $this->saveSetting('link_ig', $this->link_ig);
        $this->saveSetting('link_twt', $this->link_twt);
        $this->saveSetting('link_wa', $this->link_wa);
        $this->saveSetting('link_yt', $this->link_yt);
        $this->saveSetting('nomor_telp', $this->nomor_telp);
        $this->saveSetting('nomor_hp', $this->nomor_hp);
        $this->saveSetting('email', $this->email);

        cleanup_livewire_temp_files($this->logo);

        // Reset the logo property to clear the file input
        $this->logo = null;

        return redirect()->route('settings')->with('success', 'Pengaturan berhasil disimpan!');
    }


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.settings.index');
    }
}
