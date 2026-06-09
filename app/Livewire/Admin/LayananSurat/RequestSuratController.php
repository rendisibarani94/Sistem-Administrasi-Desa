<?php

namespace App\Livewire\Admin\LayananSurat;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use App\Models\User;
use App\Services\FcmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestSuratController extends Controller
{
    /**
     * Admin: Menampilkan semua request surat untuk dikelola
     * Masyarakat: Menampilkan request surat milik user
     */
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        $query = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh']);

        // Filter berdasarkan role
        if (!$isAdmin) {
            // Masyarakat hanya bisa lihat surat miliknya
            $query->where('id_penduduk', $user->id_penduduk);
        }

        // Filter berdasarkan pencarian
        if (request('search')) {
            $query->where(function ($sub) {
                $sub->whereHas('penduduk', function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . request('search') . '%')
                      ->orWhere('nik', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('jenisSurat', function ($q) {
                    $q->where('nama_surat', 'like', '%' . request('search') . '%');
                });
            });
        }

        // Filter berdasarkan status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Filter berdasarkan jenis surat
        if (request('jenis')) {
            $query->where('id_jenis_surat', request('jenis'));
        }

        $pengajuanSurat = $query->latest()->paginate(10);

        // Data untuk statistik (hanya admin)
        $totalSurat = $isAdmin ? PengajuanSurat::count() : $user->pengajuanSurat()->count();
        $totalMenunggu = $isAdmin ? PengajuanSurat::where('status', 'diajukan')->count() : $user->pengajuanSurat()->where('status', 'diajukan')->count();
        $totalDisetujui = $isAdmin ? PengajuanSurat::where('status', 'selesai')->count() : $user->pengajuanSurat()->where('status', 'selesai')->count();
        $totalDitolak = $isAdmin ? PengajuanSurat::where('status', 'ditolak')->count() : $user->pengajuanSurat()->where('status', 'ditolak')->count();

        $jenisSuratList = JenisSurat::where('is_active', 1)->get();

        return view('livewire.admin.layanan-surat.request-surat-controller', compact(
            'pengajuanSurat',
            'totalSurat',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak',
            'jenisSuratList',
            'isAdmin'
        ));
    }

    /**
     * Menampilkan halaman create request surat (untuk masyarakat)
     */
    public function create()
    {
        $jenisSuratList = JenisSurat::where('is_active', 1)->get();
        return view('livewire.admin.layanan-surat.request-surat-create', compact('jenisSuratList'));
    }

    /**
     * Menyimpan request surat baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_jenis_surat' => 'required|exists:jenis_surat,id_jenis_surat',
            'data_form' => 'nullable|array',
        ]);

        $user = Auth::user();
        $jenisSurat = JenisSurat::find($validated['id_jenis_surat']);

        // Prevent duplicate pending requests
        $pengajuanAktif = PengajuanSurat::where('id_penduduk', $user->id_penduduk)
            ->where('id_jenis_surat', $validated['id_jenis_surat'])
            ->whereIn('status', ['diajukan', 'diproses'])
            ->first();

        if ($pengajuanAktif) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Anda sudah memiliki pengajuan surat jenis ini yang sedang diproses atau menunggu persetujuan.');
        }
        
        $pengajuanSurat = PengajuanSurat::create([
            'id_penduduk' => $user->id_penduduk,
            'id_jenis_surat' => $validated['id_jenis_surat'],
            'data_form' => $validated['data_form'] ?? [],
            'status' => 'diajukan',
            'tanggal_respons' => null,
        ]);

        $this->notifyAdmins(
            'Permintaan Surat Baru',
            "{$user->name} mengajukan surat {$jenisSurat?->nama_surat}."
        );

        return redirect()
            ->route('admin.layanan-surat.request.index')
            ->with('success', 'Request surat berhasil dibuat. Silakan tunggu persetujuan dari admin.');
    }

    /**
     * Menampilkan detail request surat
     */
    public function show($id)
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        $pengajuanSurat = PengajuanSurat::with([
                'jenisSurat',
                'penduduk',
                'diprosesOleh',
                'detailPengajuanSurat.persyaratanSurat', // Data EAV dari pengajuan mobile
            ])->findOrFail($id);

        if (!$isAdmin && $pengajuanSurat->id_penduduk !== $user->id_penduduk) {
            abort(403, 'Unauthorized action.');
        }

        return view('livewire.admin.layanan-surat.request-surat-show', compact('pengajuanSurat'));
    }

    /**
     * Menyetujui request surat (Admin) — PDF di-generate otomatis dari template
     */
    public function setujui(Request $request, $id)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nomor_surat'     => 'required|string|max:100',
            'file_pdf'        => 'nullable|file|mimes:pdf|max:10240',  // opsional sekarang
        ]);

        $pengajuanSurat = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh'])
            ->findOrFail($id);

        $filePath = null;

        // Ambil Kepala Desa aktif
        $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
        $idKades = $activeKades ? $activeKades->id_kepala_desa : null;

        if ($request->hasFile('file_pdf')) {
            // Admin upload PDF manual (scan yang sudah ditandatangani)
            $filePath = $request->file('file_pdf')->store('surat');
        } else {
            // Auto-generate PDF dari Blade template HTML
            try {
                $pengajuanSurat->nomor_surat = $validated['nomor_surat'];
                $pengajuanSurat->tanggal_selesai = now();
                $pengajuanSurat->id_diproses_oleh = $idKades;
                if ($activeKades) {
                    $pengajuanSurat->setRelation('diprosesOleh', $activeKades);
                }
                $judul = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';

                // Render HTML with isPdf set to true so base64 images and DomPDF compatible layouts are used
                $isPdf = true;
                $html = view('livewire.admin.layanan-surat.print-surat', compact('pengajuanSurat', 'judul', 'isPdf'))->render();

                // Pastikan folder ada
                $dir = storage_path('app/surat');
                if (!is_dir($dir)) { mkdir($dir, 0755, true); }

                $filename = 'surat/' . date('Ymd') . '_' . $id . '_' . str_replace('/', '-', $validated['nomor_surat']) . '.pdf';
                $pdfPath = storage_path('app/' . $filename);

                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
                $pdf->setPaper('a4', 'portrait');
                $pdf->save($pdfPath);

                $filePath = $filename;
            } catch (\Throwable $e) {
                \Log::error('Gagal generate surat: ' . $e->getMessage());
                // Lanjutkan tanpa file
            }
        }

        $pengajuanSurat->update([
            'status'           => 'selesai',
            'nomor_surat'      => $validated['nomor_surat'],
            'file_pdf'         => $filePath,
            'id_diproses_oleh' => $idKades,
            'tanggal_respons'  => now(),
            'tanggal_selesai'  => now(),
        ]);

        // Notif ke user (fallback ke user.id jika id_penduduk kosong)
        $this->notifyUser(
            $pengajuanSurat->id_penduduk,
            'Pengajuan Surat Disetujui ✅',
            "Surat {$pengajuanSurat->jenisSurat->nama_surat} Anda telah disetujui dengan nomor: {$validated['nomor_surat']}. Silakan unduh melalui menu Riwayat Layanan."
        );

        return redirect()
            ->back()
            ->with('success', 'Request surat berhasil disetujui. PDF surat telah digenerate.');
    }

    /**
     * Menolak request surat dengan alasan (Admin)
     */
    public function tolak(Request $request, $id)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'alasan_tolak' => 'required|string|min:5|max:500',
        ]);

        $pengajuanSurat = PengajuanSurat::with(['jenisSurat'])->findOrFail($id);

        // Ambil Kepala Desa aktif
        $activeKades = \App\Models\KepalaDesa::where('is_active', true)->first();
        $idKades = $activeKades ? $activeKades->id_kepala_desa : null;

        $pengajuanSurat->update([
            'status'           => 'ditolak',
            'alasan_tolak'     => $validated['alasan_tolak'],
            'id_diproses_oleh' => $idKades,
            'tanggal_respons'  => now(),
        ]);

        // Notif ke user (fallback ke user.id jika id_penduduk kosong)
        $this->notifyUser(
            $pengajuanSurat->id_penduduk,
            'Pengajuan Surat Ditolak ❌',
            "Pengajuan {$pengajuanSurat->jenisSurat->nama_surat} Anda ditolak. Alasan: {$validated['alasan_tolak']}"
        );

        return redirect()
            ->back()
            ->with('success', 'Request surat berhasil ditolak.');
    }

    /**
     * Download surat PDF (jika sudah disetujui)
     */
    public function download($id)
    {
        $user = Auth::user();
        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        if ($user->role !== 'admin' && $pengajuanSurat->id_penduduk !== $user->id_penduduk) {
            abort(403, 'Unauthorized action.');
        }

        if ($pengajuanSurat->status !== 'selesai') {
            return redirect()->back()->with('error', 'Hanya surat yang sudah disetujui dapat diunduh.');
        }

        if (!$pengajuanSurat->file_pdf) {
            return redirect()->back()->with('error', 'File PDF tidak tersedia.');
        }

        $filePath = storage_path('app/' . $pengajuanSurat->file_pdf);

        // Jika filenya adalah HTML (data lama), konversi on-the-fly ke PDF
        if (str_ends_with($pengajuanSurat->file_pdf, '.html')) {
            // Generate PDF on-the-fly
            $isPdf = true;
            
            try {
                $judul = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';
                $html = view('livewire.admin.layanan-surat.print-surat', compact('pengajuanSurat', 'judul', 'isPdf'))->render();
            } catch (\Throwable $e) {
                if (file_exists($filePath)) {
                    $html = file_get_contents($filePath);
                } else {
                    return redirect()->back()->with('error', 'File tidak ditemukan di server.');
                }
            }

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
            $pdf->setPaper('a4', 'portrait');

            $downloadName = basename($pengajuanSurat->file_pdf, '.html') . '.pdf';
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $downloadName, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        return response()->download($filePath);
    }

    /**
     * Mencetak surat (Generate preview cetak surat resmi)
     */
    public function printSurat($id)
    {
        $user = Auth::user();
        $pengajuanSurat = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh'])
            ->findOrFail($id);

        // Cek akses: admin atau pemilik
        if ($user->role !== 'admin' && $pengajuanSurat->id_penduduk !== $user->id_penduduk) {
            abort(403, 'Unauthorized action.');
        }

        $judul = $pengajuanSurat->jenisSurat->nama_surat ?? 'Surat Keterangan';

        return view('livewire.admin.layanan-surat.print-surat', compact('pengajuanSurat', 'judul'));
    }

    /**
     * Helper: Cek apakah user adalah admin
     */
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Kirim notifikasi ke user berdasarkan id_penduduk, dengan fallback ke user.id
     * (karena sering id_penduduk di tabel users kosong saat login via API)
     */
    private function notifyUser(int $idPenduduk, string $judul, string $pesan): void
    {
        // Cari user berdasarkan id_penduduk
        $user = User::where('id_penduduk', $idPenduduk)->first();

        // Fallback: jika tidak ketemu, cari user dengan id == idPenduduk
        // (karena SuratController menyimpan user.id sebagai id_penduduk saat id_penduduk NULL)
        if (!$user) {
            $user = User::find($idPenduduk);
        }

        if (!$user) {
            \Log::warning("notifyUser: user dengan id_penduduk=$idPenduduk tidak ditemukan.");
            return;
        }

        Notifikasi::create([
            'user_id' => $user->id,
            'judul'   => $judul,
            'pesan'   => $pesan,
            'is_read' => false,
        ]);

        // Kirim push notification real-time ke HP warga via FCM
        try {
            (new FcmService())->sendToUser($user, $judul, $pesan);
        } catch (\Throwable $e) {
            \Log::warning('FCM push gagal: ' . $e->getMessage());
        }
    }

    private function notifyAdmins(string $judul, string $pesan): void
    {
        $fcm = new FcmService();

        User::where('role', 'admin')->each(function (User $admin) use ($judul, $pesan, $fcm) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul'   => $judul,
                'pesan'   => $pesan,
                'is_read' => false,
            ]);

            // Kirim push notification real-time ke HP admin via FCM
            try {
                $fcm->sendToUser($admin, $judul, $pesan);
            } catch (\Throwable $e) {
                \Log::warning('FCM push ke admin gagal: ' . $e->getMessage());
            }
        });
    }

    // Tetap untuk backward compatibility
    private function notifyUserByPendudukId(int $idPenduduk, string $judul, string $pesan): void
    {
        $this->notifyUser($idPenduduk, $judul, $pesan);
    }
}