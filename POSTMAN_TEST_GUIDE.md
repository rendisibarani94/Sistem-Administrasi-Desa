# Panduan Testing Postman - Sistem Administrasi Desa
Base URL: https://desahutabulumejan.id
Koleksi: Sistem-Administrasi-Desa.postman_collection.json

---

## Setup Awal

Import file koleksi ke Postman. Variabel sudah terkonfigurasi:

| Variable     | Value                           | Keterangan                          |
|---|---|---|
| base_url     | https://desahutabulumejan.id    | Domain produksi                     |
| api_url      | {{base_url}}/api                | Prefix semua endpoint               |
| token        | (terisi otomatis saat login)    | Token masyarakat                    |
| token_admin  | (terisi otomatis saat login)    | Token admin                         |

---

## Urutan Test (Happy Path)

1.  GET  /api/test                   - Pastikan server aktif
2.  POST /api/register               - Daftar akun masyarakat baru
3.  POST /api/login                  - Login > token tersimpan otomatis ke {{token}}
4.  GET  /api/me                     - Verifikasi token valid
5.  GET  /api/dynamic/jenis-surat    - Lihat jenis surat tersedia
6.  GET  /api/dynamic/persyaratan/1  - Lihat field form (ganti 1 sesuai ID)
7.  POST /api/dynamic/pengajuan      - Submit surat (wajib form-data!)
8.  POST /api/pengaduan              - Kirim pengaduan (wajib form-data!)
9.  GET  /api/surat                  - Cek riwayat surat
10. GET  /api/pengaduan              - Cek riwayat pengaduan
11. GET  /api/my-kk                  - Lihat data Kartu Keluarga
12. POST /api/logout                 - Akhiri sesi

---

## 1. Autentikasi & Akun

### 1.1 Register User Baru
Method: POST | URL: {{api_url}}/register | Auth: tidak perlu

Body (raw JSON):
{
  "no_kk": "1234567890112233",
  "nama_kepala_keluarga": "Budi Santoso",
  "password": "password123",
  "password_confirmation": "password123"
}

PENTING: no_kk dan nama_kepala_keluarga harus cocok persis dengan data di database desa.

Respons sukses (201):
{ "status": "success", "message": "Akun berhasil dibuat.", "data": { "token": "..." } }

### 1.2 Login Masyarakat
Method: POST | URL: {{api_url}}/login

Body (raw JSON):
{ "nik": "1234567890123456", "password": "password123" }

Catatan: Bisa pakai field nik, no_kk, atau noKk.
Token otomatis tersimpan ke {{token}} via test script.

### 1.3 Login Admin
Method: POST | URL: {{api_url}}/admin/login

Body (raw JSON):
{ "email": "desadigital@gmail.com", "password": "password123" }

Token otomatis tersimpan ke {{token_admin}} via test script.

### 1.4 Get Profil Saya (/me)
Method: GET | URL: {{api_url}}/me | Auth: Bearer {{token}}

### 1.5 Update Profil
Method: PUT | URL: {{api_url}}/profile/update | Auth: Bearer {{token}}

Body (raw JSON):
{
  "nama": "Budi Santoso Update",
  "alamat": "Jl. Kenanga No. 5 RT 01 RW 02, Desa Hutabulumejan",
  "tempat_lahir": "Balige",
  "tanggal_lahir": "1995-08-17",
  "no_kk": "1234567890112233"
}

### 1.6 Update FCM Token (Push Notification)
Method: POST | URL: {{api_url}}/fcm-token | Auth: Bearer {{token}}
Body: { "fcm_token": "fcm_device_token_contoh_abc123xyz789" }

### 1.7 Logout
Method: POST | URL: {{api_url}}/logout | Auth: Bearer {{token}}

---

## 2. Pengajuan Surat (Form Statis)

### 2.1 Get Jenis Surat
Method: GET | URL: {{api_url}}/jenis-surat | Auth: Bearer {{token}}

### 2.2 Buat Pengajuan Surat
Method: POST | URL: {{api_url}}/surat | Auth: Bearer {{token}}

Body (raw JSON):
{
  "id_jenis_surat": 1,
  "data_form": {
    "keperluan": "Mengajukan beasiswa KIP Kuliah",
    "penghasilan_ortu": "1500000",
    "pekerjaan_ayah": "Petani",
    "jumlah_tanggungan": "3"
  }
}

### 2.3 Riwayat Surat        GET  {{api_url}}/surat | Auth: Bearer {{token}}
### 2.4 Detail Surat         GET  {{api_url}}/surat/1 | Auth: Bearer {{token}}
### 2.5 Download PDF Surat   GET  {{api_url}}/surat/1/download | Auth: Bearer {{token}}
  Tips: klik Send > Save Response > Save to file untuk simpan PDF.
### 2.6 View Surat (browser) GET  {{api_url}}/surat/1/view?token={{token}}

---

## 3. Pengajuan Surat Dinamis / EAV (dipakai Flutter)

### 3.1 Get Jenis Surat Dinamis
Method: GET | URL: {{api_url}}/dynamic/jenis-surat | Auth: Bearer {{token}}

### 3.2 Get Field Persyaratan
Method: GET | URL: {{api_url}}/dynamic/persyaratan/1 | Auth: Bearer {{token}}
Ganti 1 dengan ID jenis surat dari endpoint 3.1.

Contoh respons:
{ "status": "success", "data": [
  { "id": 1, "nama_field": "Keperluan Surat", "tipe_field": "text", "required": true },
  { "id": 2, "nama_field": "Foto KTP", "tipe_field": "file_image", "required": false }
]}

### 3.3 Submit Pengajuan Dinamis - WAJIB FORM-DATA (bukan raw JSON!)
Method: POST | URL: {{api_url}}/dynamic/pengajuan | Auth: Bearer {{token}}

Body (form-data):
| Key              | Value                             | Type |
|---|---|---|
| jenis_surat_id   | 1                                 | Text |
| answers[1]       | Melamar pekerjaan sebagai guru    | Text |
| answers[2]       | 1234567890123456                  | Text |
| answers[3]       | (pilih file gambar JPG/PNG)       | File |

PENTING: Key answers[N] sesuaikan dengan id field dari endpoint 3.2.
Untuk tipe_field = file_image: ubah Type kolom menjadi File di Postman.

---

## 4. Pengaduan Masyarakat

### 4.1 Kirim Pengaduan - WAJIB FORM-DATA
Method: POST | URL: {{api_url}}/pengaduan | Auth: Bearer {{token}}

Body (form-data):
| Key    | Value                                | Type | Wajib |
|---|---|---|---|
| judul  | Jalan Berlubang di RT 01            | Text | Ya    |
| isi    | Jalan berlubang membahayakan warga  | Text | Ya    |
| jenis  | Infrastruktur                        | Text | Ya    |
| foto   | (pilih gambar JPG/PNG)              | File | Tidak |

Nilai jenis valid: Infrastruktur, Sosial, Keamanan, Pelayanan, Lainnya

### 4.2 Lihat Pengaduan   GET  {{api_url}}/pengaduan | Auth: Bearer {{token}}
### 4.3 Detail Pengaduan  GET  {{api_url}}/pengaduan/1 | Auth: Bearer {{token}}

---

## 5. Kartu Keluarga & Penduduk

| No  | Method | URL                      | Auth              |
|---|---|---|---|
| 5.1 | GET    | {{api_url}}/my-kk        | Bearer {{token}}  |
| 5.2 | GET    | {{api_url}}/penduduk     | Bearer {{token}}  |
| 5.3 | GET    | {{api_url}}/penduduk/1   | Bearer {{token}}  |

---

## 6. Informasi Publik (Tanpa Token)

| No  | Method | URL                       | Keterangan          |
|---|---|---|---|
| 6.1 | GET    | {{api_url}}/test          | Cek server aktif    |
| 6.2 | GET    | {{api_url}}/berita        | Berita desa terbaru |
| 6.3 | GET    | {{api_url}}/pengumuman    | Pengumuman desa     |
| 6.4 | GET    | {{api_url}}/settings      | Profil & kontak     |

---

## 7. Notifikasi

| No  | Method | URL                              | Auth              |
|---|---|---|---|
| 7.1 | GET    | {{api_url}}/notifikasi           | Bearer {{token}}  |
| 7.2 | PATCH  | {{api_url}}/notifikasi/1/read    | Bearer {{token}}  |

---

## 8. Admin - Kelola Pengguna (token_admin)

| No  | Method | URL                  | Keterangan     |
|---|---|---|---|
| 8.1 | GET    | {{api_url}}/users    | Semua pengguna |
| 8.2 | POST   | {{api_url}}/users    | Tambah         |
| 8.3 | PUT    | {{api_url}}/users/1  | Update         |
| 8.4 | DELETE | {{api_url}}/users/1  | Hapus          |

Body tambah pengguna (8.2):
{
  "name": "Siti Aminah",
  "nik": "9876543210123456",
  "email": "siti.aminah@desa.local",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "masyarakat"
}

---

## 9. Admin - Kelola Surat (token_admin)

| No  | Method | URL                                   | Keterangan            |
|---|---|---|---|
| 9.1 | POST   | {{api_url}}/surat/{id}/approve-admin  | Setujui Kepala Desa   |
| 9.2 | POST   | {{api_url}}/surat/{id}/reject-admin   | Tolak Kepala Desa     |
| 9.3 | POST   | {{api_url}}/surat/{id}/approve        | Setujui Staff         |
| 9.4 | POST   | {{api_url}}/surat/{id}/reject         | Tolak Staff           |

---

## 10. Admin - Kelola Pengaduan (token_admin)

| No   | Method | URL                                        | Keterangan          |
|---|---|---|---|
| 10.1 | GET    | {{api_url}}/admin/pengaduan                | Semua pengaduan     |
| 10.2 | GET    | {{api_url}}/admin/pengaduan/1              | Detail pengaduan    |
| 10.3 | PATCH  | {{api_url}}/admin/pengaduan/1/status       | Update status       |
| 10.4 | DELETE | {{api_url}}/admin/pengaduan/1              | Hapus pengaduan     |

Body Update Status (10.3):
{
  "status": "diproses",
  "tanggapan": "Kami akan segera meninjau dan memperbaiki dalam 3 hari kerja."
}
Nilai status valid: menunggu, diproses, selesai, ditolak

---

## 11. Admin - Kartu Keluarga (token_admin)

| No   | Method | URL                               | Keterangan    |
|---|---|---|---|
| 11.1 | GET    | {{api_url}}/kartu-keluarga        | Semua KK      |
| 11.2 | GET    | {{api_url}}/kartu-keluarga/1      | Detail KK     |
| 11.3 | POST   | {{api_url}}/kartu-keluarga        | Tambah KK     |

---

## Skenario Test Negatif

| Skenario                              | Endpoint              | Perlakuan                    | Expected         |
|---|---|---|---|
| Token salah                           | GET /api/me           | Bearer tokenpalsu            | 401 Unauthorized |
| Tanpa token                           | GET /api/surat        | Hapus Authorization header   | 401 Unauthorized |
| Token masyarakat di endpoint admin    | GET /api/users        | Gunakan {{token}}            | 403 Forbidden    |
| KK tidak terdaftar                    | POST /api/register    | no_kk tidak ada di DB        | 422 / 404        |
| Password tidak cocok                  | POST /api/register    | password_confirmation beda   | 422 Unprocessable|
| ID tidak ditemukan                    | GET /api/surat/99999  | ID tidak ada                 | 404 Not Found    |
| Field wajib kosong                    | POST /api/pengaduan   | Kirim tanpa judul            | 422 Unprocessable|
| File terlalu besar                    | POST /dynamic/pengajuan | Upload >2MB               | 413 / 422        |

---

## Tips Penting

1. Register hanya berhasil jika no_kk + nama_kepala_keluarga cocok persis dengan data desa.
2. Login bisa pakai field nik, no_kk, atau noKk.
3. Setelah login berhasil, token otomatis tersimpan ke {{token}} via test script.
4. Endpoint /dynamic/pengajuan WAJIB gunakan form-data, bukan raw JSON.
5. Untuk upload foto pengaduan: ubah Type field foto menjadi File di Postman.
6. URL view surat bisa dibuka browser: https://desahutabulumejan.id/api/surat/{id}/view?token=TOKEN
7. Jika dapat 401 padahal sudah login, cek variabel {{token}} di Collections Variables Postman.
