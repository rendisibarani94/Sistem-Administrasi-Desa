<?php
/**
 * API Testing untuk Mobile - Sistem Administrasi Desa
 * File ini untuk testing API dari mobile device
 */

// Konfigurasi
$baseUrl = 'http://192.168.1.8:8000/api'; // IP address komputer Anda
$token = ''; // Token akan diisi setelah login

echo "=== SISTEM ADMINISTRASI DESA - API TEST ===\n\n";

// Function untuk membuat HTTP request
function apiRequest($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headers[] = 'Content-Type: application/json';
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return ['response' => $response, 'http_code' => $httpCode];
}

// 1. Test koneksi API
echo "1. Testing API Connection...\n";
$result = apiRequest($baseUrl . '/test');
if ($result['http_code'] == 200) {
    echo "✅ API Connected: " . $result['response'] . "\n\n";
} else {
    echo "❌ API Connection Failed (HTTP {$result['http_code']})\n\n";
    exit;
}

// 2. Login sebagai masyarakat (ganti dengan data real)
echo "2. Testing Login...\n";
$loginData = [
    'email' => 'masyarakat@example.com', // Ganti dengan email real
    'password' => 'password123' // Ganti dengan password real
];

$result = apiRequest($baseUrl . '/login', 'POST', $loginData);
if ($result['http_code'] == 200) {
    $loginResponse = json_decode($result['response'], true);
    if (isset($loginResponse['token'])) {
        $token = $loginResponse['token'];
        echo "✅ Login Success! Token: " . substr($token, 0, 20) . "...\n\n";
    } else {
        echo "❌ Login Failed: Invalid response\n\n";
        exit;
    }
} else {
    echo "❌ Login Failed (HTTP {$result['http_code']}): " . $result['response'] . "\n\n";
    exit;
}

// Headers untuk request authenticated
$authHeaders = [
    'Authorization: Bearer ' . $token,
    'Accept: application/json'
];

// 3. Get user info
echo "3. Testing Get User Info...\n";
$result = apiRequest($baseUrl . '/me', 'GET', null, $authHeaders);
if ($result['http_code'] == 200) {
    echo "✅ User Info: " . $result['response'] . "\n\n";
} else {
    echo "❌ Get User Info Failed (HTTP {$result['http_code']}): " . $result['response'] . "\n\n";
}

// 4. Get jenis surat
echo "4. Testing Get Jenis Surat...\n";
$result = apiRequest($baseUrl . '/jenis-surat', 'GET', null, $authHeaders);
if ($result['http_code'] == 200) {
    echo "✅ Jenis Surat: " . $result['response'] . "\n\n";
} else {
    echo "❌ Get Jenis Surat Failed (HTTP {$result['http_code']}): " . $result['response'] . "\n\n";
}

// 5. Get surat user
echo "5. Testing Get Surat User...\n";
$result = apiRequest($baseUrl . '/surat', 'GET', null, $authHeaders);
if ($result['http_code'] == 200) {
    echo "✅ Surat User: " . $result['response'] . "\n\n";
} else {
    echo "❌ Get Surat User Failed (HTTP {$result['http_code']}): " . $result['response'] . "\n\n";
}

// 6. Create new surat (opsional - uncomment untuk test)
// echo "6. Testing Create Surat...\n";
// $suratData = [
//     'id_jenis_surat' => 1, // Ganti dengan ID jenis surat yang valid
//     'data_form' => [
//         'keperluan' => 'Lamaran kerja',
//         'keterangan' => 'Untuk melamar pekerjaan di perusahaan'
//     ]
// ];
//
// $result = apiRequest($baseUrl . '/surat', 'POST', $suratData, $authHeaders);
// if ($result['http_code'] == 201) {
//     echo "✅ Create Surat Success: " . $result['response'] . "\n\n";
// } else {
//     echo "❌ Create Surat Failed (HTTP {$result['http_code']}): " . $result['response'] . "\n\n";
// }

echo "=== TESTING SELESAI ===\n";
echo "\nUntuk testing dari mobile:\n";
echo "1. Pastikan HP dan komputer dalam jaringan WiFi yang sama\n";
echo "2. Ganti \$baseUrl dengan IP address komputer Anda\n";
echo "3. Gunakan aplikasi seperti Postman atau HTTP Request di mobile\n";
echo "4. Atau buat aplikasi mobile yang mengkonsumsi API ini\n\n";

echo "API Endpoints yang tersedia:\n";
echo "POST /api/login - Login\n";
echo "POST /api/register - Register\n";
echo "GET /api/me - Info user\n";
echo "GET /api/jenis-surat - List jenis surat\n";
echo "GET /api/surat - List surat user\n";
echo "POST /api/surat - Buat surat baru\n";
echo "GET /api/surat/{id} - Detail surat\n\n";
?>