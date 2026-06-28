<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PendudukApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\LayananSuratApiController;
use App\Http\Controllers\Api\KartuKeluargaApiController;
use App\Http\Controllers\Api\InformationApiController; // TAMBAHAN: Controller untuk Berita & Pengumuman
use App\Http\Controllers\Api\PengajuanSuratController;

use App\Http\Controllers\Api\FcmController;

// =======================
// PUBLIC ROUTE
// =======================
Route::middleware('cors')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/test', fn () => response()->json(['message' => 'API berjalan']));

    // Serve storage files with CORS headers
    Route::get('/storage/{path}', function ($path) {
        $filePath = storage_path('app/public/' . $path);
        if (!file_exists($filePath)) {
            abort(404);
        }
        $mimeType = mime_content_type($filePath);
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    })->where('path', '.*');

    // Berita & Pengumuman & Settings
    Route::get('/berita', [InformationApiController::class, 'getBerita']);
    Route::get('/pengumuman', [InformationApiController::class, 'getPengumuman']);
    Route::get('/settings', [InformationApiController::class, 'getSettings']);

    // View surat via browser (token dikirim sebagai query param ?token=xxx)
    // Diakses oleh mobile via browser untuk cetak surat resmi
    Route::get('/surat/{id}/view', function ($id) {
        $token = request()->query('token');
        if (!$token) {
            return response('<h2 style="color:red;text-align:center;font-family:Arial">Token tidak valid. Silakan login ulang di aplikasi.</h2>', 401)
                ->header('Content-Type', 'text/html');
        }

        // Autentikasi manual via token Sanctum
        $tokenRecord = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
        if (!$tokenRecord) {
            return response('<h2 style="color:red;text-align:center;font-family:Arial">Sesi habis. Silakan login ulang.</h2>', 401)
                ->header('Content-Type', 'text/html');
        }

        $user = $tokenRecord->tokenable;
        \Auth::login($user);

        return app(\App\Http\Controllers\Api\InformationApiController::class)
            ->viewSurat(request(), $id);
    });
});

// =======================
// PROTECTED (ALL LOGIN)
// =======================
Route::middleware(['auth:sanctum', 'cors'])->group(function () {

    // AUTH
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // FCM TOKEN (untuk push notification)
    Route::post('/fcm-token', [FcmController::class, 'updateToken']);

    // NOTIFIKASI
    Route::get('/notifikasi', [InformationApiController::class, 'getNotifikasi']);
    Route::patch('/notifikasi/{id}/read', [InformationApiController::class, 'markNotifikasiRead']);

    // SURAT — download (hanya untuk Bearer token, view ada di public route)
    Route::get('/surat/{id}/download', [SuratController::class, 'download']);

    // PENDUDUK
    Route::get('/penduduk', [PendudukApiController::class, 'index']);
    Route::get('/penduduk/{id}', [PendudukApiController::class, 'show']);

    // PENGADUAN — masyarakat kirim & lihat miliknya sendiri
    Route::prefix('pengaduan')->group(function () {
        Route::get('/',     [PengaduanController::class, 'index']);
        Route::post('/',    [PengaduanController::class, 'store']);
        Route::get('/{id}', [PengaduanController::class, 'show']);
    });

    // DYNAMIC FORMS / PENGAJUAN SURAT BARU (EAV)
    Route::get('/dynamic/jenis-surat', [PengajuanSuratController::class, 'getJenisSurat']);
    Route::get('/dynamic/persyaratan/{jenis_surat_id}', [PengajuanSuratController::class, 'getPersyaratan']);
    Route::post('/dynamic/pengajuan', [PengajuanSuratController::class, 'storePengajuan']);
});


// =======================
// ADMIN ONLY
// =======================
Route::middleware(['auth:sanctum', 'role:admin', 'cors'])->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::post('/surat/{id}/approve-admin', [SuratController::class, 'approveAdmin']);
    Route::post('/surat/{id}/reject-admin', [SuratController::class, 'rejectAdmin']);
    Route::post('/surat/{id}/approve', [SuratController::class, 'approve']);
    Route::post('/surat/{id}/reject', [SuratController::class, 'reject']);

    Route::get('/kartu-keluarga', [KartuKeluargaApiController::class, 'index']);
    Route::get('/kartu-keluarga/{id}', [KartuKeluargaApiController::class, 'show']);
    Route::post('/kartu-keluarga', [KartuKeluargaApiController::class, 'store']);

    Route::post('/penduduk', [PendudukApiController::class, 'store']);
    Route::put('/penduduk/{id}', [PendudukApiController::class, 'update']);
    Route::delete('/penduduk/{id}', [PendudukApiController::class, 'destroy']);

    // PENGADUAN — admin kelola semua pengaduan
    Route::prefix('admin/pengaduan')->group(function () {
        Route::get('/',              [PengaduanController::class, 'adminIndex']);    // GET    /api/admin/pengaduan
        Route::get('/{id}',          [PengaduanController::class, 'adminShow']);    // GET    /api/admin/pengaduan/{id}
        Route::patch('/{id}/status', [PengaduanController::class, 'updateStatus']); // PATCH  /api/admin/pengaduan/{id}/status
        Route::delete('/{id}',       [PengaduanController::class, 'destroy']);      // DELETE /api/admin/pengaduan/{id}
    });
});

// =======================
// MASYARAKAT ONLY
// =======================
Route::middleware(['auth:sanctum', 'role:masyarakat', 'cors'])->group(function () {

    // SURAT
    Route::get('/surat', [SuratController::class, 'index']);
    Route::post('/surat', [SuratController::class, 'store']);
    Route::get('/surat/{id}', [SuratController::class, 'show']);
    Route::get('/jenis-surat', [SuratController::class, 'jenisSurat']);
    Route::post('/layanan-surat', [LayananSuratApiController::class, 'store']);

    // TAMBAHAN: Tarik Data Kartu Keluarga Sendiri

    Route::get('/my-kk', [KartuKeluargaApiController::class, 'myKk']);

    // TAMBAHAN: Update Profil
    // Menyesuaikan dengan fungsi updateProfile() yang sudah ada di auth_service.dart Flutter
    Route::put('/profile/update', [UserController::class, 'updateProfile']);
    
});