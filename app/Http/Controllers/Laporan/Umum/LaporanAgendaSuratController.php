<?php

namespace App\Http\Controllers\Laporan\Umum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Spatie\LaravelPdf\Support\pdf;

class LaporanAgendaSuratController extends Controller
{
    public function displayA7()
    {
        $agendaSuratMasukDesaData = DB::table('agenda_surat')
            ->where('is_deleted', 0)
            ->where('jenis_surat','Surat Masuk')
            ->orderBy('tanggal_pengiriman_penerimaan', 'asc')
            ->get();

            $agendaSuratKeluarDesaData = DB::table('agenda_surat')
            ->where('is_deleted', 0)
            ->whereIn('jenis_surat', ['Surat Keluar', 'Surat Ekspedisi'])
            ->orderBy('tanggal_pengiriman_penerimaan', 'asc')
            ->get();

        return view(
            'laporan.umum.agenda-surat-desa',
            [
                'agendaSuratMasukDesaData' => $agendaSuratMasukDesaData,
                'agendaSuratKeluarDesaData' => $agendaSuratKeluarDesaData,
                'date' => date('m/d/Y'),
                'year' => date('Y')
            ],
        );
    }
}
