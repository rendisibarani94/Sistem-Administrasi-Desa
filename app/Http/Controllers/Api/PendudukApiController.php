<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendudukApiController extends Controller
{
    /**
     * ==========================================
     * GET /api/penduduk
     * List + Search + Pagination
     * ==========================================
     */
    public function index(Request $request)
    {
        $query = Penduduk::query()
            ->where('is_deleted', 0)
            ->where('is_mutated', 0);

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_telepon', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data penduduk berhasil diambil',
            'data'    => $data
        ]);
    }

    /**
     * ==========================================
     * GET /api/penduduk/{id}
     * Detail Penduduk
     * ==========================================
     */
    public function show($id)
    {
        $data = Penduduk::where('id_penduduk', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data penduduk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $data
        ]);
    }

    /**
     * ==========================================
     * POST /api/penduduk
     * Tambah Penduduk
     * ==========================================
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16|unique:penduduk,nik',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|max:150',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'nullable|digits_between:10,15',
            'agama' => 'required',
            'pekerjaan' => 'required|max:100',
            'id_kartu_keluarga' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = Penduduk::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'id_kartu_keluarga' => $request->id_kartu_keluarga,
            'is_deleted' => 0,
            'is_mutated' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Penduduk berhasil ditambahkan',
            'data' => $data
        ]);
    }

    /**
     * ==========================================
     * PUT /api/penduduk/{id}
     * Update Penduduk
     * ==========================================
     */
    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::where('id_penduduk', $id)->first();

        if (!$penduduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|max:100',
            'alamat' => 'required|max:150',
            'nomor_telepon' => 'nullable|digits_between:10,15',
            'pekerjaan' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $penduduk->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'pekerjaan' => $request->pekerjaan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
            'data' => $penduduk
        ]);
    }

    /**
     * ==========================================
     * DELETE /api/penduduk/{id}
     * Soft Delete
     * ==========================================
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::where('id_penduduk', $id)->first();

        if (!$penduduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $penduduk->update([
            'is_deleted' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data penduduk berhasil dihapus'
        ]);
    }
}