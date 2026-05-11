<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use App\Models\Notifikasi;

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
                ->where('status', PengajuanSurat::DIVERIFIKASI_ADMIN)
                ->latest()
                ->get();

        } else {

            $data = PengajuanSurat::with(['jenisSurat'])
                ->where('id_penduduk', $user->id)
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

        $surat = PengajuanSurat::create([
            'id_penduduk'    => Auth::user()->id,
            'id_jenis_surat' => $request->id_jenis_surat,
            'data_form'      => json_encode($request->data_form),
            'status'         => PengajuanSurat::DIAJUKAN
        ]);

        $this->kirimNotif(
            Auth::user()->id,
            'Pengajuan Berhasil',
            'Pengajuan surat berhasil dikirim dan menunggu verifikasi admin.',
            $surat->id_pengajuan_surat
        );

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
            'status' => PengajuanSurat::DIVERIFIKASI_ADMIN,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Surat Diverifikasi',
            'Pengajuan surat anda telah diverifikasi admin dan menunggu persetujuan kepala desa.',
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

        if ($surat->status !== PengajuanSurat::DIAJUKAN) {
            return response()->json([
                'status' => false,
                'message' => 'Status surat tidak valid'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DITOLAK_ADMIN,
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

        if ($surat->status !== PengajuanSurat::DIVERIFIKASI_ADMIN) {
            return response()->json([
                'status' => false,
                'message' => 'Status belum diverifikasi admin'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DISETUJUI_KADES,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
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

        if ($user->role !== 'kepala_desa') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DISETUJUI_KADES) {
            return response()->json([
                'status' => false,
                'message' => 'Belum bisa diselesaikan'
            ], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::SELESAI,
            'tanggal_respons' => now()
        ]);

        $this->kirimNotif(
            $surat->id_penduduk,
            'Surat Selesai',
            'Surat anda telah selesai. Silakan datang ke kantor desa untuk tanda tangan / pengambilan.',
            $surat->id_pengajuan_surat
        );

        return response()->json([
            'status' => true,
            'message' => 'Surat selesai'
        ]);
    }

    // =====================================================
    // PRIVATE FUNCTION NOTIFIKASI
    // =====================================================
    private function kirimNotif($idPenduduk, $judul, $pesan, $refId = null)
    {
        Notifikasi::create([
            'id_penduduk' => $idPenduduk,
            'judul'       => $judul,
            'pesan'       => $pesan,
            'jenis'       => 'surat',
            'sudah_dibaca'=> 0,
            'ref_id'      => $refId,
            'ref_type'    => 'pengajuan_surat'
        ]);
    }
}