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
        ->join('pekerjaan', 'penduduk_sementara.pekerjaan', '=', 'pekerjaan.id_pekerjaan')
        ->select('penduduk_sementara.*', 'pekerjaan.pekerjaan as nama_pekerjaan')
        ->where('penduduk_sementara.is_deleted', 0)
        ->orderBy('penduduk_sementara.id_penduduk', 'desc')
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
