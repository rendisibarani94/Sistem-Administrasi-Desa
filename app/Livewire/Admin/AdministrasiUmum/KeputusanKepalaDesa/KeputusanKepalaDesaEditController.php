<?php

namespace App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KeputusanKepalaDesaEditController extends Component
{
    public $id_keputusan_kepala_desa;

    #[Rule('required', message: 'Kolom Tanggal Keputusan Kepala Desa Harus Diisi!')]
    public $tanggal_keputusan;

    #[Rule('required', message: 'Kolom Perihal Keputusan Kepala Desa Harus Diisi!')]
    public $tentang;

    #[Rule('required', message: 'Kolom Uraian Harus Diisi!')]
    #[Rule('max:255', message: 'Input Uraian Terlalu Panjang!')]
    public $uraian;

    public $tanggal_dilaporkan;

    #[Rule('max:150', message: 'Input Tujuan Pelaporan Lengkap Terlalu Panjang!')]
    public $tujuan_dilaporkan;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang!')]
    public $keterangan;

    public function mount($id_keputusan_kepala_desa)
    {
        $this->id_keputusan_kepala_desa = $id_keputusan_kepala_desa;
        $this->loadEditData();
    }

    public function loadEditData(){
        $kkd = DB::table('keputusan_kepala_desa')->where('id_keputusan_kepala_desa', $this->id_keputusan_kepala_desa)->first();

        $this->tanggal_keputusan = $kkd->tanggal_keputusan;
        $this->tentang = $kkd->tentang;
        $this->uraian = $kkd->uraian;
        $this->tanggal_dilaporkan = $kkd->tanggal_dilaporkan;
        $this->keterangan = $kkd->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['tanggal_dilaporkan'] = $this->tanggal_dilaporkan;

        $data = [
            'tanggal_keputusan' => $this->tanggal_keputusan,
            'tentang' => $this->tentang,
            'uraian' => $this->uraian,
            'tanggal_dilaporkan' => $this->tanggal_dilaporkan,
            'keterangan' => $this->keterangan,
            'updated_at' => now()
        ];

        DB::table('keputusan_kepala_desa')->where('id_keputusan_kepala_desa', $this->id_keputusan_kepala_desa)->update($data);

        return redirect()->route('keputusanKepalaDesa')->with('success', 'Data Keputusan Kepala Desa Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render(){
        return view('admin.umum.keputusan-kepala-desa.edit');
    }

}
