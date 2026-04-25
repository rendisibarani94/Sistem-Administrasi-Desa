<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PendudukApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuratController;

// =======================
// PUBLIC ROUTE
// =======================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/test', function () {
    return response()->json([
        'message' => 'API berjalan'
    ]);
});

// =======================
// PROTECTED ROUTE
// =======================
Route::middleware('auth:sanctum')->group(function () {

    // ================= AUTH =================
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ================= SURAT =================
    Route::get('/surat', [SuratController::class, 'index']);
    Route::post('/surat', [SuratController::class, 'store']);
    Route::get('/surat/{id}', [SuratController::class, 'show']);

    Route::post('/surat/{id}/approve-admin', [SuratController::class, 'approveAdmin']);
    Route::post('/surat/{id}/reject-admin', [SuratController::class, 'rejectAdmin']);

    Route::post('/surat/{id}/approve-kades', [SuratController::class, 'approveKades']);
    Route::post('/surat/{id}/reject-kades', [SuratController::class, 'rejectKades']);

    Route::post('/surat/{id}/selesai', [SuratController::class, 'selesai']);

    // ================= USER =================
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // ================= PENDUDUK =================
    Route::get('/penduduk', [PendudukApiController::class, 'index']);

});