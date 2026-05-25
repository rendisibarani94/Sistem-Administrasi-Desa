<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // REGISTER (PUBLIC)
    // =========================
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nik' => 'required|digits:16|unique:users,nik',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'nik' => $request->nik,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'masyarakat'
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Register berhasil',
        'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'nik' => $user->nik,
            'email' => $user->email,
            'role' => $user->role
        ]
    ]);
}

    // =========================
    // GET ALL USERS (ADMIN)
    // =========================
    public function index()
    {
        $users = User::select('id', 'name', 'nik', 'email', 'role')->get();

        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    // =========================
    // TAMBAH USER (ADMIN)
    // =========================
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'nik' => 'required|digits:16|unique:users,nik',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:masyarakat,admin,kades'
    ]);

    $user = User::create([
        'name' => $request->name,
        'nik' => $request->nik,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'User berhasil dibuat',
        'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'nik' => $user->nik,
            'email' => $user->email,
            'role' => $user->role
        ]
    ], 201);
}
    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:users,nik,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'in:masyarakat,admin'
        ]);

        $user->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'role' => $request->role ?? $user->role
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil diupdate',
            'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'nik' => $user->nik,
            'email' => $user->email,
            'role' => $user->role
        ]
        ]);
    }

    // =========================
    // DELETE USER
    // =========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus'
        ]);
    }

    // ==================================================
    // UPDATE PROFILE (NEW FOR MOBILE CLIENT)
    // ==================================================
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesi tidak valid'
            ], 401);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'no_kk' => 'nullable|string',
        ]);

        // Update User name
        $user->update([
            'name' => $request->nama,
        ]);

        // Update Penduduk relationship
        $penduduk = $user->penduduk;
        if ($penduduk) {
            $penduduk->update([
                'nama_lengkap' => $request->nama,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            // Update Kartu Keluarga nomor_kartu_keluarga
            if ($request->filled('no_kk')) {
                $kartuKeluarga = $penduduk->kartuKeluarga;
                if ($kartuKeluarga) {
                    $kartuKeluarga->update([
                        'nomor_kartu_keluarga' => $request->no_kk,
                    ]);
                } else {
                    $newKk = \App\Models\KartuKeluarga::create([
                        'nomor_kartu_keluarga' => $request->no_kk,
                        'alamat_kk' => $request->alamat ?? '',
                    ]);
                    $penduduk->update([
                        'id_kartu_keluarga' => $newKk->id_kartu_keluarga,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui'
        ]);
    }
}