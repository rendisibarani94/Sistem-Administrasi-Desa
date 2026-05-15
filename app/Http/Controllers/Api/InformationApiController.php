<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Pastikan path Model ini sesuai dengan struktur folder Laravel kamu.
// Biasanya ada di App\Models\Berita atau App\Models\Pengumuman
use App\Models\Berita; 
use App\Models\Pengumuman;

class InformationApiController extends Controller
{
    /**
     * Mengambil daftar berita desa
     */
    public function getBerita()
    {
        try {
            // Mengambil semua berita, diurutkan dari yang terbaru (latest)
            $berita = Berita::latest()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berita berhasil diambil',
                'data' => $berita
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil daftar pengumuman desa
     */
    public function getPengumuman()
    {
        try {
            // Mengambil semua pengumuman, diurutkan dari yang terbaru
            $pengumuman = Pengumuman::latest()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pengumuman berhasil diambil',
                'data' => $pengumuman
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }
}