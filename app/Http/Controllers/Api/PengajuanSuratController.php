<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\PersyaratanSurat;
use App\Models\PengajuanSurat;
use App\Models\DetailPengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanSuratController extends Controller
{
    /**
     * Mengambil daftar surat yang is_active = true.
     */
    public function getJenisSurat(): JsonResponse
    {
        try {
            $jenisSurat = JenisSurat::where('is_active', true)->get();

            return response()->json([
                'status' => true,
                'message' => 'Daftar jenis surat aktif berhasil diambil.',
                'data' => $jenisSurat
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil daftar jenis surat.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil daftar isian/syarat dari tabel persyaratan_surat berdasarkan ID surat.
     */
    public function getPersyaratan($jenis_surat_id): JsonResponse
    {
        try {
            // Validasi apakah jenis surat ada
            $jenisSurat = JenisSurat::find($jenis_surat_id);
            if (!$jenisSurat) {
                return response()->json([
                    'status' => false,
                    'message' => 'Jenis surat tidak ditemukan.'
                ], 404);
            }

            $persyaratan = PersyaratanSurat::where('jenis_surat_id', $jenis_surat_id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Daftar persyaratan surat berhasil diambil.',
                'data' => $persyaratan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil persyaratan surat.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menerima data submit dari Flutter.
     * Menggunakan DB::transaction untuk mencegah data parsial tersimpan.
     */
    public function storePengajuan(Request $request): JsonResponse
    {
        // 1. Validasi Awal Input
        $validator = Validator::make($request->all(), [
            'jenis_surat_id' => 'required|integer|exists:jenis_surat,id_jenis_surat',
            'answers' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $jenisSuratId = $request->input('jenis_surat_id');
        $user = Auth::user();

        // Pastikan user sedang login
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated. Silakan login terlebih dahulu.'
            ], 401);
        }

        // Ambil semua daftar persyaratan untuk jenis surat ini
        $daftarPersyaratan = PersyaratanSurat::where('jenis_surat_id', $jenisSuratId)->get();

        $idPenduduk = $user->id_penduduk ?? $user->id;

        // Prevent duplicate pending requests
        $pengajuanAktif = PengajuanSurat::where('id_penduduk', $idPenduduk)
            ->where('id_jenis_surat', $jenisSuratId)
            ->whereIn('status', ['diajukan', 'diproses'])
            ->first();

        if ($pengajuanAktif) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah memiliki pengajuan surat jenis ini yang sedang diproses atau menunggu persetujuan.'
            ], 422);
        }

        // 2. Mulai DB Transaction
        DB::beginTransaction();

        try {
            // A. Insert ke tabel pengajuan_surat
            // PENTING: Gunakan kolom asli (id_penduduk, id_jenis_surat) secara langsung
            // agar relasi penduduk di admin web dapat terbaca dengan benar
            $idPenduduk = $user->id_penduduk ?? $user->id;
            $pengajuan = PengajuanSurat::create([
                'id_penduduk'    => $idPenduduk,
                'id_jenis_surat' => $jenisSuratId,
                'status'         => 'diajukan',
            ]);

            // Ambil jawaban teks dan file
            $answers = $request->input('answers', []);
            $files = $request->file('answers', []);

            $dataForm = [];

            // B. Looping untuk insert detail pengajuan
            foreach ($daftarPersyaratan as $syarat) {
                $value = null;
                $normKey = strtolower(str_replace(' ', '_', trim($syarat->nama_field)));

                if ($syarat->tipe_field === 'file_image') {
                    // Cari file dari request (mendukung format nested 'answers.id' dan flat array)
                    $uploadedFile = null;
                    if ($request->hasFile("answers.{$syarat->id}")) {
                        $uploadedFile = $request->file("answers.{$syarat->id}");
                    } elseif (isset($files[$syarat->id])) {
                        $uploadedFile = $files[$syarat->id];
                    }

                    if ($uploadedFile) {
                        // Validasi file agar dipastikan gambar
                        $fileValidator = Validator::make(['file' => $uploadedFile], [
                            'file' => 'image|mimes:jpeg,png,jpg,webp|max:10240' // max 10MB
                        ]);

                        if ($fileValidator->fails()) {
                            DB::rollBack();
                            return response()->json([
                                'status' => false,
                                'message' => "Berkas untuk '{$syarat->nama_field}' harus berupa gambar valid (jpg, png, jpeg, webp) dengan ukuran maksimal 10MB.",
                                'errors' => $fileValidator->errors()
                            ], 422);
                        }

                        // Simpan file ke storage/app/public/pengajuan
                        $path = $uploadedFile->store('pengajuan', 'public');
                        $value = $path;
                    } else {
                        // Jika field ini wajib namun tidak diunggah
                        if ($syarat->is_required) {
                            DB::rollBack();
                            return response()->json([
                                'status' => false,
                                'message' => "Berkas persyaratan '{$syarat->nama_field}' wajib diunggah."
                            ], 422);
                        }
                    }
                } else {
                    // Field non-file (text, number, date)
                    // Gunakan data persis seperti yang dikirim dari aplikasi mobile
                    $value = isset($answers[$syarat->id]) ? $answers[$syarat->id] : null;

                    // Validasi requirement wajib
                    if ($syarat->is_required && (is_null($value) || $value === '')) {
                        DB::rollBack();
                        return response()->json([
                            'status' => false,
                            'message' => "Persyaratan '{$syarat->nama_field}' wajib diisi."
                        ], 422);
                    }
                }

                // C. Insert ke detail_pengajuan_surat
                DetailPengajuanSurat::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan_surat,
                    'persyaratan_id' => $syarat->id,
                    'value' => $value
                ]);

                // D. Tambah ke dataForm jika ada value
                if (!is_null($value)) {
                    $dataForm[$normKey] = $value;
                }
            }

            // E. Update kolom data_form di tabel pengajuan_surat
            $pengajuan->update([
                'data_form' => $dataForm
            ]);

            // Commit jika semua proses berhasil
            DB::commit();

            // F. Kirim notifikasi ke semua admin
            $jenisSuratNama = \App\Models\JenisSurat::find($jenisSuratId)?->nama_surat ?? 'Surat';
            \App\Models\User::where('role', 'admin')->each(function ($admin) use ($pengajuan, $jenisSuratNama, $user) {
                \App\Models\Notifikasi::create([
                    'user_id' => $admin->id,
                    'judul'   => 'Pengajuan Surat Baru 📄',
                    'pesan'   => "{$user->name} mengajukan {$jenisSuratNama}. Silakan tinjau di halaman Pengajuan Surat.",
                    'is_read' => false,
                ]);
            });

            // G. Kirim notifikasi konfirmasi ke pemohon
            \App\Models\Notifikasi::create([
                'user_id' => $user->id,
                'judul'   => 'Pengajuan Berhasil Dikirim ✅',
                'pesan'   => "Pengajuan {$jenisSuratNama} Anda berhasil dikirim dan sedang menunggu verifikasi admin desa.",
                'is_read' => false,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Pengajuan surat berhasil dikirim.',
                'data'    => $pengajuan->load('detailPengajuanSurat.persyaratanSurat')
            ], 201);

        } catch (\Exception $e) {
            // Rollback jika terjadi kegagalan sistem/database
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Gagal memproses pengajuan surat.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update pengajuan surat yang sudah ada.
     * Hanya bisa dilakukan jika status masih 'diajukan' (menunggu).
     */
    public function updatePengajuan(Request $request, $id): JsonResponse
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            'answers' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated. Silakan login terlebih dahulu.'
            ], 401);
        }

        // 2. Cari pengajuan
        $idPenduduk = $user->id_penduduk ?? $user->id;
        $pengajuan = PengajuanSurat::where('id_pengajuan_surat', $id)
            ->where('id_penduduk', $idPenduduk)
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'status' => false,
                'message' => 'Pengajuan tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }

        // 3. Cek status — hanya bisa edit jika masih 'diajukan'
        if ($pengajuan->status !== 'diajukan') {
            return response()->json([
                'status' => false,
                'message' => 'Pengajuan tidak dapat diedit karena sudah diproses oleh admin.'
            ], 403);
        }

        // 4. Ambil persyaratan
        $daftarPersyaratan = PersyaratanSurat::where('jenis_surat_id', $pengajuan->id_jenis_surat)->get();

        DB::beginTransaction();

        try {
            // A. Hapus detail lama
            DetailPengajuanSurat::where('pengajuan_id', $pengajuan->id_pengajuan_surat)->delete();

            // B. Proses jawaban baru
            $answers = $request->input('answers', []);
            $files = $request->file('answers', []);
            $dataForm = [];

            foreach ($daftarPersyaratan as $syarat) {
                $value = null;
                $normKey = strtolower(str_replace(' ', '_', trim($syarat->nama_field)));

                if ($syarat->tipe_field === 'file_image') {
                    $uploadedFile = null;
                    if ($request->hasFile("answers.{$syarat->id}")) {
                        $uploadedFile = $request->file("answers.{$syarat->id}");
                    } elseif (isset($files[$syarat->id])) {
                        $uploadedFile = $files[$syarat->id];
                    }

                    if ($uploadedFile) {
                        $fileValidator = Validator::make(['file' => $uploadedFile], [
                            'file' => 'image|mimes:jpeg,png,jpg,webp|max:10240'
                        ]);

                        if ($fileValidator->fails()) {
                            DB::rollBack();
                            return response()->json([
                                'status' => false,
                                'message' => "Berkas untuk '{$syarat->nama_field}' harus berupa gambar valid (jpg, png, jpeg, webp) dengan ukuran maksimal 10MB.",
                                'errors' => $fileValidator->errors()
                            ], 422);
                        }

                        $path = $uploadedFile->store('pengajuan', 'public');
                        $value = $path;
                    } else {
                        // Cek apakah ada value lama yang dikirim sebagai string (path lama dipertahankan)
                        $existingValue = isset($answers[$syarat->id]) ? $answers[$syarat->id] : null;
                        if ($existingValue && is_string($existingValue) && !empty($existingValue)) {
                            $value = $existingValue;
                        } elseif ($syarat->is_required) {
                            DB::rollBack();
                            return response()->json([
                                'status' => false,
                                'message' => "Berkas persyaratan '{$syarat->nama_field}' wajib diunggah."
                            ], 422);
                        }
                    }
                } else {
                    // Field non-file (text, number, date)
                    // Gunakan data persis seperti yang dikirim dari aplikasi mobile
                    $value = isset($answers[$syarat->id]) ? $answers[$syarat->id] : null;

                    if ($syarat->is_required && (is_null($value) || $value === '')) {
                        DB::rollBack();
                        return response()->json([
                            'status' => false,
                            'message' => "Persyaratan '{$syarat->nama_field}' wajib diisi."
                        ], 422);
                    }
                }

                // C. Insert detail baru
                DetailPengajuanSurat::create([
                    'pengajuan_id' => $pengajuan->id_pengajuan_surat,
                    'persyaratan_id' => $syarat->id,
                    'value' => $value
                ]);

                if (!is_null($value)) {
                    $dataForm[$normKey] = $value;
                }
            }

            // D. Update data_form di tabel pengajuan_surat
            $pengajuan->update([
                'data_form' => $dataForm
            ]);

            DB::commit();

            // E. Kirim notifikasi ke admin
            $jenisSuratNama = \App\Models\JenisSurat::find($pengajuan->id_jenis_surat)?->nama_surat ?? 'Surat';
            \App\Models\User::where('role', 'admin')->each(function ($admin) use ($pengajuan, $jenisSuratNama, $user) {
                \App\Models\Notifikasi::create([
                    'user_id' => $admin->id,
                    'judul'   => 'Pengajuan Surat Diperbarui ✏️',
                    'pesan'   => "{$user->name} memperbarui pengajuan {$jenisSuratNama}. Silakan tinjau kembali.",
                    'is_read' => false,
                ]);
            });

            return response()->json([
                'status'  => true,
                'message' => 'Pengajuan surat berhasil diperbarui.',
                'data'    => $pengajuan->load('detailPengajuanSurat.persyaratanSurat')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui pengajuan surat.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
