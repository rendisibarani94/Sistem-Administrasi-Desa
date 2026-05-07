<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // =========================
    // LIST (ROLE BASED)
    // =========================
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $data = PengajuanSurat::where('status', PengajuanSurat::DIAJUKAN)->get();
        } elseif ($user->role == 'kepala_desa') {
            $data = PengajuanSurat::where('status', PengajuanSurat::DIVERIFIKASI_ADMIN)->get();
        } else {
            $data = PengajuanSurat::where('id_penduduk', $user->id)->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // =========================
    // LIST JENIS SURAT
    // =========================
    public function jenisSurat()
    {
        return response()->json([
            'data' => JenisSurat::all()
        ]);
    }

    // =========================
    // AJUKAN SURAT
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id_jenis_surat',
            'data_form' => 'required|array'
        ]);

        $surat = PengajuanSurat::create([
            'id_penduduk' => Auth::user()->id,
            'id_jenis_surat' => $request->id_jenis_surat,
            'data_form' => $request->data_form,
            'status' => PengajuanSurat::DIAJUKAN
        ]);

        return response()->json([
            'message' => 'Pengajuan berhasil',
            'data' => $surat
        ]);
    }

    // =========================
    // DETAIL
    // =========================
    public function show($id)
    {
        $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
            ->findOrFail($id);

        return response()->json($data);
    }

    // =========================
    // APPROVE ADMIN
    // =========================
    public function approveAdmin($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIAJUKAN) {
            return response()->json(['message' => 'Status tidak valid'], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DIVERIFIKASI_ADMIN,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json(['message' => 'Diverifikasi admin']);
    }

    // =========================
    // REJECT ADMIN
    // =========================
    public function rejectAdmin(Request $request, $id)
    {
        $request->validate(['alasan' => 'required']);

        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIAJUKAN) {
            return response()->json(['message' => 'Status tidak valid'], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DITOLAK_ADMIN,
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json(['message' => 'Ditolak admin']);
    }

    // =========================
    // APPROVE KADES
    // =========================
    public function approveKades($id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIVERIFIKASI_ADMIN) {
            return response()->json(['message' => 'Status tidak valid'], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DISETUJUI_KADES,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json(['message' => 'Disetujui kades']);
    }

    // =========================
    // REJECT KADES
    // =========================
    public function rejectKades(Request $request, $id)
    {
        $request->validate(['alasan' => 'required']);

        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DIVERIFIKASI_ADMIN) {
            return response()->json(['message' => 'Status tidak valid'], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::DITOLAK_KADES,
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json(['message' => 'Ditolak kades']);
    }

    // =========================
    // SELESAI
    // =========================
    public function selesai($id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== PengajuanSurat::DISETUJUI_KADES) {
            return response()->json(['message' => 'Belum bisa diselesaikan'], 400);
        }

        $surat->update([
            'status' => PengajuanSurat::SELESAI,
            'tanggal_respons' => now()
        ]);

        return response()->json(['message' => 'Selesai']);
    }
}