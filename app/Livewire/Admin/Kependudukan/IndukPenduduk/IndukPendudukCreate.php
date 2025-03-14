<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class IndukPendudukCreate extends Component
{

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

    public function store()
    {
            // Validate the form inputs
            $validated = $this->validate();
            // Insert the data into the database
            DB::table('penduduk')->insert($validated);

            // Reset the form fields
            $this->reset([
                'nama_lengkap',
                'jenis_kelamin',
                'alamat',
                'nik',
                'nomor_kk',
                'tempat_lahir',
                'tanggal_lahir',
                'golongan_darah',
                'agama',
                'status_perkawinan',
                'pendidikan_terakhir',
                'pekerjaan',
                'baca_huruf',
                'kedudukan_keluarga',
                'dusun',
                'asal_penduduk'
            ]);
            // Redirect to index page
            return redirect()->route('indukPenduduk.index')->with('success', 'Data penduduk berhasil disimpan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.Induk-Penduduk.create',
            [
                'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
                'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
            ]
        );
    }
}
