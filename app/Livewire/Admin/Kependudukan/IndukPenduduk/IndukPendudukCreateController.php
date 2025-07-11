<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukCreateController extends Component
{

    #[Rule('required', message: 'Kolom Kewarganegaraan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Kewarganegaraan Maksimal 50 karakter!')]
    public $kewarganegaraan;

    #[Rule('required', message: 'Kolom Keturunan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Keturunan Maksimal 50 karakter!')]
    public $keturunan;

    #[Rule('nullable|date', message: 'Tanggal Keluar KTP harus berupa tanggal')]
    public $tanggal_keluar_ktp;

    // #[Rule('regex:/^\d{6}([04][1-9]|[1256][0-9]|[37][01])(0[1-9]|1[0-2])\d{2}\d{4}$/', message: 'Format NIK Tidak Valid (16 digit, wilayah, tanggal, bulan, tahun, urutan)!')]

    #[Rule('required', message: 'Kolom NIK Harus Diisi!')]
    #[Rule('size:16', message: 'Input NIK Harus 16 Karakter!')]
    public $nik;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Lengkap Maksimal 100 karakter')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:150', message: 'Input Alamat Maksimal 150 karakter')]
    public $alamat;

    #[Rule('required', message: 'Input Kartu Keluarga Harus Diisi!')]
    public $id_kartu_keluarga;

    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi!')]
    #[Rule('max:150', message: 'Input Tempat Lahir Maksimal 150 Karakter!')]
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
    #[Rule('max:100', message: 'Input Pekerjaan Maksimal 100 Karakter')]
    public $pekerjaan;

    #[Rule('required', message: 'Kolom Baca Huruf Harus Diisi!')]
    public $baca_huruf;

    #[Rule('required', message: 'Kolom Nama Ayah Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Ayah Maksimal 100 Karakter!')]
    public $nama_ayah;

    #[Rule('required', message: 'Kolom Nama Ibu Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Ibu Maksimal 100 Karakter!')]
    public $nama_ibu;

    #[Rule('required', message: 'Kolom Kedudukan Keluarga Harus Diisi!')]
    public $kedudukan_keluarga;

    #[Rule('required', message: 'Kolom Dusun Harus Diisi!')]
    public $dusun;

    #[Rule('required', message: 'Kolom Asal Penduduk Harus Diisi!')]
    #[Rule('max:150', message: 'Input Asal Penduduk Maksimal 150 Karakter!')]
    public $asal_penduduk;

    #[Rule('nullable|max:30', message: 'Input Asal Penduduk Maksimal 30 Karakter!')]
    public $nomor_akta_lahir;

    #[Rule('nullable|max:50', message: 'Input Asal Penduduk Maksimal 50 Karakter!')]
    public $suku;

    #[Rule('required', message: 'Kolom Tanggal Penambahan Harus Diisi!')]
    public $tanggal_penambahan;

    #[Rule('max:255', message: 'Input Keterangan Maksimal 255 karakter')]
    public $keterangan;

    public function store()
    {
        // Validate the form inputs
        $validated = $this->validate();
        // Insert the data into the database
        DB::table('penduduk')->insert($validated);

        // Reset the form fields
        $this->reset();

        // Redirect to index page
        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk berhasil disimpan!');
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

        return view(
            'admin.kependudukan.induk-penduduk.create',
            [
                'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
                'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
                'kkData' => $kkData,
            ]
        );
    }
}
