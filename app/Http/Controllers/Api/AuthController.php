<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required|min:6'
    ]);

    if (!Auth::attempt([
        'nik' => $request->nik,
        'password' => $request->password
    ])) {
        return response()->json([
            'status' => 'error',
            'message' => 'NIK atau password salah'
        ], 401);
    }

    $user = Auth::user();

    if (!$user->role) {
        return response()->json([
            'status' => 'error',
            'message' => 'Role belum diset'
        ], 500);
    }

    if ($user->role !== 'masyarakat') {
        return response()->json([
            'status' => 'error',
            'message' => 'Akses hanya untuk masyarakat'
        ], 403);
    }

    $user->tokens()->delete();

    $token = $user->createToken('mobile-token')->plainTextToken;

    $penduduk = $user->penduduk;
    if (!$penduduk && $user->nik) {
        $penduduk = \App\Models\Penduduk::where('nik', $user->nik)->first();
        if ($penduduk) {
            $user->update(['id_penduduk' => $penduduk->id_penduduk]);
        }
    }
    
    $alamat = '';
    $tempatLahir = '';
    $tanggalLahir = '';
    $noKk = '';
    $agama = '';

    if ($penduduk) {
        $alamat = $penduduk->alamat ?? '';
        $tempatLahir = $penduduk->tempat_lahir ?? '';
        $tanggalLahir = $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('Y-m-d') : '';
        $agama = $penduduk->agama ?? '';
        
        $kartuKeluarga = $penduduk->kartuKeluarga;
        if ($kartuKeluarga) {
            $noKk = $kartuKeluarga->nomor_kartu_keluarga ?? '';
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Login berhasil',
        'data' => [
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'nik' => $user->nik,
                'role' => $user->role,
                'alamat' => $alamat,
                'tempat_lahir' => $tempatLahir,
                'tanggal_lahir' => $tanggalLahir,
                'no_kk' => $noKk,
                'agama' => $agama
            ]
        ]
    ]);
}

    public function me(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }
}