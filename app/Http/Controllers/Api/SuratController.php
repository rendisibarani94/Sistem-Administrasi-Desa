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

            $data = PengajuanSurat::with(['jenisSurat', 'penduduk', 'detailPengajuanSurat.persyaratanSurat'])
                ->where('status', PengajuanSurat::DIAJUKAN)
                ->latest()
                ->get();

        } elseif ($user->role === 'kepala_desa') {

            $data = PengajuanSurat::with(['jenisSurat', 'penduduk', 'detailPengajuanSurat.persyaratanSurat'])
                ->where('status', PengajuanSurat::DIPROSES)
                ->latest()
                ->get();

        } else {
            // Masyarakat: tampilkan SEMUA riwayat pengajuan milik user
            // Cari berdasarkan id_penduduk atau user.id sebagai fallback
            $pendudukId = $user->id_penduduk ?? $user->id;

            $data = PengajuanSurat::with(['jenisSurat', 'detailPengajuanSurat.persyaratanSurat'])
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

        $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
        $idKades = $activeKades ? $activeKades->id_kepala_desa : null;

        $surat->update([
            'status' => PengajuanSurat::DIPROSES,
            'id_diproses_oleh' => $idKades,
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

        $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
        $idKades = $activeKades ? $activeKades->id_kepala_desa : null;

        $surat->update([
            'status' => PengajuanSurat::DITOLAK,
            'alasan_tolak' => $request->alasan,
            'id_diproses_oleh' => $idKades,
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

        $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
        $idKades = $activeKades ? $activeKades->id_kepala_desa : null;

        $surat->update([
            'status' => PengajuanSurat::SELESAI,
            'id_diproses_oleh' => $idKades,
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
    // Generate PDF on-the-fly dari Blade template (sama dengan web/admin)
    // =====================================================
    public function download($id)
    {
        $user = Auth::user();
        $surat = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh', 'detailPengajuanSurat.persyaratanSurat'])->findOrFail($id);

        // Allow if user is admin, or the resident who submitted the request
        $milikSendiri = ($surat->id_penduduk == $user->id)
            || ($user->id_penduduk && $surat->id_penduduk == $user->id_penduduk);

        if ($user->role !== 'admin' && !$milikSendiri) {
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

        $isPdf = true;
        $pengajuanSurat = $surat;
        $judul = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';

        // Cek apakah PDF diupload secara manual (menggunakan nama acak hash dari store())
        $isManualUpload = false;
        if ($surat->file_pdf && !str_ends_with($surat->file_pdf, '.html')) {
            $filename = basename($surat->file_pdf);
            if (strlen($filename) >= 30 && !str_contains($filename, '_')) {
                $isManualUpload = true;
            }
        }

        // Jika ada file PDF upload manual, langsung serve file tersebut
        if ($isManualUpload) {
            $filePath = storage_path('app/' . $surat->file_pdf);
            if (file_exists($filePath)) {
                $nomorSurat = $surat->nomor_surat ?? $surat->id_pengajuan_surat;
                $downloadName = date('Ymd') . '_' . str_replace('/', '-', $nomorSurat) . '.pdf';
                return response()->download($filePath, $downloadName, [
                    'Content-Type' => 'application/pdf',
                ]);
            }
        }

        // Generate PDF on-the-fly dari Blade template yang SAMA dengan web/admin
        // Ini memastikan hasil PDF mobile IDENTIK dengan PDF di halaman web
        try {
            $html = view('livewire.admin.layanan-surat.print-surat', compact('pengajuanSurat', 'judul', 'isPdf'))->render();

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
            $pdf->setPaper('a4', 'portrait');

            $nomorSurat = $surat->nomor_surat ?? $surat->id_pengajuan_surat;
            $downloadName = date('Ymd') . '_' . str_replace('/', '-', $nomorSurat) . '.pdf';

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $downloadName, [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal generate PDF: ' . $e->getMessage()
            ], 500);
        }
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