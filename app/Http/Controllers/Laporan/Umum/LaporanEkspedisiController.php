<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanEkspedisiController extends Controller
{
    public function displayA8()
    {
        $agendaSuratEkspedisiDesaData = DB::table('agenda_surat')
            ->where('is_deleted', 0)
            ->where('jenis_surat','Surat Ekspedisi')
            ->orderBy('tanggal_pengiriman_penerimaan', 'asc')
            ->get();

        return view(
            'laporan.umum.ekspedisi',
            [
                'agendaSuratEkspedisiDesaData' => $agendaSuratEkspedisiDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
