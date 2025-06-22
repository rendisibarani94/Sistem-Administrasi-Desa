<?php

namespace App\Livewire\Admin\AdministrasiUmum\KeputusanKepalaDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class KeputusanKepalaDesaCreateController extends Component
{
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

    public function store()
    {
        $validated = $this->validate();
        $validated['tanggal_dilaporkan'] = $this->tanggal_dilaporkan;

        DB::table('keputusan_kepala_desa')->insert($validated);


        $this->reset([
            'tanggal_keputusan',
            'tentang',
            'uraian',
            'tanggal_dilaporkan',
            'tujuan_dilaporkan',
            'keterangan',
        ]);

        return redirect()->route('keputusanKepalaDesa')->with('success', 'Data Keputusan Kepala Desa berhasil disimpan!');

    }


    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.keputusan-kepala-desa.create');
    }
}
