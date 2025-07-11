<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KartuKeluargaEditController extends Component
{

    public $id_kartu_keluarga;

    // first form step

    #[Rule('required', message: 'Kolom Nomor Kartu Keluarga Harus Diisi!')]
    #[Rule('size:16', message: 'Input Nomor Kartu Keluarga Harus 16 Karakter!')]
    public $nomor_kartu_keluarga;

    #[Rule('required', message: 'Kolom Tanggal Keluar Kartu Keluarga Harus Diisi!')]
    public $tanggal_keluar;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:150', message: 'Input alamat maksimal 150 digit')]
    public $alamat_kk;

    #[Rule('required', message: 'Kolom RT Harus Diisi!')]
    #[Rule('max:10', message: 'Input RT Terlalu Panjang!')]
    public $rt;

    #[Rule('required', message: 'Kolom RW Harus Diisi!')]
    #[Rule('max:10', message: 'Input RW Terlalu Panjang!')]
    public $rw;

    #[Rule('required', message: 'Kolom Desa/Kelurahan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Desa/Kelurahan Terlalu Panjang!')]
    public $desa_kelurahan;

    #[Rule('required', message: 'Kolom kecamatan Harus Diisi!')]
    #[Rule('max:50', message: 'Input kecamatan Terlalu Panjang!')]
    public $kecamatan;

    #[Rule('required', message: 'Kolom Kode Pos Harus Diisi!')]
    #[Rule('max:5', message: 'Input Kode Pos Terlalu Panjang!')]
    public $kode_pos;

    #[Rule('required', message: 'Kolom Kabupaten/Kota Harus Diisi!')]
    #[Rule('max:50', message: 'Input Kabupaten/Kota Terlalu Panjang!')]
    public $kabupaten_kota;

    #[Rule('required', message: 'Kolom Provinsi Harus Diisi!')]
    #[Rule('max:50', message: 'Input Provinsi Terlalu Panjang!')]
    public $provinsi;

    public function mount($id_kartu_keluarga)
    {
        $this->id_kartu_keluarga = $id_kartu_keluarga;
        $this->loadKK();
    }

    public function loadKK()
    {
        $kk = DB::table('kartu_keluarga')->where('id_kartu_keluarga', $this->id_kartu_keluarga)->first();

        $this->nomor_kartu_keluarga = $kk->nomor_kartu_keluarga;
        $this->tanggal_keluar = $kk->tanggal_keluar;
        $this->alamat_kk = $kk->alamat_kk;
        $this->rt = $kk->rt;
        $this->rw = $kk->rw;
        $this->desa_kelurahan = $kk->desa_kelurahan;
        $this->kecamatan = $kk->kecamatan;
        $this->kode_pos = $kk->kode_pos;
        $this->kabupaten_kota = $kk->kabupaten_kota;
        $this->provinsi = $kk->provinsi;
    }

    public function update()
    {
        // Validate the form inputs
        $validated = $this->validate();

        $data = [
            'nomor_kartu_keluarga' => $this->nomor_kartu_keluarga,
            'tanggal_keluar' => $this->tanggal_keluar,
            'alamat_kk' => $this->alamat_kk,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'desa_kelurahan' => $this->desa_kelurahan,
            'kecamatan' => $this->kecamatan,
            'kode_pos' => $this->kode_pos,
            'kabupaten_kota' => $this->kabupaten_kota,
            'provinsi' => $this->provinsi,
            'updated_at' => now()
        ];

        DB::table('kartu_keluarga')->where('id_kartu_keluarga', $this->id_kartu_keluarga)->update($data);

        return redirect()->route('kartuKeluarga')->with('success', 'Data Kartu Keluarga Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.kartu-keluarga.edit');
    }

}
