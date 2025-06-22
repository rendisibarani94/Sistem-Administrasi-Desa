<?php

namespace App\Livewire\Masyarakat;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BerandaController extends Component
{

    #[Layout('components.layouts.masyarakat')]
    public function render()
    {
        $profil = DB::table('profil')->pluck('value', 'key');
        $beritaData = DB::table('berita')
            ->where('is_deleted', 0)
            ->orderBy('id_berita', 'desc')
            ->limit(3)
            ->get();

        $positions = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Umum dan Tata Usaha',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan'
        ];

        // Get active aparatur desa with required fields
        $perangkatDesa = DB::table('aparatur_desa')
            ->select('id_aparatur', 'jabatan', 'nama_lengkap', 'foto')
            ->where('is_active', true)
            ->whereIn('jabatan', $positions)
            ->where('is_deleted',0)
            ->get();

        return view(
            'masyarakat.beranda',
            [
                'profil' => $profil,
                'beritaData' => $beritaData,
                'perangkatDesa' => $perangkatDesa
            ]
        );
    }
}
