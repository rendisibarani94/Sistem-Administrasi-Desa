<?php

namespace App\Livewire\Admin\ManajemenAkun;

use App\Models\DetailPengajuanSurat;
use App\Models\Notifikasi;
use App\Models\Pengaduan;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenAkunController extends Component
{
    use WithPagination;

    public string $search  = '';
    public ?int   $deleteId = null;
    public ?int   $clearDataId = null;

    // ─────────────────────────────────────────────────────────
    //  SEARCH / RESET PAGE
    // ─────────────────────────────────────────────────────────

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    // ─────────────────────────────────────────────────────────
    //  KONFIRMASI HAPUS
    // ─────────────────────────────────────────────────────────

    public string $statusFilter = 'aktif'; // 'aktif', 'nonaktif', 'semua'

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;

        $user = User::withTrashed()->find($id);
        $nama = $user?->name ?? 'User ini';

        // Hitung riwayat yang diarsipkan
        $jumlahPengajuan = PengajuanSurat::where('id_penduduk', $user?->id_penduduk ?? $id)->count();
        $jumlahPengaduan = Pengaduan::where('user_id', $id)->count();

        $this->dispatch('swal:confirm-user', [
            'title'             => "Nonaktifkan Akun: {$nama}?",
            'html'              => "<div class='text-left text-sm'>
                                        <p class='mb-2'>Menonaktifkan akun warga ini akan menyebabkan:</p>
                                        <ul class='list-disc list-inside space-y-1 text-gray-600'>
                                            <li>🔑 Token login dicabut (Warga langsung logout otomatis dari HP)</li>
                                            <li>🚫 Warga tidak bisa login kembali ke aplikasi</li>
                                            <li>📦 Arsip aman: <strong>{$jumlahPengajuan}</strong> pengajuan & <strong>{$jumlahPengaduan}</strong> pengaduan tetap tersimpan di database</li>
                                        </ul>
                                        <p class='mt-3 text-amber-600 font-semibold'>⚠️ Akun ini akan ditandai sebagai Tidak Aktif (Soft Delete).</p>
                                    </div>",
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Nonaktifkan!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function confirmClearData(int $id): void
    {
        $this->clearDataId = $id;
        $user = User::find($id);
        $nama = $user?->name ?? 'User ini';

        $this->dispatch('swal:confirm-clear-data', [
            'title'             => "Bersihkan Data: {$nama}?",
            'html'              => "Hapus semua histori (pengajuan, pengaduan, notifikasi) milik '<strong>{$nama}</strong>'? Akun tetap ada.",
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Hapus Histori!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function confirmCleanOldHistory(): void
    {
        $this->dispatch('swal:confirm-clean-old-history', [
            'title'             => 'Bersihkan Arsip Lama?',
            'html'              => 'Apakah Anda yakin ingin menghapus semua histori selesai (pengajuan & pengaduan) yang sudah berusia di atas 1 tahun untuk menghemat penyimpanan?',
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Bersihkan!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    public function confirmCleanOrphanedData(): void
    {
        $this->dispatch('swal:confirm-clean-orphaned-data', [
            'title'             => 'Bersihkan Data Yatim?',
            'html'              => 'Apakah Anda yakin ingin menghapus semua data yatim/orphaned ini secara permanen dari database?',
            'icon'              => 'warning',
            'confirmButtonText' => 'Ya, Hapus Permanen!',
            'cancelButtonText'  => 'Batal',
        ]);
    }

    // ─────────────────────────────────────────────────────────
    //  HAPUS USER (SOFT DELETE) & REVOKE TOKENS
    // ─────────────────────────────────────────────────────────

    public function delete(): void
    {
        if (!$this->deleteId) return;

        $user = User::find($this->deleteId);
        if (!$user) {
            $this->deleteId = null;
            session()->flash('error', 'Akun tidak ditemukan atau sudah tidak aktif.');
            return;
        }

        $nama = $user->name;

        // Menggunakan Database Transaction untuk keamanan data
        DB::transaction(function () use ($user) {
            // 1. Cabut semua token login (Sanctum tokens) untuk force logout dari HP warga
            $user->tokens()->delete();

            // 2. Lakukan Soft Delete pada user (menghapus secara logis dengan mengisi field deleted_at)
            // Transaksi pengajuan surat & pengaduan tetap utuh sebagai arsip logis.
            $user->delete();
        });

        $this->deleteId = null;
        session()->flash('success', "Akun '{$nama}' berhasil dinonaktifkan (Soft Delete) dan dipaksa logout. Riwayat transaksi diarsipkan.");
    }

    // ─────────────────────────────────────────────────────────
    //  AKTIFKAN KEMBALI USER (RESTORE SOFT DELETED USER)
    // ─────────────────────────────────────────────────────────

    public function restoreUser(int $id): void
    {
        $user = User::onlyTrashed()->find($id);
        if (!$user) {
            session()->flash('error', 'Akun tidak ditemukan atau sudah aktif.');
            return;
        }

        $user->restore();
        session()->flash('success', "Akun '{$user->name}' berhasil diaktifkan kembali.");
    }

    // ─────────────────────────────────────────────────────────
    //  HAPUS DATA SAJA (Tetap akun, bersihkan history)
    // ─────────────────────────────────────────────────────────

    public function clearData(): void
    {
        if (!$this->clearDataId) return;

        $user = User::find($this->clearDataId);
        if (!$user) {
            $this->clearDataId = null;
            session()->flash('error', 'Akun tidak ditemukan.');
            return;
        }

        $pendudukId = $user->id_penduduk ?? $this->clearDataId;

        DB::transaction(function () use ($user, $pendudukId) {
            // Hapus detail pengajuan
            $pengajuanIds = PengajuanSurat::where('id_penduduk', $pendudukId)
                ->pluck('id_pengajuan_surat');
            if ($pengajuanIds->isNotEmpty()) {
                DetailPengajuanSurat::whereIn('pengajuan_id', $pengajuanIds)->delete();
            }
            PengajuanSurat::where('id_penduduk', $pendudukId)->forceDelete();
            Pengaduan::where('user_id', $user->id)->delete();
            Notifikasi::where('user_id', $user->id)->delete();
            // Akun TIDAK dihapus
        });

        $this->clearDataId = null;
        session()->flash('success', "Data '{$user->name}' dibersihkan. Akun tetap ada.");
    }

    // ─────────────────────────────────────────────────────────
    //  MANAJEMEN DATA YATIM (ORPHANED DATA)
    // ─────────────────────────────────────────────────────────
    
    public int $orphanedPengajuanCount = 0;
    public int $orphanedPengaduanCount = 0;
    public int $orphanedNotifikasiCount = 0;

    public function loadOrphanedCounts(): void
    {
        $this->orphanedPengajuanCount = PengajuanSurat::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('users')
                ->whereRaw('users.id_penduduk = pengajuan_surat.id_penduduk')
                ->orWhereRaw('users.id = pengajuan_surat.id_penduduk');
        })->count();

        $this->orphanedPengaduanCount = Pengaduan::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('users')
                ->whereRaw('users.id = pengaduan.user_id');
        })->count();

        $this->orphanedNotifikasiCount = Notifikasi::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('users')
                ->whereRaw('users.id = notifikasi.user_id');
        })->count();
    }

    public function cleanOrphanedData(): void
    {
        DB::transaction(function () {
            // Hapus detail pengajuan yatim
            $orphanedPengajuanIds = PengajuanSurat::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.id_penduduk = pengajuan_surat.id_penduduk')
                    ->orWhereRaw('users.id = pengajuan_surat.id_penduduk');
            })->pluck('id_pengajuan_surat');

            if ($orphanedPengajuanIds->isNotEmpty()) {
                DetailPengajuanSurat::whereIn('pengajuan_id', $orphanedPengajuanIds)->delete();
                PengajuanSurat::whereIn('id_pengajuan_surat', $orphanedPengajuanIds)->forceDelete();
            }

            // Hapus pengaduan yatim
            Pengaduan::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.id = pengaduan.user_id');
            })->delete();

            // Hapus notifikasi yatim
            Notifikasi::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.id = notifikasi.user_id');
            })->delete();
        });

        session()->flash('success', 'Semua data yatim/orphaned dari user yang telah dihapus berhasil dibersihkan.');
    }

    // ─────────────────────────────────────────────────────────
    //  BERSIHKAN DATA SELESAI > 1 TAHUN (ARSIP LAMA)
    // ─────────────────────────────────────────────────────────

    public int $oldCompletedCount = 0;

    public function loadOldCompletedCount(): void
    {
        $oneYearAgo = now()->subYear();

        $pengajuanCount = PengajuanSurat::where('status', 'selesai')
            ->where('created_at', '<', $oneYearAgo)
            ->count();

        $pengaduanCount = Pengaduan::where('status', 'selesai')
            ->where('created_at', '<', $oneYearAgo)
            ->count();

        $this->oldCompletedCount = $pengajuanCount + $pengaduanCount;
    }

    public function cleanOldHistory(): void
    {
        // Menggunakan database transaction agar konsisten dan rollback jika ada query yang gagal
        DB::transaction(function () {
            $oneYearAgo = now()->subYear();

            // 1. Ambil ID pengajuan yang sudah disetujui/selesai dan berusia di atas 1 tahun
            $oldPengajuanIds = PengajuanSurat::where('status', 'selesai')
                ->where('created_at', '<', $oneYearAgo)
                ->pluck('id_pengajuan_surat');

            if ($oldPengajuanIds->isNotEmpty()) {
                // Hapus data detail EAV isian formulir
                DetailPengajuanSurat::whereIn('pengajuan_id', $oldPengajuanIds)->delete();
                // Hapus pengajuan surat secara permanen dari DB
                PengajuanSurat::whereIn('id_pengajuan_surat', $oldPengajuanIds)->forceDelete();
            }

            // 2. Hapus pengaduan yang sudah selesai dan berusia di atas 1 tahun
            Pengaduan::where('status', 'selesai')
                ->where('created_at', '<', $oneYearAgo)
                ->delete();
        });

        $this->loadOldCompletedCount();
        session()->flash('success', 'Histori pengajuan surat dan pengaduan berstatus selesai yang berusia di atas 1 tahun berhasil dibersihkan.');
    }

    // ─────────────────────────────────────────────────────────
    //  RENDER
    // ─────────────────────────────────────────────────────────

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $this->loadOrphanedCounts();
        $this->loadOldCompletedCount();

        $query = User::with('penduduk')
            ->where('role', 'masyarakat')
            ->when($this->search, fn($q) =>
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('nik', 'like', '%' . $this->search . '%');
                })
            );

        // Filter status soft delete (Aktif / Dinonaktifkan)
        if ($this->statusFilter === 'nonaktif') {
            $query->onlyTrashed();
        } elseif ($this->statusFilter === 'semua') {
            $query->withTrashed();
        }

        $users = $query->withCount([
                'pengaduan',
                'notifikasi',
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        // Hitung pengajuan surat per user (join via id_penduduk)
        $pengajuanCounts = PengajuanSurat::whereIn(
            'id_penduduk',
            $users->pluck('id_penduduk')->filter()
        )->selectRaw('id_penduduk, COUNT(*) as total')
         ->groupBy('id_penduduk')
         ->pluck('total', 'id_penduduk');

        // Hitung statistik akun warga untuk grid
        $totalWarga = User::where('role', 'masyarakat')->withTrashed()->count();
        $aktifWarga = User::where('role', 'masyarakat')->count();
        $nonaktifWarga = User::where('role', 'masyarakat')->onlyTrashed()->count();

        return view('livewire.admin.manajemen-akun.manajemen-akun', [
            'users'           => $users,
            'pengajuanCounts' => $pengajuanCounts,
            'totalWarga'      => $totalWarga,
            'aktifWarga'      => $aktifWarga,
            'nonaktifWarga'   => $nonaktifWarga,
        ]);
    }
}
