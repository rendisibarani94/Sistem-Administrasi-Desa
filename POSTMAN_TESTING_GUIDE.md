# 📮 PANDUAN TESTING API dengan POSTMAN

## 1️⃣ **SETUP POSTMAN**

### Download & Install
- Download di: https://www.postman.com/downloads/
- Install dan buka aplikasi

### Buat Collection Baru
1. Klik **Collections** di sidebar kiri
2. Klik **+ Create a collection**
3. Beri nama: **"Sistem Administrasi Desa"**
4. Klik **Create**

### Buat Environment Variable
1. Klik **Environments** (atas kiri, di sebelah Collections)
2. Klik **Create New Environment**
3. Beri nama: **"Local Development"**
4. Tambahkan variables:
   ```
   base_url      = http://192.168.1.8:8000
   api_url       = http://192.168.1.8:8000/api
   token         = (kosong dulu, akan diisi setelah login)
   ```
5. Klik **Save**
6. Di dropdown (kanan atas), pilih environment **"Local Development"**

---

## 2️⃣ **TEST 1: Test Koneksi API**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/test
Headers: (none)
Body:    (none)
```

### Langkah di Postman:
1. Klik **+ Tab** untuk request baru
2. Dropdown ubah ke **GET**
3. Paste: `{{api_url}}/test`
4. Klik **Send**

### Expected Response (Status 200):
```json
{
  "message": "API berjalan"
}
```

✅ **Jika berhasil**, API connected!

---

## 3️⃣ **TEST 2: Register User Baru**

### Request Details:
```
Method:  POST
URL:     {{api_url}}/register
Headers: Content-Type: application/json
Body:    JSON raw
```

### Body JSON:
```json
{
  "name": "Budi Santoso",
  "nik": "1234567890123456",
  "email": "budi@desa.local",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "masyarakat"
}
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **POST**
3. URL: `{{api_url}}/register`
4. Tab **Headers**, pastikan ada:
   ```
   Key: Content-Type
   Value: application/json
   ```
5. Tab **Body** → **raw** → **JSON**
6. Paste JSON di atas
7. Klik **Send**

### Expected Response (Status 200 atau 201):
```json
{
  "status": "success",
  "message": "User berhasil didaftarkan",
  "user": {
    "id": 3,
    "name": "Budi Santoso",
    "email": "budi@desa.local",
    "role": "masyarakat",
    ...
  }
}
```

⚠️ **Catatan:** Ganti `nik` dan `email` dengan yang belum terdaftar!

---

## 4️⃣ **TEST 3: Login**

### Request Details:
```
Method:  POST
URL:     {{api_url}}/login
Headers: Content-Type: application/json
Body:    JSON raw
```

### Body JSON:
```json
{
  "email": "budi@desa.local",
  "password": "password123"
}
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **POST**
3. URL: `{{api_url}}/login`
4. **Headers**: Content-Type = application/json
5. **Body** → **raw** → **JSON**:
```json
{
  "email": "budi@desa.local",
  "password": "password123"
}
```
6. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "1|abcdefghijklmnopqrstuvwxyz...",
  "user": {
    "id": 3,
    "name": "Budi Santoso",
    "email": "budi@desa.local",
    "role": "masyarakat"
  }
}
```

### 🔑 **PENTING - COPY TOKEN:**
1. Copy seluruh nilai **token** dari response
2. Ke **Environments** → **Local Development**
3. Ubah variable **token** dengan token yang di-copy
4. Klik **Save**

---

## 5️⃣ **TEST 4: Get User Info (Protected Route)**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/me
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **GET**
3. URL: `{{api_url}}/me`
4. Tab **Headers**, tambah:
   ```
   Key: Authorization
   Value: Bearer {{token}}
   ```
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "user": {
    "id": 3,
    "name": "Budi Santoso",
    "email": "budi@desa.local",
    "role": "masyarakat",
    ...
  }
}
```

✅ **Token working!**

---

## 6️⃣ **TEST 5: Get Jenis Surat (Masyarakat)**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/jenis-surat
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **GET**
3. URL: `{{api_url}}/jenis-surat`
4. **Headers**: Authorization = Bearer {{token}}
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "data": [
    {
      "id_jenis_surat": 1,
      "nama_surat": "Surat Keterangan Domisili",
      "deskripsi": "...",
      "created_at": "2026-05-14T10:00:00.000000Z"
    },
    {
      "id_jenis_surat": 2,
      "nama_surat": "Surat Pengantar",
      "deskripsi": "...",
      "created_at": "2026-05-14T10:00:00.000000Z"
    }
  ]
}
```

Catat **id_jenis_surat** untuk test selanjutnya!

---

## 7️⃣ **TEST 6: Buat Request Surat Baru (Masyarakat)**

### Request Details:
```
Method:  POST
URL:     {{api_url}}/surat
Headers: Authorization: Bearer {{token}}
         Content-Type: application/json
Body:    JSON raw
```

### Body JSON:
```json
{
  "id_jenis_surat": 1,
  "data_form": {
    "keperluan": "Lamaran kerja",
    "instansi_tujuan": "PT ABC Indonesia",
    "keterangan": "Untuk melamar posisi sebagai Software Developer"
  }
}
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **POST**
3. URL: `{{api_url}}/surat`
4. **Headers**:
   ```
   Authorization: Bearer {{token}}
   Content-Type: application/json
   ```
5. **Body** → **raw** → **JSON**:
```json
{
  "id_jenis_surat": 1,
  "data_form": {
    "keperluan": "Lamaran kerja",
    "instansi_tujuan": "PT ABC Indonesia",
    "keterangan": "Untuk melamar posisi sebagai Software Developer"
  }
}
```
6. Klik **Send**

### Expected Response (Status 201):
```json
{
  "status": "success",
  "message": "Surat berhasil dibuat",
  "data": {
    "id_pengajuan_surat": 5,
    "id_jenis_surat": 1,
    "id_penduduk": 2,
    "status": "diajukan",
    "data_form": {
      "keperluan": "Lamaran kerja",
      "instansi_tujuan": "PT ABC Indonesia",
      "keterangan": "Untuk melamar posisi sebagai Software Developer"
    },
    "created_at": "2026-05-14T10:30:00.000000Z"
  }
}
```

Catat **id_pengajuan_surat** untuk test selanjutnya!

---

## 8️⃣ **TEST 7: Get Surat User (Masyarakat)**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/surat
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **GET**
3. URL: `{{api_url}}/surat`
4. **Headers**: Authorization = Bearer {{token}}
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "data": [
    {
      "id_pengajuan_surat": 5,
      "id_jenis_surat": 1,
      "jenis_surat": {
        "id_jenis_surat": 1,
        "nama_surat": "Surat Keterangan Domisili"
      },
      "status": "diajukan",
      "data_form": {...},
      "created_at": "2026-05-14T10:30:00.000000Z"
    }
  ]
}
```

---

## 9️⃣ **TEST 8: Get Detail Surat**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/surat/5
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

**Catatan:** Ganti `5` dengan `id_pengajuan_surat` dari test sebelumnya!

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **GET**
3. URL: `{{api_url}}/surat/5`
4. **Headers**: Authorization = Bearer {{token}}
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "data": {
    "id_pengajuan_surat": 5,
    "id_jenis_surat": 1,
    "id_penduduk": 2,
    "status": "diajukan",
    "data_form": {...},
    "jenis_surat": {...},
    "penduduk": {...},
    "created_at": "2026-05-14T10:30:00.000000Z"
  }
}
```

---

## 🔟 **TEST 9: Kirim Pengaduan**

### Request Details:
```
Method:  POST
URL:     {{api_url}}/pengaduan
Headers: Authorization: Bearer {{token}}
         Content-Type: application/json
Body:    JSON raw
```

### Body JSON:
```json
{
  "judul": "Jalan Rusak di Desa",
  "isi": "Jalan di depan rumah saya sudah rusak parah dan membahayakan keselamatan. Mohon segera diperbaiki."
}
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **POST**
3. URL: `{{api_url}}/pengaduan`
4. **Headers**:
   ```
   Authorization: Bearer {{token}}
   Content-Type: application/json
   ```
5. **Body** → **raw** → **JSON**
6. Klik **Send**

### Expected Response (Status 201):
```json
{
  "status": "success",
  "message": "Pengaduan berhasil dikirim",
  "data": {
    "id": 1,
    "user_id": 3,
    "judul": "Jalan Rusak di Desa",
    "isi": "Jalan di depan rumah saya sudah rusak parah...",
    "status": "diterima",
    "created_at": "2026-05-14T10:35:00.000000Z"
  }
}
```

---

## 1️⃣1️⃣ **TEST 10: Get Pengaduan User**

### Request Details:
```
Method:  GET
URL:     {{api_url}}/pengaduan
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **GET**
3. URL: `{{api_url}}/pengaduan`
4. **Headers**: Authorization = Bearer {{token}}
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "user_id": 3,
      "judul": "Jalan Rusak di Desa",
      "isi": "Jalan di depan rumah saya sudah rusak parah...",
      "status": "diterima",
      "created_at": "2026-05-14T10:35:00.000000Z"
    }
  ]
}
```

---

## 1️⃣2️⃣ **TEST 11: Logout**

### Request Details:
```
Method:  POST
URL:     {{api_url}}/logout
Headers: Authorization: Bearer {{token}}
Body:    (none)
```

### Langkah di Postman:
1. **+ Tab** baru
2. Dropdown: **POST**
3. URL: `{{api_url}}/logout`
4. **Headers**: Authorization = Bearer {{token}}
5. Klik **Send**

### Expected Response (Status 200):
```json
{
  "status": "success",
  "message": "Logout berhasil"
}
```

---

## 📊 **RINGKASAN TESTING MASYARAKAT**

| No | Endpoint | Method | Auth | Desc |
|----|----------|--------|------|------|
| 1 | `/test` | GET | ❌ | Test koneksi |
| 2 | `/register` | POST | ❌ | Daftar akun |
| 3 | `/login` | POST | ❌ | Login |
| 4 | `/me` | GET | ✅ | Info user |
| 5 | `/jenis-surat` | GET | ✅ | List jenis surat |
| 6 | `/surat` | POST | ✅ | Buat surat |
| 7 | `/surat` | GET | ✅ | List surat user |
| 8 | `/surat/{id}` | GET | ✅ | Detail surat |
| 9 | `/pengaduan` | POST | ✅ | Buat pengaduan |
| 10 | `/pengaduan` | GET | ✅ | List pengaduan |
| 11 | `/logout` | POST | ✅ | Logout |

---

## ⚠️ **TROUBLESHOOTING**

### ❌ Error: "Invalid credentials"
- **Solusi:** Email/password salah, pastikan terdaftar di `/register` dulu

### ❌ Error: "Unauthenticated"
- **Solusi:** Token tidak ada di header atau sudah expired
- Pastikan header: `Authorization: Bearer {{token}}`

### ❌ Error: "CORS error" atau "origin not allowed"
- **Solusi:** CORS middleware sudah aktif, error ini tidak seharusnya muncul

### ❌ Error: "Connection refused"
- **Solusi:** 
  - Server Laravel tidak running, jalankan: `php artisan serve --host=0.0.0.0`
  - IP/port salah, pastikan: `http://192.168.1.8:8000`

### ❌ Variable {{token}} tidak terisi
- **Solusi:**
  1. Login dulu, copy token dari response
  2. Pergi ke **Environments** → **Local Development**
  3. Edit variable **token** dengan value yang di-copy
  4. Klik **Save**
  5. Pastikan environment **"Local Development"** dipilih (dropdown kanan atas)

---

## 💡 **TIPS POSTMAN**

### 1. Gunakan Pre-request Script (Otomatis ambil token)
Di tab **Pre-request Script**, paste:
```javascript
// Jika token sudah ada, jangan request ulang
if (!pm.environment.get("token")) {
  // Token akan diisi manual saja
}
```

### 2. Set Timeout
Jika respon lambat, settings → **Request Timeout** → set ke **10000** (10 detik)

### 3. Export Collection
Untuk share dengan team:
- Klik **Collections** → menu titik tiga → **Export**
- Kirim file `.json` ke team
- Import di postman mereka

### 4. View Pretty Response
Response akan auto-pretty jika header `Content-Type: application/json`

---

## 🎯 **WORKFLOW LENGKAP**

```
1. Register (jika belum punya akun) → /register
2. Login → /login (dapat token)
3. Simpan token di Environment
4. Coba akses /me (verifikasi token)
5. Get jenis surat → /jenis-surat
6. Buat surat baru → POST /surat
7. List surat → GET /surat
8. Detail surat → GET /surat/{id}
9. Kirim pengaduan → POST /pengaduan
10. Logout → /logout
```

---

**SELAMAT TESTING! 🚀**

Jika ada error, check Postman **Console** (View → Show Postman Console) untuk detail error!
