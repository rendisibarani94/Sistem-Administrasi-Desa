<?php

namespace App\Livewire\Admin\Kependudukan\KartuKeluarga;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class KartuKeluargaDetailController extends Component
{
    use WithPagination;

    public $id_kartu_keluarga;

    public function mount($id_kartu_keluarga)
    {
        $this->id_kartu_keluarga = $id_kartu_keluarga;
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $kartuKeluargaData = DB::table('kartu_keluarga')
            ->select('kartu_keluarga.*', 'penduduk.nama_lengkap as nama_kepala_keluarga')
            ->leftJoin('penduduk', function ($join) {
                $join->on('kartu_keluarga.id_kartu_keluarga', '=', 'penduduk.id_kartu_keluarga')
                    ->where('penduduk.kedudukan_keluarga', '=', 'KEPALA KELUARGA');
            })
            ->where('kartu_keluarga.is_deleted', 0)
            ->where('kartu_keluarga.id_kartu_keluarga', $this->id_kartu_keluarga )
            ->first();

        $anggotaKeluarga = DB::table('penduduk')
            ->select('penduduk.*', 'pekerjaan.pekerjaan as nama_pekerjaan')
            ->leftJoin('pekerjaan', function ($join) {
                $join->on('penduduk.pekerjaan', '=', 'pekerjaan.id_pekerjaan');
            })
            ->where('penduduk.is_deleted', 0)
            ->where('penduduk.is_mutated', 0)
            ->where('penduduk.id_kartu_keluarga', $this->id_kartu_keluarga)
            ->orderBy('penduduk.kedudukan_keluarga','asc')
            ->get();

        return view(
            'admin.kependudukan.kartu-keluarga.detail',
            [
                'kartuKeluargaData' => $kartuKeluargaData,
                'anggotaKeluarga' => $anggotaKeluarga,
                ]
        );
    }
}
