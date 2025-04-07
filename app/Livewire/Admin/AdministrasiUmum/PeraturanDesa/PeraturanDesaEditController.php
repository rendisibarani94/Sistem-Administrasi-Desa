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
    #[Rule('max:255', message: 'Input Perihal Peraturan Desa Terlalu Panjang!')]
    public $tentang;

    #[Rule('required', message: 'Kolom Jenis Peraturan Desa Harus Diisi!')]
    public $jenis_peraturan;

    #[Rule('required', message: 'Kolom Tanggal Dilaporkan Harus Diisi!')]
    public $tanggal_dilaporkan;

    #[Rule('required', message: 'Kolom Tujuan Dilaporkan Harus Diisi!')]
    #[Rule('max:255', message: 'Input Tujuan Dilaporkan Terlalu Panjang!')]
    public $tujuan_dilaporkan;

    #[Rule('required', message: 'Kolom Tanggal Ditetapkan Harus Diisi!')]
    public $tanggal_ditetapkan;

    #[Rule('required', message: 'Kolom Tanggal Kesepakatan Harus Diisi!')]
    public $tanggal_kesepakatan;

    #[Rule('required', message: 'Kolom Tanggal Diundangkan Harus Diisi!')]
    public $tanggal_diundangkan_berita_desa;

    #[Rule('required', message: 'Kolom Uraian Singkat Harus Diisi!')]
    #[Rule('max:255', message: 'Input Uraian Singkat Terlalu Panjang!')]
    public $uraian_singkat;

    public function mount($id_peraturan_desa)
    {
        $this->id_peraturan_desa = $id_peraturan_desa;
        $this->loadEditData();
    }

    public function loadEditData(){
        $pd = DB::table('peraturan_desa')->where('id_peraturan_desa', $this->id_peraturan_desa)->first();

        $this->tentang = $pd->tentang;
        $this->jenis_peraturan = $pd->jenis_peraturan;
        $this->tanggal_ditetapkan = $pd->tanggal_ditetapkan;
        $this->tanggal_kesepakatan = $pd->tanggal_kesepakatan;
        $this->tujuan_dilaporkan = $pd->tujuan_dilaporkan;
        $this->tanggal_dilaporkan = $pd->tanggal_dilaporkan;
        $this->tanggal_diundangkan_berita_desa = $pd->tanggal_diundangkan_berita_desa;
        $this->uraian_singkat = $pd->uraian_singkat;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('peraturan_desa')->where('id_peraturan_desa', $this->id_peraturan_desa)->update($validated);

        return redirect()->route('PeraturanDesa')->with('success', 'Data Peraturan Desa Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.peraturan-desa.edit',
            [
                'jenisPeraturanData' => DB::table('jenis_peraturan')
                    ->where('is_deleted', 0)
                    ->orderBy('id_jenis_peraturan', 'desc')
                    ->get()
            ]
        );
    }

}
