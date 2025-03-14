<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukEditController extends Component
{
    #[Rule('required', message: 'Jangan Kosong Dek')]
    public $id_penduduk;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Lengkap Terlalu Panjang!')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    public $alamat;

    #[Rule('required', message: 'Kolom NIK Harus Diisi!')]
    #[Rule('min:16', message: 'Input NIK Harus 16 Karakter!')]
    #[Rule('max:16', message: 'Input NIK Harus 16 Karakter!')]
    public $nik;

    #[Rule('required', message: 'Input Nomor Kartu Keluarga Harus Diisi!')]
    #[Rule('min:16', message: 'Input Nomor Kartu Keluarga Harus 16 Karakter!')]
    #[Rule('max:16', message: 'Input Nomor Kartu Keluarga Harus 16 Karakter!')]
    public $nomor_kk;

    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi!')]
    #[Rule('max:255', message: 'Input Tempat Lahir terlalu Panjang!')]
    public $tempat_lahir;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi!')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Golongan Darah Harus Diisi!')]
    public $golongan_darah;

    #[Rule('required', message: 'Kolom Agama Harus Diisi!')]
    public $agama;

    #[Rule('required', message: 'Kolom Status Perkawinan Harus Diisi!')]
    public $status_perkawinan;

    #[Rule('required', message: 'Kolom Pendidikan Terakhir Harus Diisi!')]
    public $pendidikan_terakhir;

    #[Rule('required', message: 'Kolom Pekerjaan Harus Diisi!')]
    public $pekerjaan;

    #[Rule('required', message: 'Kolom Baca Huruf Harus Diisi!')]
    public $baca_huruf;

    #[Rule('required', message: 'Kolom Kedudukan Keluarga Harus Diisi!')]
    public $kedudukan_keluarga;

    #[Rule('required', message: 'Kolom Dusun Harus Diisi!')]
    public $dusun;

    #[Rule('required', message: 'Kolom Asal Penduduk Harus Diisi!')]
    #[Rule('max:255', message: 'Input Asal Penduduk Terlalu Panjang!')]
    public $asal_penduduk;

    #[Rule('required', message: 'Kolom Tanggal Penambahan Harus Diisi!')]
    public $tanggal_penambahan;

    public function mount($nik)
    {
        $this->id_penduduk = $nik;
        $this->loadPenduduk();
    }

    public function loadPenduduk()
    {
        $penduduk = DB::table('penduduk')->where('id_penduduk', $this->id_penduduk)->first();

        if (!$penduduk) {
            return redirect()->route('indukPenduduk')->with('error', 'Penduduk tidak ditemukan!');
        }
        // Fill properties with data from database
        $this->nama_lengkap = $penduduk->nama_lengkap;
        $this->jenis_kelamin = $penduduk->jenis_kelamin;
        $this->alamat = $penduduk->alamat;
        $this->nik = $penduduk->nik;
        $this->nomor_kk = $penduduk->nomor_kk;
        $this->tempat_lahir = $penduduk->tempat_lahir;
        $this->tanggal_lahir = $penduduk->tanggal_lahir;
        $this->golongan_darah = $penduduk->golongan_darah;
        $this->agama = $penduduk->agama;
        $this->status_perkawinan = $penduduk->status_perkawinan;
        $this->pendidikan_terakhir = $penduduk->pendidikan_terakhir;
        $this->pekerjaan = $penduduk->pekerjaan;
        $this->baca_huruf = $penduduk->baca_huruf;
        $this->kedudukan_keluarga = $penduduk->kedudukan_keluarga;
        $this->dusun = $penduduk->dusun;
        $this->asal_penduduk = $penduduk->asal_penduduk;
        $this->tanggal_penambahan = $penduduk->tanggal_penambahan;
    }

    public function update()
    {
        // Validate the form inputs
        $validated = $this->validate();

        $data = [
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'nik' => $this->nik,
            'nomor_kk' => $this->nomor_kk,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'golongan_darah' => $this->golongan_darah,
            'agama' => $this->agama,
            'status_perkawinan' => $this->status_perkawinan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pekerjaan' => $this->pekerjaan,
            'baca_huruf' => $this->baca_huruf,
            'kedudukan_keluarga' => $this->kedudukan_keluarga,
            'dusun' => $this->dusun,
            'asal_penduduk' => $this->asal_penduduk,
            'tanggal_penambahan' => $this->tanggal_penambahan,
            'update_at' => now()
        ];
        // Update the data in the database
        DB::table('penduduk')->where('id_penduduk', $this->id_penduduk)->update($data);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.Induk-Penduduk.edit', [
            'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
            'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
        ]);
    }
}
