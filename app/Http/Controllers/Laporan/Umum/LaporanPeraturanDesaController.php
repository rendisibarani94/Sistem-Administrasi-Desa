<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanPeraturanDesaController extends Controller
{
    public function displayA1()
    {
        $peraturanDesaData = DB::table('peraturan_desa')
            ->where('is_deleted', 0)
            ->get();


        return view(
            'laporan.umum.peraturan-desa',
            [
                'peraturanDesaData' => $peraturanDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
