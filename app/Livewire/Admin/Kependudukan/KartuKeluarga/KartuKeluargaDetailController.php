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
        // Detail KK + Kepala Keluarga
        $kartuKeluargaData = DB::table('kartu_keluarga')
            ->leftJoin('penduduk', function ($join) {
                $join->on('kartu_keluarga.id_kartu_keluarga', '=', 'penduduk.id_kartu_keluarga')
                    ->where('penduduk.kedudukan_keluarga', 'KEPALA KELUARGA')
                    ->where('penduduk.is_deleted', 0)
                    ->where('penduduk.is_mutated', 0);
            })
            ->select(
                'kartu_keluarga.*',
                'penduduk.nama_lengkap as nama_kepala_keluarga'
            )
            ->where('kartu_keluarga.is_deleted', 0)
            ->where('kartu_keluarga.id_kartu_keluarga', $this->id_kartu_keluarga)
            ->first();

        // Semua anggota keluarga
        $anggotaKeluarga = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('is_mutated', 0)
            ->where('id_kartu_keluarga', $this->id_kartu_keluarga)
            ->orderByRaw("
                CASE
                    WHEN kedudukan_keluarga = 'KEPALA KELUARGA' THEN 1
                    WHEN kedudukan_keluarga = 'ISTRI' THEN 2
                    WHEN kedudukan_keluarga = 'ANAK' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view(
            'admin.kependudukan.kartu-keluarga.detail',
            [
                'kartuKeluargaData' => $kartuKeluargaData,
                'anggotaKeluarga'   => $anggotaKeluarga,
            ]
        );
    }
}