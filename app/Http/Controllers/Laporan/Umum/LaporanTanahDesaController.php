<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanTanahDesaController extends Controller
{
    public function displayA6()
    {
        $tanahDesaData = DB::table('tanah_desa')
        ->select(
            '*',
            DB::raw('
                luas_hm +
                luas_hgb +
                luas_hp +
                luas_hgu +
                luas_hpl +
                luas_ma +
                luas_vi +
                luas_tn +
                luas_perumahan +
                luas_perdagangan +
                luas_perkantoran +
                luas_industri +
                luas_fasilitas_umum +
                luas_sawah +
                luas_tegalan +
                luas_perkebunan +
                luas_peternakan_perikanan +
                luas_hutan_belukar +
                luas_hutan_lebat +
                luas_tanah_kosong +
                luas_tanah_lain AS volume
            ')
        )
        ->where('is_deleted', 0)
        ->orderBy('id_tanah_desa', 'desc')
        ->get();


        return view(
            'laporan.umum.tanah-desa',
            [
                'tanahDesaData' => $tanahDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
