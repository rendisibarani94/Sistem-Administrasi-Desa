<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * Firebase Cloud Messaging Service
 * 
 * Mengirim push notification ke perangkat Android melalui FCM HTTP v1 API.
 * Menggunakan Service Account JSON untuk autentikasi (OAuth2).
 * Tidak memerlukan package tambahan — cukup HTTP client bawaan Laravel.
 */
class FcmService
{
    /**
     * Path ke file Service Account JSON dari Firebase Console
     */
    private function getCredentialsPath(): string
    {
        return storage_path('app/firebase/service-account.json');
    }

    /**
     * Ambil Project ID dari Service Account JSON
     */
    private function getProjectId(): ?string
    {
        $path = $this->getCredentialsPath();
        if (!file_exists($path)) {
            Log::warning('FCM: service-account.json tidak ditemukan di ' . $path);
            return null;
        }

        $credentials = json_decode(file_get_contents($path), true);
        return $credentials['project_id'] ?? null;
    }

    /**
     * Generate OAuth2 Access Token dari Service Account JSON
     * Token di-cache selama 50 menit (masa berlaku aslinya 60 menit)
     */
    private function getAccessToken(): ?string
    {
        return Cache::remember('fcm_access_token', 3000, function () {
            $path = $this->getCredentialsPath();
            if (!file_exists($path)) {
                Log::warning('FCM: service-account.json tidak ditemukan');
                return null;
            }

            $credentials = json_decode(file_get_contents($path), true);

            // Buat JWT untuk request OAuth2 token
            $now = time();
            $header = $this->base64UrlEncode(json_encode([
                'alg' => 'RS256',
                'typ' => 'JWT',
            ]));

            $payload = $this->base64UrlEncode(json_encode([
                'iss'   => $credentials['client_email'],
                'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                'aud'   => 'https://oauth2.googleapis.com/token',
                'iat'   => $now,
                'exp'   => $now + 3600,
            ]));

            $unsignedToken = $header . '.' . $payload;

            // Sign dengan private key dari service account
            $privateKey = openssl_pkey_get_private($credentials['private_key']);
            if (!$privateKey) {
                Log::error('FCM: Gagal memuat private key dari service-account.json');
                return null;
            }

            openssl_sign($unsignedToken, $signature, $privateKey, OPENSSL_ALGO_SHA256);
            $jwt = $unsignedToken . '.' . $this->base64UrlEncode($signature);

            // Tukar JWT dengan Access Token
            try {
                $response = Http::withoutVerifying()->asForm()->post('https://oauth2.googleapis.com/token', [
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion'  => $jwt,
                ]);

                if ($response->successful()) {
                    return $response->json('access_token');
                }

                Log::error('FCM: Gagal mendapat access token', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            } catch (\Throwable $e) {
                Log::error('FCM: Error saat request access token: ' . $e->getMessage());
            }

            return null;
        });
    }

    /**
     * Kirim push notification ke satu user
     */
    public function sendToUser(User $user, string $title, string $body): bool
    {
        if (empty($user->fcm_token)) {
            Log::info("FCM: User #{$user->id} tidak memiliki FCM token, skip push.");
            return false;
        }

        return $this->sendToToken($user->fcm_token, $title, $body);
    }

    /**
     * Kirim push notification ke FCM token tertentu
     */
    public function sendToToken(string $fcmToken, string $title, string $body): bool
    {
        $accessToken = $this->getAccessToken();
        $projectId   = $this->getProjectId();

        if (!$accessToken || !$projectId) {
            Log::warning('FCM: Tidak bisa mengirim push — credentials belum dikonfigurasi.');
            return false;
        }

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ])->post($url, [
                'message' => [
                    'token' => $fcmToken,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                    ],
                    'android' => [
                        'priority' => 'high',
                        'notification' => [
                            'sound'            => 'default',
                            'channel_id'       => 'high_importance_channel',
                            'default_vibrate_timings' => true,
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                Log::info("FCM: Push notification berhasil dikirim ke token: " . substr($fcmToken, 0, 20) . '...');
                return true;
            }

            // Jika token tidak valid, hapus dari database
            if ($response->status() === 404 || $response->status() === 400) {
                $errorBody = $response->json();
                $errorCode = $errorBody['error']['details'][0]['errorCode'] ?? '';
                if (in_array($errorCode, ['UNREGISTERED', 'INVALID_ARGUMENT'])) {
                    Log::info("FCM: Token tidak valid, menghapus dari database.");
                    User::where('fcm_token', $fcmToken)->update(['fcm_token' => null]);
                }
            }

            Log::warning('FCM: Gagal mengirim push notification', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

        } catch (\Throwable $e) {
            Log::error('FCM: Error saat mengirim push: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Base64 URL-safe encoding (untuk JWT)
     */
    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
