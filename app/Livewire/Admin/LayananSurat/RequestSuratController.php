<?php

namespace App\Livewire\Admin\LayananSurat;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use App\Models\User;
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

        $pengajuanSurat = PengajuanSurat::with(['jenisSurat', 'penduduk', 'diprosesOleh'])
            ->findOrFail($id);

        if (!$isAdmin && $pengajuanSurat->id_penduduk !== $user->id_penduduk) {
            abort(403, 'Unauthorized action.');
        }

        return view('livewire.admin.layanan-surat.request-surat-show', compact('pengajuanSurat'));
    }

    /**
     * Menyetujui request surat (Admin)
     */
    public function setujui($id)
    {
        $this->authorizeAdmin();

        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        $pengajuanSurat->update([
            'status' => 'selesai',
            'id_diproses_oleh' => Auth::user()->id,
            'tanggal_respons' => now(),
            'tanggal_selesai' => now(),
        ]);

        $this->notifyUserByPendudukId(
            $pengajuanSurat->id_penduduk,
            'Pengajuan Surat Disetujui',
            'Permintaan surat Anda telah disetujui dan selesai diproses.'
        );

        return redirect()
            ->back()
            ->with('success', 'Request surat berhasil disetujui.');
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

        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        $pengajuanSurat->update([
            'status' => 'ditolak',
            'alasan_tolak' => $validated['alasan_tolak'],
            'id_diproses_oleh' => Auth::user()->id,
            'tanggal_respons' => now(),
        ]);

        $this->notifyUserByPendudukId(
            $pengajuanSurat->id_penduduk,
            'Pengajuan Surat Ditolak',
            "Pengajuan surat Anda ditolak: {$validated['alasan_tolak']}"
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

        return response()->download(storage_path('app/' . $pengajuanSurat->file_pdf));
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

    private function notifyAdmins(string $judul, string $pesan): void
    {
        User::where('role', 'admin')->each(function (User $admin) use ($judul, $pesan) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul' => $judul,
                'pesan' => $pesan,
                'is_read' => false,
            ]);
        });
    }

    private function notifyUserByPendudukId(int $idPenduduk, string $judul, string $pesan): void
    {
        $user = User::where('id_penduduk', $idPenduduk)->first();

        if (! $user) {
            return;
        }

        Notifikasi::create([
            'user_id' => $user->id,
            'judul' => $judul,
            'pesan' => $pesan,
            'is_read' => false,
        ]);
    }
}