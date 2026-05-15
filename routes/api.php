<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PendudukApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\KartuKeluargaApiController;
use App\Http\Controllers\Api\InformationApiController; // TAMBAHAN: Controller untuk Berita & Pengumuman

// =======================
// PUBLIC ROUTE
// =======================
Route::middleware('cors')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/test', fn () => response()->json(['message' => 'API berjalan']));

    // TAMBAHAN: API Berita dan Pengumuman
    // Dibuat public agar masyarakat bisa melihat informasi desa sebelum login
    Route::get('/berita', [InformationApiController::class, 'getBerita']);
    Route::get('/pengumuman', [InformationApiController::class, 'getPengumuman']);
});

// =======================
// PROTECTED (ALL LOGIN)
// =======================
Route::middleware(['auth:sanctum', 'cors'])->group(function () {

    // AUTH
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // PENDUDUK
    Route::get('/penduduk', [PendudukApiController::class, 'index']);
    Route::get('/penduduk/{id}', [PendudukApiController::class, 'show']);

    // PENGADUAN — masyarakat kirim & lihat miliknya sendiri
    Route::prefix('pengaduan')->group(function () {
        Route::get('/',     [PengaduanController::class, 'index']);   // GET  /api/pengaduan
        Route::post('/',    [PengaduanController::class, 'store']);   // POST /api/pengaduan
        Route::get('/{id}', [PengaduanController::class, 'show']);    // GET  /api/pengaduan/{id}
    });
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

    // TAMBAHAN: Tarik Data Kartu Keluarga Sendiri

    Route::get('/my-kk', [KartuKeluargaApiController::class, 'myKk']);

    // TAMBAHAN: Update Profil
    // Menyesuaikan dengan fungsi updateProfile() yang sudah ada di auth_service.dart Flutter
    Route::put('/profile/update', [UserController::class, 'updateProfile']);
    
});