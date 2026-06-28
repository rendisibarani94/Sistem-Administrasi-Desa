<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CleanNikKkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        // Cari keys yang mengandung kata nik, kk, ktp, kartu_keluarga
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $lowerKey = strtolower($key);
                $isNikOrKk = str_contains($lowerKey, 'nik') || 
                             str_contains($lowerKey, 'kk') || 
                             str_contains($lowerKey, 'ktp') || 
                             str_contains($lowerKey, 'kartu_keluarga') ||
                             str_contains($lowerKey, 'kartu keluarga');
                
                if ($isNikOrKk) {
                    // Hilangkan semua spasi
                    $input[$key] = str_replace(' ', '', $value);
                }
            }
        }

        $request->merge($input);

        return $next($request);
    }
}
