<?php

namespace App\Livewire\Admin\AdministrasiUmum\PeraturanDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class PeraturanDesaEditController extends Component
{
    public $id_peraturan_desa;

    #[Rule('required', message: 'Kolom Perihal Peraturan Desa Harus Diisi!')]
    #[Rule('max:200', message: 'Input Perihal Peraturan Desa maksimal 200 digit karakter!')]
    public $tentang;

    #[Rule('required', message: 'Kolom Jenis Peraturan Desa Harus Diisi!')]
    public $jenis_peraturan;

    #[Rule('required', message: 'Kolom Tanggal Dilaporkan Harus Diisi!')]
    public $tanggal_dilaporkan;

    #[Rule('required', message: 'Kolom Tujuan Dilaporkan Harus Diisi!')]
    #[Rule('max:100', message: 'Input Tujuan Dilaporkan maksimal 100 digit karakter!')]
    public $tujuan_dilaporkan;

    #[Rule('required', message: 'Kolom Tanggal Ditetapkan Harus Diisi!')]
    public $tanggal_ditetapkan;

    #[Rule('required', message: 'Kolom Tanggal Kesepakatan Harus Diisi!')]
    public $tanggal_kesepakatan;

    #[Rule('required', message: 'Kolom Tanggal Diundangkan Harus Diisi!')]
    public $tanggal_diundangkan_berita_desa;

    #[Rule('required', message: 'Kolom Uraian Singkat Harus Diisi!')]
    #[Rule('max:200', message: 'Input Uraian Singkat maksimal 200 digit karakter!')]
    public $uraian_singkat;

    #[Rule('max:255', message: 'Input Keterangan maksimal 255 digit karakter!')]
    public $keterangan;

    public function mount($id_peraturan_desa)
    {
        $this->id_peraturan_desa = $id_peraturan_desa;
        $this->loadEditData();
    }

    public function loadEditData()
    {
        $pd = DB::table('peraturan_desa')->where('id_peraturan_desa', $this->id_peraturan_desa)->first();

        $this->tentang = $pd->tentang;
        $this->jenis_peraturan = $pd->jenis_peraturan;
        $this->tanggal_ditetapkan = $pd->tanggal_ditetapkan;
        $this->tanggal_kesepakatan = $pd->tanggal_kesepakatan;
        $this->tujuan_dilaporkan = $pd->tujuan_dilaporkan;
        $this->tanggal_dilaporkan = $pd->tanggal_dilaporkan;
        $this->tanggal_diundangkan_berita_desa = $pd->tanggal_diundangkan_berita_desa;
        $this->uraian_singkat = $pd->uraian_singkat;
        $this->keterangan = $pd->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('peraturan_desa')->where('id_peraturan_desa', $this->id_peraturan_desa)->update($validated);

        return redirect()->route('PeraturanDesa')->with('success', 'Data Peraturan Desa Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.peraturan-desa.edit'
        );
    }
}
