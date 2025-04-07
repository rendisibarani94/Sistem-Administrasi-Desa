<?php
namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukPindahController extends Component
{
    #[Rule('required', message: 'Kolom Tanggal Pengurangan Harus Diisi!')]
    public $tanggal_pengurangan;

    #[Rule('max:255', message: 'Input Tujuan Pindah Terlalu Panjang!')]
    public $tujuan_pindah;

    #[Rule('max:255', message: 'Input Tempat Meninggal Terlalu Panjang!')]
    public $tempat_meninggal;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang!')]
    public $keterangan;

    public $pindahId;

    public function mount($id){
        $this->pindahId = $id;
    }

    public function pindah(){
        $validated = $this->validate();

        $data = [
            'tanggal_pengurangan' => $this->tanggal_pengurangan,
            'tujuan_pindah' => $this->tujuan_pindah,
            'tempat_meninggal' => $this->tempat_meninggal,
            'keterangan' => $this->keterangan,
            'updated_at' => now()
        ];

        DB::table('penduduk')->where('id_penduduk', $this->pindahId)->update($data);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.kependudukan.induk-penduduk.pindah');
    }
}