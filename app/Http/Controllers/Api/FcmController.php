<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcmController extends Controller
{
    /**
     * Menerima FCM token dari aplikasi Flutter dan menyimpan ke database.
     * POST /api/fcm-token
     * 
     * Body: { "fcm_token": "xxx..." }
     */
    public function updateToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $user->update([
            'fcm_token' => $request->fcm_token,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'FCM token berhasil disimpan.',
        ]);
    }
}
