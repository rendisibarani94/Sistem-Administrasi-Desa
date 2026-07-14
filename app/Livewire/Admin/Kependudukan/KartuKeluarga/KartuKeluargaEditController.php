<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KartuKeluargaEditController extends Component
{
    public $id_kartu_keluarga;
    public $id_kepala_keluarga;

    // =========================
    // VALIDASI FORM
    // =========================
    public $nomor_kartu_keluarga;

    #[Rule('required', message: 'Kolom Tanggal Keluar Kartu Keluarga Harus Diisi!')]
    public $tanggal_keluar;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:150', message: 'Input alamat maksimal 150 karakter!')]
    public $alamat_kk;

    #[Rule('required', message: 'Kolom RT Harus Diisi!')]
    public $rt;

    #[Rule('required', message: 'Kolom RW Harus Diisi!')]
    public $rw;

    #[Rule('required', message: 'Kolom Desa/Kelurahan Harus Diisi!')]
    public $desa_kelurahan;

    #[Rule('required', message: 'Kolom Kecamatan Harus Diisi!')]
    public $kecamatan;

    #[Rule('required', message: 'Kolom Kode Pos Harus Diisi!')]
    public $kode_pos;

    #[Rule('required', message: 'Kolom Kabupaten/Kota Harus Diisi!')]
    public $kabupaten_kota;

    #[Rule('required', message: 'Kolom Provinsi Harus Diisi!')]
    public $provinsi;

    public function updatedNomorKartuKeluarga($value)
    {
        $this->nomor_kartu_keluarga = preg_replace('/\D/', '', $value);
        $this->validateOnly('nomor_kartu_keluarga', [
            'nomor_kartu_keluarga' => 'required|size:16',
        ], [
            'nomor_kartu_keluarga.required' => 'Kolom Nomor Kartu Keluarga Harus Diisi!',
            'nomor_kartu_keluarga.size' => 'Input Nomor Kartu Keluarga Harus 16 Karakter!',
        ]);
    }

    // =========================
    // LOAD DATA SAAT HALAMAN DIBUKA
    // =========================
    public function mount($id_kartu_keluarga)
    {
        $this->id_kartu_keluarga = $id_kartu_keluarga;

        $this->loadKK();

        // ambil kepala keluarga
        $this->id_kepala_keluarga = DB::table('penduduk')
            ->where('id_kartu_keluarga', $this->id_kartu_keluarga)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->where('is_deleted', 0)
            ->where('is_mutated', 0)
            ->value('id_penduduk');
    }

    // =========================
    // AMBIL DATA KK
    // =========================
    public function loadKK()
    {
        $kk = DB::table('kartu_keluarga')
            ->where('id_kartu_keluarga', $this->id_kartu_keluarga)
            ->where('is_deleted', 0)
            ->first();

        if (!$kk) {
            abort(404);
        }

        $this->nomor_kartu_keluarga = $kk->nomor_kartu_keluarga;
        $this->tanggal_keluar      = $kk->tanggal_keluar;
        $this->alamat_kk          = $kk->alamat_kk;
        $this->rt                 = $kk->rt;
        $this->rw                 = $kk->rw;
        $this->desa_kelurahan     = $kk->desa_kelurahan;
        $this->kecamatan          = $kk->kecamatan;
        $this->kode_pos           = $kk->kode_pos;
        $this->kabupaten_kota     = $kk->kabupaten_kota;
        $this->provinsi           = $kk->provinsi;
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update()
    {
        $this->nomor_kartu_keluarga = preg_replace('/\D/', '', $this->nomor_kartu_keluarga);

        // Validate properties with #[Rule] attributes
        $this->validate();

        // Validate nomor_kartu_keluarga manually
        $this->validate([
            'nomor_kartu_keluarga' => 'required|size:16',
        ], [
            'nomor_kartu_keluarga.required' => 'Kolom Nomor Kartu Keluarga Harus Diisi!',
            'nomor_kartu_keluarga.size' => 'Input Nomor Kartu Keluarga Harus 16 Karakter!',
        ]);

        DB::table('kartu_keluarga')
            ->where('id_kartu_keluarga', $this->id_kartu_keluarga)
            ->update([
                'nomor_kartu_keluarga' => $this->nomor_kartu_keluarga,
                'tanggal_keluar'       => $this->tanggal_keluar,
                'alamat_kk'            => $this->alamat_kk,
                'rt'                   => $this->rt,
                'rw'                   => $this->rw,
                'desa_kelurahan'       => $this->desa_kelurahan,
                'kecamatan'            => $this->kecamatan,
                'kode_pos'             => $this->kode_pos,
                'kabupaten_kota'       => $this->kabupaten_kota,
                'provinsi'             => $this->provinsi,
                'updated_at'           => now(),
            ]);

        return redirect()
            ->route('kartuKeluarga')
            ->with('success', 'Data Kartu Keluarga berhasil diubah!');
    }

    // =========================
    // VIEW
    // =========================
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.kartu-keluarga.edit', [
            'kepalaKeluargaData' => DB::table('penduduk')
                ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
                ->where('is_deleted', 0)
                ->where('is_mutated', 0)
                ->get(),
        ]);
    }
}