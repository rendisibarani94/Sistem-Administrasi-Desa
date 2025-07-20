<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KaderPemberdayaanCreateController extends Component
{
    #[Rule('required', message: 'Kolom Nama Kader Harus Diisi!')]
    #[Rule('max:100', message: 'Input nama maksimal 100 digit karakter!')]
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
    #[Rule('max:150', message: 'Input alamat maksimal 150 digit karakter!')]
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


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.pembangunan.kader-pemberdayaan-masyarakat.create',
        );
    }


}
