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
        // $indukPendudukData = DB::table('penduduk')
        // ->where('is_deleted', 0)
        // ->orderBy('id_penduduk', 'desc')
        // ->get();

        $indukPendudukData = DB::table('penduduk')
        ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
        ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga')
        ->where('penduduk.is_deleted', 0)
        ->orderBy('penduduk.id_kartu_keluarga', 'desc')
        ->get();


        return view(
            'laporan.kependudukan.penduduk-sementara',
            [
                'indukPendudukData' => $indukPendudukData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
