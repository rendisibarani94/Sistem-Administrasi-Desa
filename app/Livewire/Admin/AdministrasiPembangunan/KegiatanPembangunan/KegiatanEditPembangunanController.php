<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class KegiatanEditPembangunanController extends Component
{
    use WithFileUploads;

    public $id_pembangunan;

    #[Rule('required', message: 'Kolom Nama Kegiatan Harus Diisi!')]
    #[Rule('max:255', message: 'Kolom Nama Kegiatan Maksimal 255 digit karakter !')]
    public $nama_kegiatan;

    #[Rule('required', message: 'Kolom Nama Pelaksana Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Nama Pelaksana Maksimal 150 digit karakter !')]
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
    #[Rule('max:255', message: 'Kolom Lokasi Kegiatan Maksimal 255 digit karakter !')]
    public $lokasi;

    #[Rule('required', message: 'Kolom Manfaat Kegiatan Harus Diisi!')]
    public $manfaat;

    #[Rule('required', message: 'Kolom Tanggal Mulai Kegiatan Harus Diisi!')]
    public $tanggal_mulai;

    #[Rule('required', message: 'Kolom Tanggal Selesai Kegiatan Harus Diisi!')]
    public $tanggal_selesai;

    #[Rule('required', message: 'Kolom Sifat Proyek Kegiatan Harus Diisi!')]
    public $sifat_proyek;

    #[Rule('required', message: 'Kolom Status Pengerjaan Kegiatan Harus Diisi!')]
    public $status_pengerjaan;

    #[Rule('max:255', message: 'Kolom Keterangan Maksimal 255 digit karakter !')]
    public $keterangan;

    #[Rule('nullable|image|max:2048', message: 'File harus berupa gambar dan maksimal 2MB!')]
    public $dokumentasi;
    public $oldDokumentasi;
    public $existingDokumentasi;

        public function updatedDokumentasi()
    {
        // Clean up previous file if exists
        if ($this->oldDokumentasi) {
            cleanup_livewire_temp_files($this->oldDokumentasi);
        }

        // Store reference to current file
        $this->oldDokumentasi = $this->dokumentasi;
    }

    public function mount($id_pembangunan)
    {
        $this->id_pembangunan = $id_pembangunan;
        $this->loadEditData();
    }

    public function loadEditData()
    {
        $pb = DB::table('pembangunan')
            ->where('id_pembangunan', $this->id_pembangunan)
            ->first();

        $this->nama_kegiatan = $pb->nama_kegiatan;
        $this->pelaksana = $pb->pelaksana;
        $this->biaya_pemerintah = $pb->biaya_pemerintah;
        $this->biaya_provinsi = $pb->biaya_provinsi;
        $this->biaya_kabupaten_kota = $pb->biaya_kabupaten_kota;
        $this->biaya_swadaya = $pb->biaya_swadaya;
        $this->lokasi = $pb->lokasi;
        $this->manfaat = $pb->manfaat;
        $this->tanggal_mulai = $pb->tanggal_mulai;
        $this->tanggal_selesai = $pb->tanggal_selesai;
        $this->sifat_proyek = $pb->sifat_proyek;
        $this->existingDokumentasi = $pb->dokumentasi;
        $this->status_pengerjaan = $pb->status_pengerjaan;
        $this->keterangan = $pb->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();

            if ($this->dokumentasi) {
            // Delete old image if exists
            if ($this->existingDokumentasi && Storage::disk('public')->exists($this->existingDokumentasi)) {
                Storage::disk('public')->delete($this->existingDokumentasi);
            }

            // Store new image
            $imagePath = $this->dokumentasi->store('images/agenda', 'public');
        }

        $validated['updated_at'] = now();
        $validated['dokumentasi'] = $imagePath ?? $this->existingDokumentasi ?? null;


        DB::table('pembangunan')
            ->where('id_pembangunan', $this->id_pembangunan)
            ->update($validated);

        return redirect()->route('Pembangunan')->with('success', 'Data Rencana Kegiatan Pembangunan Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.pembangunan.rencana-kegiatan-pembangunan.edit');
    }
}
