<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BerandaAdminController extends Component
{
    #[Layout('components.layouts.layouts')]
    public function render()
    {
        // Query untuk mendapatkan jumlah data dari setiap tabel
        $stats = [
            'peraturan_desa' => DB::table('peraturan_desa')->where('is_deleted', 0)->count(),
            'keputusan_kepala_desa' => DB::table('keputusan_kepala_desa')->where('is_deleted', 0)->count(),
            'aparatur_desa' => DB::table('aparatur_desa')->where('is_deleted', 0)->count(),
            'tanah_kas_desa' => DB::table('tanah_kas_desa')->where('is_deleted', 0)->count(),
            'tanah_desa' => DB::table('tanah_desa')->where('is_deleted', 0)->count(),
            'inventaris_desa' => DB::table('inventaris_desa')->where('is_deleted', 0)->count(),
            'agenda_surat' => DB::table('agenda_surat')->where('is_deleted', 0)->count(),
            'penduduk' => DB::table('penduduk')->where('is_deleted', 0)->where('is_deleted', 0)->count(),
            'kartu_keluarga' => DB::table('kartu_keluarga')->where('is_deleted', 0)->where('is_deleted', 0)->count(),
            'penduduk_sementara' => DB::table('penduduk_sementara')->where('is_deleted', 0)->count(),
            'kader_pemberdayaan' => DB::table('kader_pemberdayaan')->where('is_deleted', 0)->count(),
            'pembangunan' => DB::table('pembangunan')->where('is_deleted', 0)->count(),
        ];

        return view('admin.beranda', [
            'stats' => $stats
        ]);
    }
}
