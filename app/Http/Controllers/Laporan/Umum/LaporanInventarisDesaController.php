<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanInventarisDesaController extends Controller
{
    public function displayA3()
    {
        $inventarisDesa = DB::table('inventaris_desa')
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $inventarisDesaDihapus = DB::table('inventaris_desa')
            ->where('is_deleted', 1)
            ->orderBy('tanggal_penghapusan', 'asc')
            ->get();

        return view(
            'laporan.umum.inventaris-desa',
            [
                'inventarisDesa' => $inventarisDesa,
                'inventarisDesaDihapus' => $inventarisDesaDihapus,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
