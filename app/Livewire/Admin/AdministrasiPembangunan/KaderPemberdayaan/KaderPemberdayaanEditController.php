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
    #[Rule('max:100', message: 'Input Nama Terlalu Panjang!')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi!')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Pendidikan Harus Diisi!')]
    public $pendidikan;

    #[Rule('required', message: 'Kolom Bidang Keahlian Harus Diisi!')]
    public $bidang_keahlian;

    #[Rule('required', message: 'Kolom Alamat Harus Diisi!')]
    #[Rule('max:150', message: 'Input Alamat Terlalu Panjang!')]
    public $alamat;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang!')]
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
            'admin.pembangunan.kader-pemberdayaan-masyarakat.edit',
            [
                'bidangKeahlianData' => DB::table('bidang_keahlian')
                    ->where('is_deleted', 0)
                    ->orderBy('id_bidang_keahlian', 'desc')
                    ->paginate(10),
            ]
        );
    }


}
