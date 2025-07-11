<?php

namespace App\Livewire\Admin\Kependudukan\PendudukSementara;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class PendudukSementaraEditController extends Component
{
    public $id_penduduk;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Lengkap maksimal 100 digit karakter')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;


    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi!')]
    #[Rule('max:150', message: 'Input Tempat Lahir maksumal 150 digit karakter!')]
    public $tempat_lahir;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi!')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Pekerjaan Harus Diisi!')]
    public $pekerjaan;

    #[Rule('required', message: 'Kolom Kewarganegaraan Harus Diisi!')]
    public $kewarganegaraan;

    #[Rule('required', message: 'Kolom Keturunan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Keturunan maksimal 50 digit karakter!')]
    public $keturunan;

    #[Rule('required', message: 'Kolom Asal Kedatangan Harus Diisi!')]
    #[Rule('max:150', message: 'Input Asal Kedatangan maksimal 150 digit karakter')]
    public $asal;

    #[Rule('required', message: 'Kolom Maksud Kedatangan Harus Diisi!')]
    #[Rule('max:255', message: 'Input Maksud Kedatangan maksimal 255 digit karakter')]
    public $maksud_kedatangan;

    #[Rule('required', message: 'Kolom Tokoh Tujuan Harus Diisi!')]
    #[Rule('max:100', message: 'Input Tokoh Tujuan maksimal 100 digit karakter')]
    public $tokoh_tujuan;

    #[Rule('required', message: 'Kolom Alamat Tujuan Harus Diisi!')]
    #[Rule('max:150', message: 'Input Alamat Tujuan maksimal 150 digit karakter')]
    public $alamat_tujuan;

    #[Rule('required', message: 'Kolom Tanggal Kedatangan Harus Diisi!')]
    public $tanggal_kedatangan;

    #[Rule('required', message: 'Kolom Tanggal Kepulangan Harus Diisi!')]
    public $tanggal_kepulangan;

    #[Rule('required', message: 'Kolom Keterangan Harus Diisi!')]
    #[Rule('max:255', message: 'Input Keterangan maksimal 255 digit karakter')]
    public $keterangan;

    public function mount($id_penduduk)
    {
        $this->id_penduduk = $id_penduduk;
        $this->loadPendudukSementara();
    }

    public function loadPendudukSementara(){
    $pendudukSementara = DB::table('penduduk_sementara')->where('id_penduduk', $this->id_penduduk)->first();

    $this->nama_lengkap = $pendudukSementara->nama_lengkap;
    $this->jenis_kelamin = $pendudukSementara->jenis_kelamin;
    $this->tempat_lahir = $pendudukSementara->tempat_lahir;
    $this->tanggal_lahir = $pendudukSementara->tanggal_lahir;
    $this->pekerjaan = $pendudukSementara->pekerjaan;
    $this->kewarganegaraan = $pendudukSementara->kewarganegaraan;
    $this->keturunan = $pendudukSementara->keturunan;
    $this->asal = $pendudukSementara->asal;
    $this->maksud_kedatangan = $pendudukSementara->maksud_kedatangan;
    $this->tokoh_tujuan = $pendudukSementara->tokoh_tujuan;
    $this->alamat_tujuan = $pendudukSementara->alamat_tujuan;
    $this->tanggal_kedatangan = $pendudukSementara->tanggal_kedatangan;
    $this->tanggal_kepulangan = $pendudukSementara->tanggal_kepulangan;
    $this->keterangan = $pendudukSementara->keterangan;
    }

    public function update(){
        // Validate the form inputs
        $validated = $this->validate();

        $data = [
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'pekerjaan' => $this->pekerjaan,
            'kewarganegaraan' => $this->kewarganegaraan,
            'keturunan' => $this->keturunan,
            'asal' => $this->asal,
            'maksud_kedatangan' => $this->maksud_kedatangan,
            'tokoh_tujuan' => $this->tokoh_tujuan,
            'alamat_tujuan' => $this->alamat_tujuan,
            'tanggal_kedatangan' => $this->tanggal_kedatangan,
            'tanggal_kepulangan' => $this->tanggal_kepulangan,
            'keterangan' => $this->keterangan,
            'updated_at' => now()
        ];

        DB::table('penduduk_sementara')->where('id_penduduk', $this->id_penduduk)->update($data);

        return redirect()->route('pendudukSementara')->with('success', 'Data Penduduk Sementara Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.penduduk-sementara.edit',
            [
                'pekerjaanData' => DB::table('pekerjaan')->where('is_deleted', 0)->get(),
            ]
        );
    }
}
