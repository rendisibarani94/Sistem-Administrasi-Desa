<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user(); // lebih clean dari auth()->user()

        // belum login
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // role kosong (safety)
        if (empty($roles)) {
            return $next($request);
        }

        // cek role
        if (!in_array($user->role, $roles)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak (role tidak sesuai)',
                'role_user' => $user->role
            ], 403);
        }

        return $next($request);
    }
}