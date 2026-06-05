<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLayananSuratRequest;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LayananSuratApiController extends Controller
{
    public function store(StoreLayananSuratRequest $request): JsonResponse
    {
        $user = Auth::user();
        $pendudukId = $user->id_penduduk ?? $user->id;

        if ($request->input('id_penduduk') !== $pendudukId) {
            return response()->json([
                'status' => false,
                'message' => 'ID penduduk tidak sesuai dengan akun yang sedang login.'
            ], 403);
        }

        $jenisSuratId = $request->input('jenis_surat');
        $jenisSurat = JenisSurat::find($jenisSuratId);

        if (!$jenisSurat) {
            return response()->json([
                'status' => false,
                'message' => 'Jenis surat tidak ditemukan.'
            ], 422);
        }

        // Prevent duplicate pending requests
        $pengajuanAktif = PengajuanSurat::where('id_penduduk', $pendudukId)
            ->where('id_jenis_surat', $jenisSurat->id_jenis_surat)
            ->whereIn('status', ['diajukan', 'diproses'])
            ->first();

        if ($pengajuanAktif) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah memiliki pengajuan surat jenis ini yang sedang diproses atau menunggu persetujuan.'
            ], 422);
        }

        $surat = PengajuanSurat::create([
            'id_penduduk' => $pendudukId,
            'id_jenis_surat' => $jenisSurat->id_jenis_surat,
            'data_form' => [
                'keterangan' => $request->input('keterangan')
            ],
            'status' => PengajuanSurat::DIAJUKAN,
        ]);

        Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Pengajuan Berhasil',
            'pesan' => 'Pengajuan surat berhasil dikirim dan menunggu verifikasi admin.',
            'is_read' => false,
        ]);

        User::where('role', 'admin')->get()->each(function (User $admin) use ($surat) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul' => 'Pengajuan Surat Baru',
                'pesan' => "Permohonan surat baru masuk. ID: {$surat->id_pengajuan_surat}",
                'is_read' => false,
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Permintaan surat berhasil dibuat.',
            'data' => $surat,
        ], 201);
    }
}
