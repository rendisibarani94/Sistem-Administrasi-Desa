<?php

namespace App\Livewire\Admin\Masyarakat\Agenda;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AdminAgendaEditController extends Component
{
    use WithFileUploads;

    public $id_agenda;

    public $existingGambarAgenda;

    public $gambar;

    #[Rule('required', message: 'Kolom Judul Agenda Harus Diisi!')]
    #[Rule('max:255', message: 'Input Judul Agenda maksimal 255 karakter!')]
    public $judul;

    #[Rule('required', message: 'Deskripsi agenda harus diisi!')]
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

    public function mount($id_agenda)
    {
        $this->id_agenda = $id_agenda;
        $this->loadAgenda();
    }

    public function loadAgenda()
    {
        $agenda = DB::table('agenda')->where('id_agenda', $this->id_agenda)->first();

        $this->existingGambarAgenda = $agenda->gambar;
        $this->judul = $agenda->judul;
        $this->deskripsi_agenda = $agenda->deskripsi_agenda;
        $this->tanggal_agenda = $agenda->tanggal_agenda;
        $this->tempat_agenda = $agenda->tempat_agenda;
        $this->tujuan_agenda = $agenda->tujuan_agenda;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        if ($this->gambar) {
            // Delete old image if exists
            if ($this->existingGambarAgenda && Storage::disk('public')->exists($this->existingGambarAgenda)) {
                Storage::disk('public')->delete($this->existingGambarAgenda);
            }

            // Store new image
            $imagePath = $this->gambar->store('images/agenda', 'public');
        }
        // If no new image is uploaded, keep the existing image
        $validated['gambar'] = $imagePath ?? $this->existingGambarAgenda ?? null; // Use existing image if no new image is uploaded
        $validated['id_dibuat_oleh'] = auth()->id();
        DB::table('agenda')->where('id_agenda', $this->id_agenda)->update($validated);

        // Clean up current temporary file
        cleanup_livewire_temp_files($this->gambar);

        $this->reset();

        return redirect()->route('admin.agenda')->with('success', 'Data Agenda berhasil diubah!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.masyarakat.agenda.edit');
    }
}
