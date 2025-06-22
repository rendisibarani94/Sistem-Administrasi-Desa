<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Error;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KartuKeluargaCreateController extends Component
{
    public $currentStep = 1;

    // first form step
    #[Rule('required', message: 'Kolom Nomor Kartu Keluarga Harus Diisi!')]
    #[Rule('size:16', message: 'Input Nomor Kartu Keluarga Harus 16 Karakter!')]
    public $nomor_kartu_keluarga;

    #[Rule('required', message: 'Kolom Tanggal Keluar Kartu Keluarga Harus Diisi!')]
    public $tanggal_keluar;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:255', message: 'Input Alamat Terlalu Panjang!')]
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

    // second form step
    #[Rule('required', message: 'Kolom NIK Harus Diisi!')]
    #[Rule('size:16', message: 'Input NIK Harus 16 Karakter!')]
    public $nik;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Lengkap Terlalu Panjang!')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:255', message: 'Input Alamat terlalu Panjang!')]
    public $alamat;

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

    #[Rule('required', message: 'Kolom Tanggal Penambahan Harus Diisi!')]
    public $tanggal_penambahan;

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validateOnly('nomor_kartu_keluarga');
            $this->validateOnly('tanggal_keluar');
            $this->validateOnly('alamat_kk');
            $this->validateOnly('rt');
            $this->validateOnly('rw');
            $this->validateOnly('desa_kelurahan');
            $this->validateOnly('kecamatan');
            $this->validateOnly('kode_pos');
            $this->validateOnly('kabupaten_kota');
            $this->validateOnly('provinsi');
        } elseif ($this->currentStep == 2) {
            $this->validateOnly('nik');
            $this->validateOnly('jenis_kelamin');
            $this->validateOnly('nama_lengkap');
            $this->validateOnly('alamat');
            $this->validateOnly('nama_ayah');
            $this->validateOnly('nama_ibu');
            $this->validateOnly('kedudukan_keluarga');
            $this->validateOnly('tempat_lahir');
            $this->validateOnly('tanggal_lahir');
            $this->validateOnly('golongan_darah');
            $this->validateOnly('agama');
            $this->validateOnly('status_perkawinan');
            $this->validateOnly('pendidikan_terakhir');
            $this->validateOnly('pekerjaan');
            $this->validateOnly('baca_huruf');
            $this->validateOnly('dusun');
            $this->validateOnly('asal_penduduk');
            $this->validateOnly('tanggal_penambahan');
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function store()
    {
            $validated = $this->validate();

            $kartuKeluargaData = [
                'nomor_kartu_keluarga' => $validated['nomor_kartu_keluarga'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'alamat_kk' => $validated['alamat_kk'],
                'rt' => $validated['rt'],
                'rw' => $validated['rw'],
                'desa_kelurahan' => $validated['desa_kelurahan'],
                'kecamatan' => $validated['kecamatan'],
                'kode_pos' => $validated['kode_pos'],
                'kabupaten_kota' => $validated['kabupaten_kota'],
                'provinsi' => $validated['provinsi']
            ];

            $kepalaKeluargaData = [
                'nik' => $validated['nik'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'nama_lengkap' => $validated['nama_lengkap'],
                'alamat' => $validated['alamat'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'golongan_darah' => $validated['golongan_darah'],
                'agama' => $validated['agama'],
                'status_perkawinan' => $validated['status_perkawinan'],
                'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
                'pekerjaan' => $validated['pekerjaan'],
                'baca_huruf' => $validated['baca_huruf'],
                'nama_ayah' => $validated['nama_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'kedudukan_keluarga' => $validated['kedudukan_keluarga'],
                'dusun' => $validated['dusun'],
                'asal_penduduk' => $validated['asal_penduduk'],
                'tanggal_penambahan' => $validated['tanggal_penambahan'],
            ];

            $kartuKeluargaId  = DB::table('kartu_keluarga')->insertGetId($kartuKeluargaData);

            $kepalaKeluargaData['id_kartu_keluarga'] = $kartuKeluargaId;

            DB::table('penduduk')->insert($kepalaKeluargaData);

            // Commit the transaction
            DB::commit();

            // Reset the form fields
            $this->reset([
                'nomor_kartu_keluarga',
                'tanggal_keluar',
                'alamat_kk',
                'rt',
                'rw',
                'desa_kelurahan',
                'kecamatan',
                'kode_pos',
                'kabupaten_kota',
                'provinsi',
                'nik',
                'jenis_kelamin',
                'nama_lengkap',
                'alamat',
                'tempat_lahir',
                'tanggal_lahir',
                'golongan_darah',
                'agama',
                'status_perkawinan',
                'pendidikan_terakhir',
                'pekerjaan',
                'baca_huruf',
                'nama_ayah',
                'nama_ibu',
                'kedudukan_keluarga',
                'dusun',
                'asal_penduduk',
                'tanggal_penambahan',
            ]);
            // Redirect to index page
            return redirect()->route('kartuKeluarga')->with('success', 'Data kartu keluarga berhasil disimpan!');
    }


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.kartu-keluarga.create',
            [
                'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
                'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
                'kkData' => DB::table('kartu_keluarga')->where('is_deleted', 0)->get(),
            ]
        );
    }
}
