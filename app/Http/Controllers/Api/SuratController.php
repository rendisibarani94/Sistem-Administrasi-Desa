<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // =========================
    // 1. LIST SURAT
    // =========================
    public function index()
    {
        $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // =========================
    // 2. AJUKAN SURAT (WARGA)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id_jenis_surat',
            'data_form' => 'required|array'
        ]);

        $surat = PengajuanSurat::create([
            'id_penduduk' => Auth::user()->id, // sesuaikan kalau pakai tabel penduduk
            'id_jenis_surat' => $request->id_jenis_surat,
            'data_form' => $request->data_form,
            'status' => 'diajukan'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan surat berhasil',
            'data' => $surat
        ]);
    }

    // =========================
    // 3. DETAIL SURAT
    // =========================
    public function show($id)
    {
        $data = PengajuanSurat::with(['jenisSurat', 'penduduk'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // =========================
    // 4. APPROVE ADMIN
    // =========================
    public function approveAdmin($id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => 'diverifikasi_admin',
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Surat diverifikasi admin'
        ]);
    }

    // =========================
    // 5. REJECT ADMIN
    // =========================
    public function rejectAdmin(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $request->validate([
            'alasan' => 'required'
        ]);

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => 'ditolak_admin',
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Surat ditolak admin'
        ]);
    }

    // =========================
    // 6. APPROVE KEPALA DESA
    // =========================
    public function approveKades($id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => 'disetujui_kades',
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Surat disetujui kepala desa'
        ]);
    }

    // =========================
    // 7. REJECT KEPALA DESA
    // =========================
    public function rejectKades(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $request->validate([
            'alasan' => 'required'
        ]);

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => 'ditolak_kades',
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $user->id,
            'tanggal_respons' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Surat ditolak kepala desa'
        ]);
    }

    // =========================
    // 8. FINAL (SELESAI + TTD)
    // =========================
    public function selesai($id)
    {
        $user = Auth::user();

        if ($user->role !== 'kepala_desa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $surat = PengajuanSurat::findOrFail($id);

        $surat->update([
            'status' => 'selesai',
            'tanggal_respons' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Surat selesai & siap diambil'
        ]);
    }
}