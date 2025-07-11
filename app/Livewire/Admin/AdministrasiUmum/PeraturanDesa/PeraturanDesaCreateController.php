<?php

namespace App\Livewire\Admin\AdministrasiUmum\PeraturanDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class PeraturanDesaCreateController extends Component
{
    #[Rule('required', message: 'Kolom Perihal Peraturan Desa Harus Diisi!')]
    #[Rule('max:200', message: 'Input Perihal Peraturan Desa maksimal 200 digit karakter')]
    public $tentang;

    #[Rule('required', message: 'Kolom Jenis Peraturan Desa Harus Diisi!')]
    public $jenis_peraturan;

    #[Rule('required', message: 'Kolom Tanggal Dilaporkan Harus Diisi!')]
    public $tanggal_dilaporkan;

    #[Rule('required', message: 'Kolom Tujuan Dilaporkan Harus Diisi!')]
    #[Rule('max:100', message: 'Input Tujuan Dilaporkan maksimal 100 digit karakter')]
    public $tujuan_dilaporkan;

    #[Rule('required', message: 'Kolom Tanggal Ditetapkan Harus Diisi!')]
    public $tanggal_ditetapkan;

    #[Rule('required', message: 'Kolom Tanggal Kesepakatan Harus Diisi!')]
    public $tanggal_kesepakatan;

    #[Rule('required', message: 'Kolom Tanggal Diundangkan Harus Diisi!')]
    public $tanggal_diundangkan_berita_desa;

    #[Rule('required', message: 'Kolom Uraian Singkat Harus Diisi!')]
    #[Rule('max:200', message: 'Input Uraian Singkat maksimal 200 digit karakter')]
    public $uraian_singkat;

    #[Rule('max:255', message: 'Input Keterangan maksimal 255 digit karakter')]
    public $keterangan;

    public function store()
    {
        $validated = $this->validate();

        DB::table('peraturan_desa')->insert($validated);

        $this->reset([
            'tentang',
            'jenis_peraturan',
            'tanggal_ditetapkan',
            'tanggal_kesepakatan',
            'tujuan_dilaporkan',
            'tanggal_dilaporkan',
            'tanggal_diundangkan_berita_desa',
            'uraian_singkat'
        ]);

        return redirect()->route('PeraturanDesa')->with('success', 'Data Peraturan Desa berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.peraturan-desa.create'
        );
    }
}
