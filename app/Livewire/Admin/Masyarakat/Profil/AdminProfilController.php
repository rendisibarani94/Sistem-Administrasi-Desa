<?php

namespace App\Livewire\Admin\Masyarakat\Profil;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AdminProfilController extends Component
{
    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $profil_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $visi_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $misi_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $sejarah_desa;

    #[Rule('required', message: 'Kolom Deskripsi Footer Harus Diisi!')]
    public $link_iframe_maps;



    public function mount()
    {
        // Load existing profil using Query Builder
        $profil = DB::table('profil')->pluck('value', 'key');

        $this->profil_desa = $profil['profil_desa'] ?? null;
        $this->visi_desa = $profil['visi_desa'] ?? null;
        $this->misi_desa = $profil['misi_desa'] ?? null;
        $this->sejarah_desa = $profil['sejarah_desa'] ?? null;
        $this->link_iframe_maps = $profil['link_iframe_maps'] ?? null;
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
        $this->validate();

        $this->saveProfil('profil_desa', $this->profil_desa);
        $this->saveProfil('visi_desa', $this->visi_desa);
        $this->saveProfil('misi_desa', $this->misi_desa);
        $this->saveProfil('sejarah_desa', $this->sejarah_desa);
        $this->saveProfil('link_iframe_maps', $this->link_iframe_maps);

        return redirect()->route('admin.profil')->with('success', 'Informasi Profil berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.profil.index');
    }
}
