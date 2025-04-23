<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanAparatDesaController extends Controller
{

    public function displayA4()
    {
        $aparaturDesaData = DB::table('aparatur_desa')
        ->join('jabatan', 'aparatur_desa.jabatan', '=', 'jabatan.id_jabatan') // Adjust FK if needed
        ->select('aparatur_desa.*', 'jabatan.jabatan') // Select required fields
        ->where('aparatur_desa.is_deleted', 0)
        ->orderBy('aparatur_desa.id_aparatur', 'desc')
        ->get();

        return view(
            'laporan.umum.aparatur-pemerintah-desa',
            [
                'aparaturDesaData' => $aparaturDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
