<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InformationApiController extends Controller
{
    /**
     * Ambil notifikasi milik user yang sedang login (Flutter)
     * GET /api/notifikasi
     */
    public function getNotifikasi(Request $request)
    {
        $user = Auth::user();

        $notifikasiList = Notifikasi::where('user_id', $user->id)
            ->latest()
            ->limit(50)
            ->get();

        $formattedNotifikasi = $notifikasiList->map(function ($notif) {
            $tipe = 'respons';
            $ikon = '🔔';
            $judulLower = strtolower($notif->judul);

            if (str_contains($judulLower, 'disetujui') || str_contains($judulLower, 'selesai')) {
                $tipe = 'disetujui';
                $ikon = '✅';
            } elseif (str_contains($judulLower, 'ditolak')) {
                $tipe = 'ditolak';
                $ikon = '❌';
            } elseif (str_contains($judulLower, 'diproses')) {
                $tipe = 'diproses';
                $ikon = '🔄';
            } elseif (str_contains($judulLower, 'pengaduan terkirim')) {
                $tipe = 'pengaduan_terkirim';
                $ikon = '📨';
            } elseif (str_contains($judulLower, 'pengajuan baru') || str_contains($judulLower, 'surat baru')) {
                $tipe = 'pengajuan_baru';
                $ikon = '📄';
            } elseif (str_contains($judulLower, 'pengaduan baru')) {
                $tipe = 'pengaduan_baru';
                $ikon = '📢';
            }

            return [
                'id'          => (string) $notif->id,
                'judul'       => $notif->judul,
                'pesan'       => $notif->pesan,
                'tipe'        => $tipe,
                'ikon'        => $ikon,
                'waktu'       => $notif->created_at->toIso8601String(),
                'sudahDibaca' => (bool) $notif->is_read,
            ];
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Berhasil mengambil notifikasi',
            'data'    => $formattedNotifikasi,
            'unread'  => $notifikasiList->where('is_read', false)->count(),
        ]);
    }

    /**
     * Tandai notifikasi sudah dibaca
     * PATCH /api/notifikasi/{id}/read  (atau 'all' untuk semua)
     */
    public function markNotifikasiRead(Request $request, $id)
    {
        $user = Auth::user();

        if ($id === 'all') {
            Notifikasi::where('user_id', $user->id)->update(['is_read' => true]);
        } else {
            Notifikasi::where('user_id', $user->id)
                ->where('id', $id)
                ->update(['is_read' => true]);
        }

        return response()->json(['status' => 'success', 'message' => 'Notifikasi ditandai sudah dibaca']);
    }

    /**
     * Tampilkan/Download surat yang sudah disetujui (untuk Flutter WebView/Download)
     * GET /api/surat/{id}/view
     */
    public function viewSurat(Request $request, $id)
    {
        $user = Auth::user();

        $pengajuanSurat = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh'])
            ->findOrFail($id);

        // Cek akses: milik sendiri atau admin
        $milikSendiri = ($pengajuanSurat->id_penduduk == $user->id)
            || ($user->id_penduduk && $pengajuanSurat->id_penduduk == $user->id_penduduk);

        if ($user->role !== 'admin' && !$milikSendiri) {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak'], 403);
        }

        if ($pengajuanSurat->status !== 'selesai') {
            return response()->json(['status' => 'error', 'message' => 'Surat belum disetujui'], 400);
        }

        // Jika ada file HTML yang di-generate otomatis
        if ($pengajuanSurat->file_pdf && str_ends_with($pengajuanSurat->file_pdf, '.html')) {
            $htmlPath = storage_path('app/' . $pengajuanSurat->file_pdf);
            if (file_exists($htmlPath)) {
                return response(file_get_contents($htmlPath), 200)
                    ->header('Content-Type', 'text/html; charset=UTF-8');
            }
        }

        // Jika ada file PDF upload manual
        if ($pengajuanSurat->file_pdf && !str_ends_with($pengajuanSurat->file_pdf, '.html')) {
            $pdfPath = storage_path('app/' . $pengajuanSurat->file_pdf);
            if (file_exists($pdfPath)) {
                return response()->download($pdfPath);
            }
        }

        // Fallback: generate HTML on-the-fly dari Blade template
        try {
            $judul = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';
            $html  = view('livewire.admin.layanan-surat.print-surat', compact('pengajuanSurat', 'judul'))->render();
            return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal generate surat: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Berita publik desa
     * GET /api/berita
     */
    public function getBerita(Request $request)
    {
        try {
            $berita = DB::table('berita')
                ->orderByDesc('created_at')
                ->limit(20)
                ->get()
                ->map(function ($item) use ($request) {
                    $gambarUrl = null;
                    if (!empty($item->gambar)) {
                        $baseUrl = $request->getSchemeAndHttpHost();
                        $gambarUrl = $baseUrl . '/storage/' . $item->gambar;
                    }

                    return [
                        'id_berita'   => (string) $item->id_berita,
                        'judul'       => $item->judul,
                        'deskripsi'   => $item->deskripsi,
                        'gambar'      => $item->gambar,
                        'gambar_url'  => $gambarUrl,
                        'id_dibuat_oleh' => $item->id_dibuat_oleh,
                        'created_at'  => $item->created_at ?? null,
                        'updated_at'  => $item->updated_at ?? null,
                    ];
                });

            return response()->json(['status' => 'success', 'data' => $berita]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'success', 'data' => []]);
        }
    }

    /**
     * Pengumuman publik desa
     * GET /api/pengumuman
     */
    public function getPengumuman(Request $request)
    {
        try {
            $pengumuman = DB::table('pengumuman')
                ->leftJoin('users', 'pengumuman.id_dibuat_oleh', '=', 'users.id')
                ->where('pengumuman.is_deleted', 0)
                ->orderByDesc('pengumuman.created_at')
                ->limit(50)
                ->get([
                    'pengumuman.id_pengumuman',
                    'pengumuman.judul',
                    'pengumuman.deskripsi',
                    'pengumuman.gambar',
                    'pengumuman.created_at',
                    'users.name as nama_pembuat_user',
                ])
                ->map(function ($item) use ($request) {
                    // Format gambar menjadi URL lengkap berdasarkan host request,
                    // sehingga bisa diakses dari HP Android (via IP) maupun browser (via localhost)
                    $gambarUrl = null;
                    if (!empty($item->gambar)) {
                        $baseUrl = $request->getSchemeAndHttpHost();
                        $gambarUrl = $baseUrl . '/storage/' . $item->gambar;
                    }

                    return [
                        'id'           => (string) $item->id_pengumuman,
                        'judul'        => $item->judul ?? '',
                        'isi'          => $item->deskripsi ?? '',
                        'gambar_url'   => $gambarUrl,
                        'nama_pembuat' => $item->nama_pembuat_user ?? 'Admin Desa',
                        'created_at'   => $item->created_at,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data'   => $pengumuman,
                'total'  => $pengumuman->count(),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'success', 'data' => [], 'total' => 0]);
        }
    }
}