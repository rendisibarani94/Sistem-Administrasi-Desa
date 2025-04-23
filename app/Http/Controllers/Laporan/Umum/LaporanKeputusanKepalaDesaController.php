<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanKeputusanKepalaDesaController extends Controller
{
    public function displayA2()
    {
        $keputusanKepalaDesaData = DB::table('keputusan_kepala_desa')
            ->where('is_deleted', 0)
            ->get();


        return view(
            'laporan.umum.keputusan-kepala-desa',
            [
                'keputusanKepalaDesaData' => $keputusanKepalaDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
