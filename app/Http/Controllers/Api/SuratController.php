<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use App\Models\Notifikasi;
use App\Models\User;

class SuratController extends Controller
{
    // =====================================================
    // LIST DATA SURAT (ROLE BASED)
    // =====================================================
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {

            $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
                ->where('status', PengajuanSurat::DIAJUKAN)
                ->latest()
                ->get();

        } elseif ($user->role === 'kepala_desa') {

            $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
                ->where('status', PengajuanSurat::DIPROSES)
                ->latest()
                ->get();

        } else {
            $pendudukId = $user->id_penduduk ?? $user->id;

            $data = PengajuanSurat::with(['jenisSurat'])
                ->where('id_penduduk', $pendudukId)
                ->latest()
                ->get();
        }

        return response()->json([
            'status' => true,
            'message' => 'Data surat berhasil diambil',
            'data' => $data
        ]);
    }

    // =====================================================
    // LIST JENIS SURAT
    // =====================================================
    public function jenisSurat()
    {
        $data = JenisSurat::where('is_active', 1)->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // =====================================================
    // AJUKAN SURAT OLEH MASYARAKAT
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id_jenis_surat',
            'data_form'      => 'required|array'
        ]);

        $user = Auth::user();
        $pendudukId = $user->id_penduduk ?? $user->id;

        $surat = PengajuanSurat::create([
            'id_penduduk'    => $pendudukId,
            'id_jenis_surat' => $request->id_jenis_surat,
            'data_form'      => $request->data_form,  // Let Laravel's array cast handle json_encode
            'status'         => PengajuanSurat::DIAJUKAN
        ]);

        $this->kirimNotif(
            $user->id,
            'Pengajuan Berhasil',
            'Pengajuan surat berhasil dikirim dan menunggu verifikasi admin.'
        );

        User::where('role', 'admin')->get()->each(function (User $admin) use ($surat) {
            $this->kirimNotif(
                $admin->id,
                'Pengajuan Surat Baru',
                "Ada pengajuan surat baru yang perlu ditinjau. ID: {$surat->id_pengajuan_surat}"
            );
        });

        return response()->json([
            'status' => true,
            'message' => 'Pengajuan surat berhasil',
            'data' => $surat
        ]);
    }

    // =====================================================
    // DETAIL SURAT
    // =====================================================
    public function show($id)
    {
        $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
            ->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // =====================================================
    // ADMIN APPROVE
    // =====================================================
    public function approveAdmin($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIAJUKAN) {
            return response()->json([
                'status' => false,
                'message' => 'Status surat tidak valid'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DIPROSES,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Surat Diverifikasi',
            'Pengajuan surat anda telah diverifikasi admin.',
            $surat->id_pengajuan_surat
        );

        return response()->json([
            'status' => true,
            'message' => 'Surat berhasil diverifikasi admin'
        ]);
    }

    // =====================================================
    // ADMIN REJECT
    // =====================================================
    public function rejectAdmin(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required'
        ]);

        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIAJUKAN && $surat->status !== PengajuanSurat::DIPROSES) {
            return response()->json([
                'status' => false,
                'message' => 'Status surat tidak valid'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DITOLAK,
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Pengajuan Ditolak',
            $request->alasan,
            $surat->id_pengajuan_surat
        );

        return response()->json([
            'status' => true,
            'message' => 'Pengajuan surat ditolak'
        ]);
    }

    // =====================================================
    // ADMIN APPROVE (API ROUTE WRAPPER)
    // =====================================================
    public function approve(Request $request, $id)
    {
        return $this->approveAdmin($id);
    }

    // =====================================================
    // ADMIN REJECT (API ROUTE WRAPPER)
    // =====================================================
    public function reject(Request $request, $id)
    {
        return $this->rejectAdmin($request, $id);
    }

    // =====================================================
    // KEPALA DESA APPROVE
    // =====================================================
    public function approveKades($id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIPROSES) {
            return response()->json([
                'status' => false,
                'message' => 'Status belum diverifikasi admin'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::SELESAI,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now(),
            'tanggal_selesai' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Surat Disetujui',
            'Pengajuan surat anda telah disetujui kepala desa.',
            $surat->id_pengajuan_surat
        );

        return response()->json([
            'status' => true,
            'message' => 'Disetujui kepala desa'
        ]);
    }

    // =====================================================
    // SELESAI
    // =====================================================
    public function selesai($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $user->role !== 'kepala_desa') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => PengajuanSurat::SELESAI,
            'tanggal_respons' => now(),
            'tanggal_selesai' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Surat Selesai',
            'Surat anda telah selesai. Silakan unduh melalui aplikasi.',
            $surat->id_pengajuan_surat
        );

        return response()->json([
            'status' => true,
            'message' => 'Surat selesai'
        ]);
    }

    // =====================================================
    // SECURE PDF DOWNLOAD
    // =====================================================
    public function download($id)
    {
        $user = Auth::user();
        $surat = PengajuanSurat::findOrFail($id);

        // Allow if user is admin, or the resident who submitted the request
        if ($user->role !== 'admin' && $surat->id_penduduk !== $user->id_penduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        if ($surat->status !== PengajuanSurat::SELESAI) {
            return response()->json([
                'status' => false,
                'message' => 'Surat belum disetujui / selesai'
            ], 400);
        }

        if (!$surat->file_pdf) {
            return response()->json([
                'status' => false,
                'message' => 'File PDF tidak tersedia'
            ], 404);
        }

        $filePath = storage_path('app/' . $surat->file_pdf);
        if (!file_exists($filePath)) {
            return response()->json([
                'status' => false,
                'message' => 'File PDF tidak ditemukan di server'
            ], 404);
        }

        return response()->download($filePath);
    }

    // =====================================================
    // PRIVATE FUNCTION NOTIFIKASI
    // =====================================================
    private function kirimNotif($userId, $judul, $pesan, $relatedId = null)
    {
        Notifikasi::create([
            'user_id' => $userId,
            'judul'   => $judul,
            'pesan'   => $pesan,
            'is_read' => false,
        ]);
    }
}