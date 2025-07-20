<?php

namespace App\Http\Controllers\Laporan\Kependudukan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanPendudukSementaraController extends Controller
{
    public function displayB4()
    {

        $pendudukSementaraData = DB::table('penduduk_sementara')
        ->where('is_deleted', 0)
        ->orderBy('id_penduduk', 'desc')
        ->get();


        return view(
            'laporan.kependudukan.penduduk-sementara',
            [
                'pendudukSementaraData' => $pendudukSementaraData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
