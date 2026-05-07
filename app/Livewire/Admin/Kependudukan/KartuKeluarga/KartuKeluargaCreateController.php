<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class KartuKeluargaCreateController extends Component
{
    public $currentStep = 1;

    // =====================================
    // STEP 1 : DATA KARTU KELUARGA
    // =====================================
    #[Rule('required|size:16|unique:kartu_keluarga,nomor_kartu_keluarga')]
    public $nomor_kartu_keluarga;

    #[Rule('required|date')]
    public $tanggal_keluar;

    #[Rule('required|max:150')]
    public $alamat_kk;

    #[Rule('required|regex:/^[\d\-]+$/')]
    public $rt;

    #[Rule('required|regex:/^[\d\-]+$/')]
    public $rw;

    #[Rule('required|max:50')]
    public $desa_kelurahan;

    #[Rule('required|max:50')]
    public $kecamatan;

    #[Rule('required|digits:5')]
    public $kode_pos;

    #[Rule('required|max:50')]
    public $kabupaten_kota;

    #[Rule('required|max:50')]
    public $provinsi;

// =====================================
// STEP 2 : DATA KEPALA KELUARGA
// =====================================
    #[Rule('required|size:16|unique:penduduk,nik')]
    public $nik;


    #[Rule('required')]
    public $jenis_kelamin;

    #[Rule('required|max:150')]
    public $nama_lengkap;

    #[Rule('required|max:150')]
    public $alamat;

    #[Rule('required|max:150')]
    public $tempat_lahir;

    #[Rule('required|date')]
    public $tanggal_lahir;

    #[Rule('required|max:50')]
    public $kewarganegaraan;

    #[Rule('nullable|max:30')]
    public $nomor_akta_lahir;

    #[Rule('nullable|date')]
    public $tanggal_keluar_ktp;

    #[Rule('required|max:50')]
    public $keturunan;

    #[Rule('required')]
    public $golongan_darah;

    #[Rule('required')]
    public $agama;

    #[Rule('required')]
    public $status_perkawinan;

    #[Rule('required')]
    public $pendidikan_terakhir;

    #[Rule('required|max:100')]
    public $pekerjaan;

    #[Rule('required')]
    public $baca_huruf;

    #[Rule('required|max:150')]
    public $nama_ayah;

    #[Rule('required|max:150')]
    public $nama_ibu;

    #[Rule('required')]
    public $dusun;

    #[Rule('required|max:150')]
    public $asal_penduduk;

    #[Rule('nullable|digits_between:10,15')]
    public $nomor_telepon;

    #[Rule('required|date')]
    public $tanggal_penambahan;

    #[Rule('nullable|max:255')]
    public $keterangan;

    // =====================================
    // NEXT STEP
    // =====================================
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
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    // =====================================
    // STORE
    // =====================================
    public function store()
{
    DB::beginTransaction();

    try {
        $validated = $this->validate();

        $kkId = DB::table('kartu_keluarga')->insertGetId([
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
            'is_deleted'           => 0,
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

        DB::table('penduduk')->insert([
            'nik'                 => $this->nik,
            'jenis_kelamin'       => $this->jenis_kelamin,
            'nama_lengkap'        => $this->nama_lengkap,
            'alamat'              => $this->alamat,
            'tempat_lahir'        => $this->tempat_lahir,
            'tanggal_lahir'       => $this->tanggal_lahir,
            'kewarganegaraan'     => $this->kewarganegaraan,
            'nomor_akta_lahir'    => $this->nomor_akta_lahir ?: null,
            'tanggal_keluar_ktp'  => $this->tanggal_keluar_ktp ?: null,
            'keturunan'           => $this->keturunan,
            'golongan_darah'      => $this->golongan_darah,
            'agama'               => $this->agama,
            'status_perkawinan'   => $this->status_perkawinan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pekerjaan'           => $this->pekerjaan,
            'baca_huruf'          => $this->baca_huruf,
            'nama_ayah'           => $this->nama_ayah,
            'nama_ibu'            => $this->nama_ibu,
            'kedudukan_keluarga'  => 'KEPALA KELUARGA',
            'dusun'               => $this->dusun,
            'asal_penduduk'       => $this->asal_penduduk,
            'nomor_telepon'       => $this->nomor_telepon ?: null,
            'tanggal_penambahan'  => $this->tanggal_penambahan,
            'keterangan'          => $this->keterangan ?: null,
            'id_kartu_keluarga'   => $kkId,
            'is_deleted'          => 0,
            'is_mutated'          => 0,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        DB::commit();

        $this->reset();

        session()->flash('success', 'Data kartu keluarga berhasil ditambahkan.');

        return redirect()->route('kartuKeluarga');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        // Tampilkan field mana yang gagal validasi
        dd($e->errors()); // ← SEMENTARA untuk debug

    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage()); // ← SEMENTARA untuk debug
    }
}

    // =====================================
    // VIEW
    // =====================================
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.kartu-keluarga.create', [
            'dusunData' => DB::table('dusun')
                ->where('is_deleted', 0)
                ->get()
        ]);
    }
}