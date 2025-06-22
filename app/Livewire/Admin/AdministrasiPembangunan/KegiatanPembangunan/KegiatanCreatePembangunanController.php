<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class KegiatanCreatePembangunanController extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Kolom Nama Kegiatan Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Kegiatan Maksimal 255 Karakter!')]
    public $nama_kegiatan;

    #[Rule('required', message: 'Kolom Nama Pelaksana Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Nama Pelaksana Maksimal 150 Karakter!')]
    public $pelaksana;

    #[Rule('required', message: 'Jika Sumber Dana Pemerintah Harus Diisi!')]
    public $biaya_pemerintah = 0;

    #[Rule('required', message: 'Jika Sumber Dana Provinsi Harus Diisi!')]
    public $biaya_provinsi = 0;

    #[Rule('required', message: 'Jika Sumber Dana Kabupaten / Kota Harus Diisi!')]
    public $biaya_kabupaten_kota = 0;

    #[Rule('required', message: 'Jika Sumber Dana Swadaya Harus Diisi!')]
    public $biaya_swadaya = 0;

    #[Rule('required', message: 'Kolom Lokasi Kegiatan Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Lokasi Kegiatan Maksimal 255 Karakter!')]
    public $lokasi;

    #[Rule('required', message: 'Kolom Manfaat Kegiatan Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Manfaat Kegiatan Maksimal 255 Karakter!')]
    public $manfaat;

    #[Rule('required', message: 'Kolom Tanggal Mulai Kegiatan Harus Diisi!')]
    public $tanggal_mulai;

    #[Rule('required', message: 'Kolom Tanggal Selesai Kegiatan Harus Diisi!')]
    public $tanggal_selesai;

    #[Rule('required', message: 'Kolom Sifat Proyek Kegiatan Harus Diisi!')]
    public $sifat_proyek;

    #[Rule('required', message: 'Kolom Status Pengerjaan Kegiatan Harus Diisi!')]
    public $status_pengerjaan;

    #[Rule('max:255', message: 'Kolom Keterangan Maksimal 255 Karakter!')]
    public $keterangan;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $dokumentasi;
    public $oldDokumentasi;

        public function updatedDokumentasi()
    {
        // Clean up previous file if exists
        if ($this->oldDokumentasi) {
            cleanup_livewire_temp_files($this->oldDokumentasi);
        }

        // Store reference to current file
        $this->oldDokumentasi = $this->dokumentasi;
    }


    public function store()
    {
        $validated = $this->validate();

        if ($this->gambar) {

            // Store new image
            $imagePath = $this->dokumentasi->store('images/kegiatan-pembangunan', 'public');
        }
        $validated['dokumentasi'] = $imagePath ?? null;

        DB::table('pembangunan')->insert($validated);

        $this->reset();

        return redirect()->route('Pembangunan')->with('success', 'Data Kegiatan Pembangunan berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.pembangunan.rencana-kegiatan-pembangunan.create');
    }
}
