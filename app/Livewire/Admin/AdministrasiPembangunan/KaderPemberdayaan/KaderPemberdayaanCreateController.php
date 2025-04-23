<?php

namespace App\Livewire\Admin\AdministrasiPembangunan\KaderPemberdayaan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KaderPemberdayaanCreateController extends Component
{
    #[Rule('required', message: 'Kolom Nama Kader Harus Diisi!')]
    #[Rule('max:150', message: 'Input Nama Terlalu Panjang!')]
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
    #[Rule('max:255', message: 'Input Alamat Terlalu Panjang!')]
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


    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.pembangunan.kader-pemberdayaan-masyarakat.create',
            [
                'bidangKeahlianData' => DB::table('bidang_keahlian')
                    ->where('is_deleted', 0)
                    ->orderBy('id_bidang_keahlian', 'desc')
                    ->paginate(10),
            ]
        );
    }


}