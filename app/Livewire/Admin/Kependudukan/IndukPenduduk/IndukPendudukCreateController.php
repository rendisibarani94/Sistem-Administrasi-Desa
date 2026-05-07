<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukCreateController extends Component
{
    #[Rule(
        ['required', 'max:50'],
        message: [
            'required' => 'Kolom Kewarganegaraan Harus Diisi!',
            'max'      => 'Input Kewarganegaraan Maksimal 50 karakter!',
        ]
    )]
    public $kewarganegaraan;

    #[Rule(
        ['required', 'max:50'],
        message: [
            'required' => 'Kolom Keturunan Harus Diisi!',
            'max'      => 'Input Keturunan Maksimal 50 karakter!',
        ]
    )]
    public $keturunan;

    #[Rule('nullable|date', message: 'Tanggal Keluar KTP harus berupa tanggal!')]
    public $tanggal_keluar_ktp;

    #[Rule(
        ['required', 'size:16', 'unique:penduduk,nik'],
        message: [
            'required' => 'Kolom NIK Harus Diisi!',
            'size'     => 'Input NIK Harus 16 Karakter!',
            'unique'   => 'NIK sudah terdaftar!',
        ]
    )]
    public $nik;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule(
        ['required', 'max:100'],
        message: [
            'required' => 'Kolom Nama Lengkap Harus Diisi!',
            'max'      => 'Input Nama Lengkap Maksimal 100 karakter!',
        ]
    )]
    public $nama_lengkap;

    #[Rule(
        ['required', 'max:150'],
        message: [
            'required' => 'Kolom Alamat Harus Diisi!',
            'max'      => 'Input Alamat Maksimal 150 karakter!',
        ]
    )]
    public $alamat;

    #[Rule('required', message: 'Input Kartu Keluarga Harus Diisi!')]
    public $id_kartu_keluarga;

    #[Rule(
        ['required', 'max:150'],
        message: [
            'required' => 'Kolom Tempat Lahir Harus Diisi!',
            'max'      => 'Input Tempat Lahir Maksimal 150 karakter!',
        ]
    )]
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

    #[Rule(
        ['required', 'max:100'],
        message: [
            'required' => 'Kolom Pekerjaan Harus Diisi!',
            'max'      => 'Input Pekerjaan Maksimal 100 karakter!',
        ]
    )]
    public $pekerjaan;

    #[Rule('required', message: 'Kolom Baca Huruf Harus Diisi!')]
    public $baca_huruf;

    #[Rule(
        ['required', 'max:100'],
        message: [
            'required' => 'Kolom Nama Ayah Harus Diisi!',
            'max'      => 'Input Nama Ayah Maksimal 100 karakter!',
        ]
    )]
    public $nama_ayah;

    #[Rule(
        ['required', 'max:100'],
        message: [
            'required' => 'Kolom Nama Ibu Harus Diisi!',
            'max'      => 'Input Nama Ibu Maksimal 100 karakter!',
        ]
    )]
    public $nama_ibu;

    #[Rule('required', message: 'Kolom Kedudukan Keluarga Harus Diisi!')]
    public $kedudukan_keluarga;

    #[Rule('required', message: 'Kolom Dusun Harus Diisi!')]
    public $dusun;

    #[Rule(
        ['required', 'max:150'],
        message: [
            'required' => 'Kolom Asal Penduduk Harus Diisi!',
            'max'      => 'Input Asal Penduduk Maksimal 150 karakter!',
        ]
    )]
    public $asal_penduduk;

    #[Rule('nullable|max:30', message: 'Input Nomor Akta Lahir Maksimal 30 karakter!')]
    public $nomor_akta_lahir;

    #[Rule('nullable|digits_between:10,15', message: 'Nomor telepon harus 10-15 digit angka!')]
    public $nomor_telepon;

    #[Rule('nullable|max:50', message: 'Input Suku Maksimal 50 karakter!')]
    public $suku;

    #[Rule('required', message: 'Kolom Tanggal Penambahan Harus Diisi!')]
    public $tanggal_penambahan;

    #[Rule('nullable|max:255', message: 'Input Keterangan Maksimal 255 karakter!')]
    public $keterangan;

    public function store()
    {
        $validated = $this->validate();

        $validated['is_deleted']  = 0;
        $validated['is_mutated']  = 0;
        $validated['created_at']  = now();
        $validated['updated_at']  = now();

        DB::table('penduduk')->insert($validated);

        $this->reset();

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

        return view('admin.kependudukan.induk-penduduk.create', [
            'dusunData' => DB::table('dusun')->where('is_deleted', 0)->get(),
            'kkData'    => $kkData,
        ]);
    }
}