<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanTanahKasDesaController extends Controller
{

    public function displayA5()
    {
        $tanahKasDesaData = DB::table('tanah_kas_desa')
            ->where('is_deleted', 0)
            ->orderBy('id_tkd', 'desc')
            ->get();

        return view(
            'laporan.umum.tanah-kas-desa',
            [
                'tanahKasDesaData' => $tanahKasDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
