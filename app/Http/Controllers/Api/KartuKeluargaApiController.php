<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaApiController extends Controller
{
    /**
     * GET /api/kartu-keluarga
     */
    public function index(Request $request)
    {
        $query = KartuKeluarga::query()->where('is_deleted', 0);

        if ($request->search) {
            $query->where('nomor_kartu_keluarga', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderByDesc('id_kartu_keluarga')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kartu keluarga berhasil diambil',
            'data' => $data,
        ]);
    }

    /**
     * GET /api/kartu-keluarga/{id}
     */
    public function show($id)
    {
        $data = KartuKeluarga::where('id_kartu_keluarga', $id)
            ->where('is_deleted', 0)
            ->first();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kartu keluarga tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * POST /api/kartu-keluarga
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kartu_keluarga' => 'required|digits:16|unique:kartu_keluarga,nomor_kartu_keluarga',
            'tanggal_keluar' => 'required|date',
            'alamat_kk' => 'required|max:150',
            'rt' => 'nullable|regex:/^[\\d\\-]+$/',
            'rw' => 'nullable|regex:/^[\\d\\-]+$/',
            'desa_kelurahan' => 'required|max:50',
            'kecamatan' => 'required|max:50',
            'kabupaten_kota' => 'required|max:50',
            'kode_pos' => 'required|digits:5',
            'provinsi' => 'required|max:50',
        ]);

        $data = KartuKeluarga::create([
            'nomor_kartu_keluarga' => $validated['nomor_kartu_keluarga'],
            'tanggal_keluar' => $validated['tanggal_keluar'],
            'alamat_kk' => $validated['alamat_kk'],
            'rt' => $validated['rt'] ?? null,
            'rw' => $validated['rw'] ?? null,
            'desa_kelurahan' => $validated['desa_kelurahan'],
            'kecamatan' => $validated['kecamatan'],
            'kabupaten_kota' => $validated['kabupaten_kota'],
            'kode_pos' => $validated['kode_pos'],
            'provinsi' => $validated['provinsi'],
            'is_deleted' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kartu keluarga berhasil ditambahkan',
            'data' => $data,
        ], 201);
    }
}