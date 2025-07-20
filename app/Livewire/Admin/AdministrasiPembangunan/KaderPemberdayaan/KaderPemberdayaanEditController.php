<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KaderPemberdayaanEditController extends Component
{
    public $id_kader_pemberdayaan;

    #[Rule('required', message: 'Kolom Nama Kader Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Lengkap Maksimal 100 digit karakter!')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi!')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Pendidikan Harus Diisi!')]
    public $pendidikan;

    #[Rule('required', message: 'Kolom Bidang Keahlian Harus Diisi!')]
    #[Rule('max:50', message: 'Input Bidang Keahlian Maksimal 50 digit karakter!')]
    public $bidang_keahlian;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:150', message: 'Input Alamat Maksimal 150 digit karakter!')]
    public $alamat;

    #[Rule('max:255', message: 'Input Keterangan Maksimal 255 digit karakter!')]
    public $keterangan;


    public function store()
    {
        $validated = $this->validate();

        DB::table('kader_pemberdayaan')->insert($validated);

        $this->reset();

        return redirect()->route('KaderPemberdayaanMasyarakat')->with('success', 'Data Kader Pemberdayaan Masyarakat berhasil disimpan!');
    }

    public function mount($id_kader_pemberdayaan)
    {
        $this->id_kader_pemberdayaan = $id_kader_pemberdayaan;
        $this->loadEditData();
    }

    public function loadEditData(){
        $kpm = DB::table('kader_pemberdayaan')
        ->where('id_kader_pemberdayaan', $this->id_kader_pemberdayaan)
        ->first();

        $this->nama_lengkap = $kpm->nama_lengkap;
        $this->tanggal_lahir = $kpm->tanggal_lahir;
        $this->jenis_kelamin = $kpm->jenis_kelamin;
        $this->pendidikan = $kpm->pendidikan;
        $this->bidang_keahlian = $kpm->bidang_keahlian;
        $this->alamat = $kpm->alamat;
        $this->keterangan = $kpm->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('kader_pemberdayaan')
        ->where('id_kader_pemberdayaan', $this->id_kader_pemberdayaan)
        ->update($validated);

        return redirect()->route('KaderPemberdayaanMasyarakat')->with('success', 'Data Kader Pemberdayaan Masyarakat Berhasil Diubah');

    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.pembangunan.kader-pemberdayaan-masyarakat.edit'
        );
    }


}
