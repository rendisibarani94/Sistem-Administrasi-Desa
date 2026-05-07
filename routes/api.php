<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PendudukApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\NotifikasiController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengumumanController;

// =======================
// PUBLIC ROUTE
// =======================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/test', fn () => response()->json(['message' => 'API berjalan']));

// =======================
// PROTECTED (ALL LOGIN)
// =======================
Route::middleware('auth:sanctum')->group(function () {

    // AUTH
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // INFORMASI
    Route::get('/berita', [BeritaController::class, 'index']);
    Route::get('/pengumuman', [PengumumanController::class, 'index']);

    // NOTIFIKASI
    Route::get('/notifikasi', [NotifikasiController::class, 'index']);
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'read']);

    // PENDUDUK
    Route::get('/penduduk', [PendudukApiController::class, 'index']);
    Route::get('/penduduk/{id}', [PendudukApiController::class, 'show']);
});

// =======================
// ADMIN ONLY
// =======================
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::post('/pengaduan/{id}/validasi', [PengaduanController::class, 'validasi']);

    Route::post('/surat/{id}/approve-admin', [SuratController::class, 'approveAdmin']);
    Route::post('/surat/{id}/reject-admin', [SuratController::class, 'rejectAdmin']);

    Route::post('/penduduk', [PendudukApiController::class, 'store']);
    Route::put('/penduduk/{id}', [PendudukApiController::class, 'update']);
    Route::delete('/penduduk/{id}', [PendudukApiController::class, 'destroy']);
});

// =======================
// MASYARAKAT ONLY
// =======================
Route::middleware(['auth:sanctum', 'role:masyarakat'])->group(function () {

    Route::get('/surat', [SuratController::class, 'index']);
    Route::post('/surat', [SuratController::class, 'store']);
    Route::get('/surat/{id}', [SuratController::class, 'show']);

    Route::get('/pengaduan', [PengaduanController::class, 'index']);
    Route::post('/pengaduan', [PengaduanController::class, 'store']);
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']);
});

