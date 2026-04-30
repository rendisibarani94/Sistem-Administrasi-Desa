<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // =========================
        // 1. CHECK AUTH
        // =========================
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // =========================
        // 2. SAFETY ROLE NULL
        // =========================
        if (!$user->role) {
            return response()->json([
                'status' => 'error',
                'message' => 'Role user tidak valid'
            ], 403);
        }

        // =========================
        // 3. IF NO ROLE RESTRICTION
        // =========================
        if (empty($roles)) {
            return $next($request);
        }

        // =========================
        // 4. ROLE CHECK
        // =========================
        if (!in_array($user->role, $roles)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak (role tidak sesuai)',
                'your_role' => $user->role,
                'allowed_roles' => $roles
            ], 403);
        }

        return $next($request);
    }
}