<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukEditController extends Component
{
    public $id_penduduk;

    #[Rule('required', message: 'Kolom Kewarganegaraan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Kewarganegaraan Maksimal 50 karakter!')]
    public $kewarganegaraan;

    #[Rule('required', message: 'Kolom Keturunan Harus Diisi!')]
    public $keturunan;

    #[Rule('nullable|date', message: 'Tanggal Keluar KTP harus berupa tanggal')]
    public $tanggal_keluar_ktp;

    #[Rule('required', message: 'Kolom NIK Harus Diisi!')]
    #[Rule('size:16', message: 'Input NIK Harus 16 Karakter!')]
    public $nik;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Lengkap Terlalu Panjang!')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    public $alamat;

    #[Rule('required', message: 'Input Kartu Keluarga Harus Diisi!')]
    public $id_kartu_keluarga;

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

    #[Rule('required', message: 'Kolom Nama Ayah Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Ayah Terlalu Panjang!')]
    public $nama_ayah;

    #[Rule('required', message: 'Kolom Nama Ibu Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Ibu Terlalu Panjang!')]
    public $nama_ibu;

    #[Rule('required', message: 'Kolom Kedudukan Keluarga Harus Diisi!')]
    public $kedudukan_keluarga;

    #[Rule('required', message: 'Kolom Dusun Harus Diisi!')]
    public $dusun;

    #[Rule('required', message: 'Kolom Asal Penduduk Harus Diisi!')]
    #[Rule('max:255', message: 'Input Asal Penduduk Terlalu Panjang!')]
    public $asal_penduduk;

    #[Rule('nullable|max:21', message: 'Input Asal Penduduk Maksimal 21 Karakter!')]
    public $nomor_akta_lahir;

    #[Rule('nullable|max:255', message: 'Input Asal Penduduk Maksimal 255 Karakter!')]
    public $suku;

    #[Rule('required', message: 'Kolom Tanggal Penambahan Harus Diisi!')]
    public $tanggal_penambahan;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang')]
    public $keterangan;

    public function mount($id)
    {
        $this->id_penduduk = $id;
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
        $this->nomor_akta_lahir = $penduduk->nomor_akta_lahir;
        $this->suku = $penduduk->suku;
        $this->jenis_kelamin = $penduduk->jenis_kelamin;
        $this->alamat = $penduduk->alamat;
        $this->nik = $penduduk->nik;
        $this->id_kartu_keluarga = $penduduk->id_kartu_keluarga;
        $this->tempat_lahir = $penduduk->tempat_lahir;
        $this->tanggal_lahir = $penduduk->tanggal_lahir;
        $this->nama_ayah = $penduduk->nama_ayah;
        $this->nama_ibu = $penduduk->nama_ibu;
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
        $this->kewarganegaraan = $penduduk->kewarganegaraan;
        $this->keturunan = $penduduk->keturunan;
        $this->tanggal_keluar_ktp = $penduduk->tanggal_keluar_ktp;
        $this->keterangan = $penduduk->keterangan;
    }

    public function update()
    {
        // Validate the form inputs
        $validated = $this->validate();
        $validated['updated_at'] = now();

        // Update the data in the database
        DB::table('penduduk')->where('id_penduduk', $this->id_penduduk)->update($validated);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $kkData = DB::table('kartu_keluarga as kk')
            ->join('penduduk as p', function ($join) {
                $join->on('p.id_kartu_keluarga', '=', 'kk.id_kartu_keluarga')
                    ->where('p.kedudukan_keluarga', 'KEPALA KELUARGA')
                    ->where('p.is_mutated', 0)
                    ->where('p.is_deleted', 0);
            })
            ->where('kk.is_deleted', 0)
            ->select([
                'kk.id_kartu_keluarga',
                'kk.nomor_kartu_keluarga',
                'p.nama_lengkap',
            ])
            ->get();

        return view('admin.kependudukan.induk-penduduk.edit', [
            'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
            'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
            'kkData' => $kkData,
        ]);
    }
}
