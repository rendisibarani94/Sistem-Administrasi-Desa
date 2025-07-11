<?php

namespace App\Livewire\Admin\Masyarakat\Agenda;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class AdminAgendaCreateController extends Component
{
    use WithFileUploads;

    public $existingGambarAgenda;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $gambar;

    #[Rule('required', message: 'Kolom Judul Agenda Harus Diisi!')]
    #[Rule('max:255', message: 'Input Judul Agenda maksimal 255 karakter!')]
    public $judul;

    #[Rule('required', message: 'Kolom Deksripsi Agenda Harus Diisi!')]
    public $deskripsi_agenda;

    #[Rule('required', message: 'Kolom Tempat Agenda Harus Diisi!')]
    #[Rule('max:255', message: 'Input Tempat Agenda maksimal 255 karakter!')]
    public $tempat_agenda;

    #[Rule('required', message: 'Kolom Judul Agenda  Harus Diisi!')]
    #[Rule('max:255', message: 'Input Judul Agenda maksimal 255 karakter!')]
    public $tujuan_agenda;

    #[Rule('required', message: 'Kolom Tanggal Agenda Harus Diisi!')]
    public $tanggal_agenda;

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
            // Store new image
            $imagePath = $this->gambar->store('images/agenda', 'public');
        }
        $validated['gambar'] = $imagePath ?? null;

        $validated['id_dibuat_oleh'] = auth()->id();
        DB::table('agenda')->insert($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.agenda')->with('success', 'Data Agenda berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.agenda.create');
    }
}
