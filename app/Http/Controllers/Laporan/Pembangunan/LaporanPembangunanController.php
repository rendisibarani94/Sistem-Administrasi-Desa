<?php

namespace App\Http\Controllers\Laporan\Pembangunan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanPembangunanController extends Controller
{
    public function kaderPemberdayaan()
    {
        $kaderPemberdayaanData = DB::table('kader_pemberdayaan')
            ->join('bidang_keahlian', 'kader_pemberdayaan.bidang_keahlian', '=', 'bidang_keahlian.id_bidang_keahlian') // Adjust FK if needed
            ->select('kader_pemberdayaan.*', 'bidang_keahlian.bidang_keahlian') // Select required fields
            ->where('kader_pemberdayaan.is_deleted', 0)
            ->get();

        return pdf()->view('laporan.pembangunan.kader-pemberdayaan-masyarakat', [
            'kaderPemberdayaanData' => $kaderPemberdayaanData,
            'date' => date('m/d/Y')
        ])
        ->paperSize(297,210) // Set paper size
        ->orientation('landscape')
        ->orientation('landscape')
        ->download('kaderpemberdayaan.pdf');
    }

    public function displayD1()
    {
        $pembangunanData = DB::table('pembangunan')
            ->where('is_deleted', 0)
            ->get();
        return view(
            'laporan.pembangunan.rencana-kegiatan-pembangunan',
            [
                'pembangunanData' => $pembangunanData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }

    public function displayD2()
    {
        $pembangunanData = DB::table('pembangunan')
            ->where('is_deleted', 0)
            ->get();
        return view(
            'laporan.pembangunan.kegiatan-pembangunan',
            [
                'pembangunanData' => $pembangunanData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );        
    }

    public function displayD3()
    {
        $pembangunanData = DB::table('pembangunan')
            ->where('is_deleted', 0)
            ->get();
        return view(
            'laporan.pembangunan.inventaris-hasil-pembangunan',
            [
                'pembangunanData' => $pembangunanData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );        
    }

    public function displayD4()
    {
        $kaderPemberdayaanData = DB::table('kader_pemberdayaan')
            ->join('bidang_keahlian', 'kader_pemberdayaan.bidang_keahlian', '=', 'bidang_keahlian.id_bidang_keahlian') // Adjust FK if needed
            ->select('kader_pemberdayaan.*', 'bidang_keahlian.bidang_keahlian') // Select required fields
            ->where('kader_pemberdayaan.is_deleted', 0)
            ->get();
        return view(
            'laporan.pembangunan.kader-pemberdayaan-masyarakat',
            [
                'kaderPemberdayaanData' => $kaderPemberdayaanData,
                'date' => date('m/d/Y')
            ],
        );
    }
}
