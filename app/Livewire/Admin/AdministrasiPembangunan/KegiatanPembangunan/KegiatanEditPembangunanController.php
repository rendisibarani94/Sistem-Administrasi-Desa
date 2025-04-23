<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KegiatanPembangunan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KegiatanEditPembangunanController extends Component
{
    public $id_pembangunan;

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

    #[Rule('max:255', message: 'Kolom Keterangan Maksimal 255 Karakter!')]
    public $keterangan;

    public function mount($id_pembangunan)
    {
        $this->id_pembangunan = $id_pembangunan;
        $this->loadEditData();
    }

    public function loadEditData(){
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
        $this->keterangan = $pb->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('pembangunan')
        ->where('id_pembangunan', $this->id_pembangunan)
        ->update($validated);

        return redirect()->route('RencanaPembangunan')->with('success', 'Data Rencana Kegiatan Pembangunan Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.pembangunan.rencana-kegiatan-pembangunan.edit');
    }
}