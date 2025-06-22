<?php
namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukDetailMutasiController extends Component
{
    public $id_penduduk_pindah;

    public function mount($id)
    {
        $this->id_penduduk_pindah = $id;
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
            $pendudukData = DB::table('penduduk')
            ->join('pekerjaan', 'penduduk.pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->select('penduduk.*', 'pekerjaan.pekerjaan', 'kartu_keluarga.nomor_kartu_keluarga') // Select required fields
            ->where('penduduk.id_penduduk', $this->id_penduduk_pindah)
            ->first();

        return view('admin.kependudukan.induk-penduduk.detail-mutasi', ['pendudukData' => $pendudukData]);
    }
}
