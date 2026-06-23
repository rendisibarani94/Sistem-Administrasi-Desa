<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndukPendudukController extends Component
{
    use WithPagination;

    public $deleteId;
    public $search;

    // Account Creation Modal States
    public $showAccountModal = false;
    public $isEditMode = false;
    public $selectedPendudukId;
    public $selectedPendudukName;
    public $selectedPendudukNik;
    public $email;
    public $password;
    public $confirm_password;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data penduduk ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('penduduk')
            ->where('id_penduduk', $this->deleteId)
            ->update(['is_deleted' => 1, 'updated_at' => now()]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data penduduk berhasil dihapus.',
        ]);
    }

    public function mutasi($id_penduduk)
    {

        $penduduk = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('id_penduduk', $id_penduduk)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->first();

        $familyCardId = DB::table('penduduk')->where('id_penduduk', $id_penduduk)->value('id_kartu_keluarga');


        // 1. Check if he is a non-deleted Head
        $isHead = DB::table('penduduk')
            ->where('id_penduduk', $id_penduduk)
            ->where('is_deleted', 0)
            ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->exists();

        // 2. Check if he is the only one in his family
        $isOnlyMember = DB::table('penduduk')
            ->where('id_kartu_keluarga', $familyCardId) // Get this from the first query if needed
            ->where('is_deleted', 0)
            ->count() == 1; // Only 1 member left?

        $isLoneHead = $isHead && $isOnlyMember;

        if ($isLoneHead) {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
        if ($penduduk) {
            return $this->redirect(route('indukPenduduk.mutasi.kepala-keluarga', ['id' => $id_penduduk]));
        } else {
            return $this->redirect(route('indukPenduduk.mutasi', ['id' => $id_penduduk]));
        }
    }

    // ==================================================
    // ACCOUNTS MANAGEMENT METHODS
    // ==================================================
    public function openCreateAccountModal($id_penduduk)
    {
        $penduduk = DB::table('penduduk')
            ->leftJoin('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->where('penduduk.id_penduduk', $id_penduduk)
            ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga')
            ->first();

        if ($penduduk) {
            // Backend validation to restrict only KEPALA KELUARGA
            if (strtoupper($penduduk->kedudukan_keluarga) !== 'KEPALA KELUARGA') {
                $this->dispatch('swal:success', [
                    'title' => 'Akses Ditolak!',
                    'text' => 'Pembuatan akun hanya diperbolehkan untuk Kepala Keluarga.',
                ]);
                return;
            }

            $this->selectedPendudukId = $id_penduduk;
            $this->selectedPendudukName = $penduduk->nama_lengkap;
            $this->selectedPendudukNik = $penduduk->nomor_kartu_keluarga ?? '-';
            $this->email = '';
            $this->password = 'password123'; // Default password
            $this->isEditMode = false;
            $this->showAccountModal = true;
        }
    }

    public function openResetPasswordModal($id_penduduk)
    {
        $penduduk = DB::table('penduduk')
            ->leftJoin('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->where('penduduk.id_penduduk', $id_penduduk)
            ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga')
            ->first();

        $userAcc = DB::table('users')->where('id_penduduk', $id_penduduk)->first();
        if ($penduduk && $userAcc) {
            $this->selectedPendudukId = $id_penduduk;
            $this->selectedPendudukName = $penduduk->nama_lengkap;
            $this->selectedPendudukNik = $penduduk->nomor_kartu_keluarga ?? '-';
            $this->email = $userAcc->email;
            $this->password = '';
            $this->confirm_password = '';
            $this->isEditMode = true;
            $this->showAccountModal = true;
        }
    }

    public function closeAccountModal()
    {
        $this->showAccountModal = false;
        $this->reset(['selectedPendudukId', 'selectedPendudukName', 'selectedPendudukNik', 'email', 'password', 'confirm_password', 'isEditMode']);
        $this->resetErrorBag();
    }

    public function saveAccount()
    {
        if ($this->isEditMode) {
            $this->validate([
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ], [
                'password.required' => 'Password baru wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'confirm_password.required' => 'Konfirmasi password wajib diisi.',
                'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
            ]);

            // Pastikan kolom password_plain tersedia di tabel users (Self-healing schema)
            if (!Schema::hasColumn('users', 'password_plain')) {
                Schema::table('users', function ($table) {
                    $table->string('password_plain')->nullable();
                });
            }

            // Update user password and plain password
            DB::table('users')
                ->where('id_penduduk', $this->selectedPendudukId)
                ->update([
                    'password' => bcrypt($this->password),
                    'password_plain' => $this->password,
                    'updated_at' => now(),
                ]);

            $successTitle = 'Sandi Berhasil Diubah! 🔒';
            $successText = 'Kata sandi untuk ' . $this->selectedPendudukName . ' telah berhasil diubah dan dicatat pada pertinggal spreadsheet.';
        } else {
            // Backend safeguard validation
            $pendudukCheck = DB::table('penduduk')->where('id_penduduk', $this->selectedPendudukId)->first();
            if (!$pendudukCheck || strtoupper($pendudukCheck->kedudukan_keluarga) !== 'KEPALA KELUARGA') {
                $this->dispatch('swal:success', [
                    'title' => 'Akses Ditolak!',
                    'text' => 'Pembuatan akun hanya diperbolehkan untuk Kepala Keluarga.',
                ]);
                $this->closeAccountModal();
                return;
            }

            $this->validate([
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ], [
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'confirm_password.required' => 'Konfirmasi password wajib diisi.',
                'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
            ]);

            // Pastikan kolom password_plain tersedia di tabel users (Self-healing schema)
            if (!Schema::hasColumn('users', 'password_plain')) {
                Schema::table('users', function ($table) {
                    $table->string('password_plain')->nullable();
                });
            }

            // Fetch resident's Nomor KK
            $nomorKk = DB::table('penduduk')
                ->leftJoin('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
                ->where('penduduk.id_penduduk', $this->selectedPendudukId)
                ->value('kartu_keluarga.nomor_kartu_keluarga');

            $username = $nomorKk ?? $this->selectedPendudukNik;
            $this->email = $username . '@mail.com';

            // Insert new user account tied to selected citizen
            DB::table('users')->insert([
                'name' => $this->selectedPendudukName,
                'nik' => $username,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'password_plain' => $this->password, // Simpan password polos ke database
                'role' => 'masyarakat',
                'id_penduduk' => $this->selectedPendudukId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $successTitle = 'Akun Berhasil Dibuat! 🎉';
            $successText = 'Akun kependudukan untuk ' . $this->selectedPendudukName . ' telah berhasil dibuat dan dicatat pada pertinggal spreadsheet.';
        }

        // Fetch resident info (including Dusun) for the CSV spreadsheet
        $penduduk = DB::table('penduduk')->where('id_penduduk', $this->selectedPendudukId)->first();
        $dusunName = '-';
        if ($penduduk && !empty($penduduk->dusun)) {
            $dusunName = DB::table('dusun')->where('id_dusun', $penduduk->dusun)->value('dusun') ?? $penduduk->dusun;
        }

        // Tulis pertinggal akun ke file CSV spreadsheet
        $directory = public_path('excel');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $filePath = $directory . '/pertinggal_akun_warga.csv';
        $fileExists = file_exists($filePath);

        $file = fopen($filePath, 'a');
        if ($file) {
            // Jika file baru dibuat, tulis header CSV terlebih dahulu
            if (!$fileExists) {
                // Tulis BOM UTF-8 agar Excel membuka karakter dengan benar
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($file, [
                    'Nama Lengkap',
                    'NIK',
                    'Email Warga',
                    'Password',
                    'Confirm Password',
                    'Dusun',
                    'Tanggal Dibuat'
                ], ';');
            }

            fputcsv($file, [
                $this->selectedPendudukName,
                "'" . $this->selectedPendudukNik, // Prefix single quote agar tidak dibulatkan di Excel
                $this->email,
                $this->password,
                $this->password,
                $dusunName,
                now()->format('Y-m-d H:i:s')
            ], ';');
            fclose($file);
        }

        $this->dispatch('swal:success', [
            'title' => $successTitle,
            'text' => $successText,
        ]);

        $this->closeAccountModal();
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        try {
            // Self-healing database: update masyarakat accounts only when the target email is not already in use.
            $usersToFix = DB::table('users')
                ->where('role', 'masyarakat')
                ->whereNotNull('id_penduduk')
                ->get();

            foreach ($usersToFix as $userFix) {
                $nomorKk = DB::table('penduduk')
                    ->leftJoin('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
                    ->where('penduduk.id_penduduk', $userFix->id_penduduk)
                    ->value('kartu_keluarga.nomor_kartu_keluarga');

                if ($nomorKk && $userFix->nik !== $nomorKk) {
                    $targetEmail = $nomorKk . '@mail.com';
                    $emailInUse = DB::table('users')
                        ->where('email', $targetEmail)
                        ->where('id', '!=', $userFix->id)
                        ->exists();

                    if ($emailInUse) {
                        continue;
                    }

                    DB::table('users')
                        ->where('id', $userFix->id)
                        ->update([
                            'nik' => $nomorKk,
                            'email' => $targetEmail,
                            'updated_at' => now(),
                        ]);
                }
            }


        } catch (\Throwable $e) {
            report($e);
        }

        return view(
            'admin.kependudukan.induk-penduduk.index',
            [
                'pendudukData' => DB::table('penduduk')
                    ->when($this->search, function ($query) {
                        return $query->where(function ($subQuery) {
                            $subQuery->where('nama_lengkap', 'like', '%' . $this->search . '%')
                                ->orWhere('nik', 'like', '%' . $this->search . '%')
                                ->orWhere('alamat', 'like', '%' . $this->search . '%')
                                ->orWhere('status_perkawinan', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->where('is_deleted', 0)
                    ->where('is_mutated', 0)
                    // ->whereNull('tanggal_pengurangan')
                    ->paginate(5)
            ]
        );
    }

    public function exportAllAccounts(): StreamedResponse
    {
        // Pastikan kolom password_plain tersedia di tabel users (Self-healing schema)
        if (!Schema::hasColumn('users', 'password_plain')) {
            Schema::table('users', function ($table) {
                $table->string('password_plain')->nullable();
            });
        }

        $accounts = DB::table('users')
            ->leftJoin('penduduk', 'users.id_penduduk', '=', 'penduduk.id_penduduk')
            ->leftJoin('dusun', 'penduduk.dusun', '=', 'dusun.id_dusun')
            ->select('users.name', 'users.nik', 'users.email', 'users.password_plain', 'dusun.dusun as nama_dusun', 'users.created_at')
            ->where('users.role', 'masyarakat')
            ->get();

        $fileName = 'pertinggal-semua-akun-warga-' . now()->format('YmdHis') . '.xlsx';

        return response()->streamDownload(function() use ($accounts) {
            $writer = SimpleExcelWriter::streamDownload('php://output', 'xlsx');
            $writer->addHeader([
                'Nama Lengkap',
                'Nomor KK',
                'Email Warga',
                'Password',
                'Confirm Password',
                'Dusun',
                'Tanggal Dibuat'
            ]);

            foreach ($accounts as $row) {
                $plainPassword = !empty($row->password_plain) ? $row->password_plain : 'Terenkripsi (Akun Lama)';
                $writer->addRow([
                    $row->name,
                    "'" . $row->nik, // Prefix single quote agar Nomor KK tidak dibulatkan
                    $row->email,
                    $plainPassword,
                    $plainPassword,
                    $row->nama_dusun ?? '-',
                    $row->created_at ? date('Y-m-d H:i:s', strtotime($row->created_at)) : '-',
                ]);
            }

            $writer->close();
        }, $fileName);
    }
}