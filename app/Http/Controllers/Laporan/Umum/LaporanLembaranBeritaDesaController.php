<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanLembaranBeritaDesaController extends Controller
{
    public function displayA9()
    {
        $lembaranBeritaDesaData = DB::table('peraturan_desa')
            ->where('is_deleted', 0)
            ->get();

        return view(
            'laporan.umum.lembaran-berita-desa',
            [
                'lembaranBeritaDesaData' => $lembaranBeritaDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
