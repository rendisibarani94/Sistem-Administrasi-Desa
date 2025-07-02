<?php

namespace App\Http\Controllers\Laporan\Kependudukan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanRekapitulasiPenduduk extends Controller
{
    public function displayB3()
    {
        $tahun = Carbon::now()->year; // Tahun laporan
        $bulan = Carbon::now()->month; // Bulan berjalan

        // Perhitungan periode
        $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $akhirBulan = $awalBulan->copy()->endOfMonth();

        // Ambil data dusun
        $dusuns = DB::table('dusun')
            ->where('is_deleted', 0)
            ->get();

        $results = [];
        $totalAwal = $totalKKawal = $totalAkhir = $totalKKakhir = 0;
        $totalLahir = $totalDatang = $totalMeninggal = $totalPindah = [
            'WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0
        ];

        // NEW: Initialize category totals
        $totalAwalPerKategori = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
        $totalAkhirPerKategori = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];

        foreach ($dusuns as $dusun) {
            // Penduduk awal bulan
            $pendudukAwal = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->where(function($query) use ($awalBulan) {
                    $query->where('tanggal_penambahan', '<', $awalBulan)
                          ->orWhereNull('tanggal_penambahan');
                })
                ->where(function($query) use ($awalBulan) {
                    $query->where('tanggal_pengurangan', '>=', $awalBulan)
                          ->orWhereNull('tanggal_pengurangan');
                })
                ->get();

            $awal = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
            foreach ($pendudukAwal as $p) {
                $key = $p->kewarganegaraan . '_' . substr($p->jenis_kelamin, 0, 1);
                $awal[$key] = isset($awal[$key]) ? $awal[$key] + 1 : 1;
            }

            // NEW: Accumulate awal per kategori
            foreach ($awal as $key => $value) {
                $totalAwalPerKategori[$key] += $value;
            }

            // Tambahan bulan ini (lahir)
            $lahir = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->where('asal_penduduk', 'Lahir')
                ->whereBetween('tanggal_penambahan', [$awalBulan, $akhirBulan])
                ->get();

            $dataLahir = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
            foreach ($lahir as $l) {
                $key = $l->kewarganegaraan . '_' . substr($l->jenis_kelamin, 0, 1);
                $dataLahir[$key] = isset($dataLahir[$key]) ? $dataLahir[$key] + 1 : 1;
            }

            // Tambahan bulan ini (datang)
            $datang = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->where('asal_penduduk', 'Datang')
                ->whereBetween('tanggal_penambahan', [$awalBulan, $akhirBulan])
                ->get();

            $dataDatang = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
            foreach ($datang as $d) {
                $key = $d->kewarganegaraan . '_' . substr($d->jenis_kelamin, 0, 1);
                $dataDatang[$key] = isset($dataDatang[$key]) ? $dataDatang[$key] + 1 : 1;
            }

            // Pengurangan bulan ini (meninggal)
            $meninggal = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->whereNotNull('tempat_meninggal')
                ->whereBetween('tanggal_pengurangan', [$awalBulan, $akhirBulan])
                ->get();

            $dataMeninggal = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
            foreach ($meninggal as $m) {
                $key = $m->kewarganegaraan . '_' . substr($m->jenis_kelamin, 0, 1);
                $dataMeninggal[$key] = isset($dataMeninggal[$key]) ? $dataMeninggal[$key] + 1 : 1;
            }

            // Pengurangan bulan ini (pindah)
            $pindah = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->whereNotNull('tujuan_pindah')
                ->whereBetween('tanggal_pengurangan', [$awalBulan, $akhirBulan])
                ->get();

            $dataPindah = ['WNI_L' => 0, 'WNI_P' => 0, 'WNA_L' => 0, 'WNA_P' => 0];
            foreach ($pindah as $p) {
                $key = $p->kewarganegaraan . '_' . substr($p->jenis_kelamin, 0, 1);
                $dataPindah[$key] = isset($dataPindah[$key]) ? $dataPindah[$key] + 1 : 1;
            }

            // Jumlah KK
            $kkAwal = DB::table('penduduk')
                ->where('dusun', $dusun->id_dusun)
                ->where('is_deleted', 0)
                ->distinct('id_kartu_keluarga')
                ->count('id_kartu_keluarga');

            $kkAkhir = $kkAwal + count($datang) - count($pindah);

            // Total per dusun
            $totalJiwaAwal = array_sum($awal);
            $totalJiwaAkhir = $totalJiwaAwal + count($lahir) + count($datang) - count($meninggal) - count($pindah);

            // Calculate akhir values
            $akhir = [
                'WNA_L' => $awal['WNA_L'] + $dataLahir['WNA_L'] + $dataDatang['WNA_L'] - $dataMeninggal['WNA_L'] - $dataPindah['WNA_L'],
                'WNA_P' => $awal['WNA_P'] + $dataLahir['WNA_P'] + $dataDatang['WNA_P'] - $dataMeninggal['WNA_P'] - $dataPindah['WNA_P'],
                'WNI_L' => $awal['WNI_L'] + $dataLahir['WNI_L'] + $dataDatang['WNI_L'] - $dataMeninggal['WNI_L'] - $dataPindah['WNI_L'],
                'WNI_P' => $awal['WNI_P'] + $dataLahir['WNI_P'] + $dataDatang['WNI_P'] - $dataMeninggal['WNI_P'] - $dataPindah['WNI_P'],
            ];

            // NEW: Accumulate akhir per kategori
            foreach ($akhir as $key => $value) {
                $totalAkhirPerKategori[$key] += $value;
            }

            // Simpan data dusun
            $results[] = [
                'dusun' => $dusun->dusun,
                'awal' => $awal,
                'kk_awal' => $kkAwal,
                'jiwa_awal' => $totalJiwaAwal,
                'lahir' => $dataLahir,
                'datang' => $dataDatang,
                'meninggal' => $dataMeninggal,
                'pindah' => $dataPindah,
                'akhir' => $akhir,
                'kk_akhir' => $kkAkhir,
                'jiwa_akhir' => $totalJiwaAkhir
            ];

            // Hitung total
            $totalAwal += $totalJiwaAwal;
            $totalKKawal += $kkAwal;
            $totalKKakhir += $kkAkhir;
            $totalAkhir += $totalJiwaAkhir;

            foreach (['WNI_L', 'WNI_P', 'WNA_L', 'WNA_P'] as $key) {
                $totalLahir[$key] += $dataLahir[$key];
                $totalDatang[$key] += $dataDatang[$key];
                $totalMeninggal[$key] += $dataMeninggal[$key];
                $totalPindah[$key] += $dataPindah[$key];
            }
        }

        return view('laporan.kependudukan.rekapitulasi-penduduk', [
            'results' => $results,
            'total' => [
                'awal_per_kategori' => $totalAwalPerKategori, // NEW
                'akhir_per_kategori' => $totalAkhirPerKategori, // NEW
                'awal' => $totalAwal,
                'kk_awal' => $totalKKawal,
                'lahir' => $totalLahir,
                'datang' => $totalDatang,
                'meninggal' => $totalMeninggal,
                'pindah' => $totalPindah,
                'kk_akhir' => $totalKKakhir,
                'akhir' => $totalAkhir
            ],
            'date' => date('d/m/Y'),
            'year' => $tahun
        ]);
    }
}
