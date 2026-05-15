# 📋 POSTMAN QUICK REFERENCE CARD

## 🚀 STEP-BY-STEP SETUP (5 MENIT)

### STEP 1: Buat Environment
```
Klik: Environments → Create New
Nama: Local Development
Variables:
  - base_url = http://192.168.1.8:8000
  - api_url  = http://192.168.1.8:8000/api
  - token    = (kosong, akan diisi nanti)
Save → Pilih Environment di dropdown
```

### STEP 2: Test Koneksi
```
Method:  GET
URL:     {{api_url}}/test
Send → Harusnya dapat: {"message":"API berjalan"}
```

### STEP 3: Register User
```
Method:  POST
URL:     {{api_url}}/register
Headers: Content-Type: application/json
Body:    {
  "name": "Budi Santoso",
  "nik": "1234567890123456",
  "email": "budi@desa.local",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "masyarakat"
}
Send → Copy token (jika ada) atau catat email/password
```

### STEP 4: Login
```
Method:  POST
URL:     {{api_url}}/login
Headers: Content-Type: application/json
Body:    {
  "email": "budi@desa.local",
  "password": "password123"
}
Send → COPY TOKEN dari response
```

### STEP 5: Simpan Token
```
Pergi ke: Environments → Local Development
Ubah: token = (paste token yang di-copy)
Save
```

### STEP 6: Test Protected Route
```
Method:  GET
URL:     {{api_url}}/me
Headers: Authorization: Bearer {{token}}
Send → Harusnya dapat user info
```

---

## 📝 TEMPLATE REQUEST (COPY-PASTE)

### Template 1: GET dengan Auth
```
Method:  GET
URL:     {{api_url}}/[endpoint]
Headers: 
  Authorization: Bearer {{token}}
Body:    (none)
```

### Template 2: POST dengan Body
```
Method:  POST
URL:     {{api_url}}/[endpoint]
Headers: 
  Authorization: Bearer {{token}}
  Content-Type: application/json
Body:    (JSON)
```

### Template 3: POST tanpa Auth (Login/Register)
```
Method:  POST
URL:     {{api_url}}/[endpoint]
Headers: 
  Content-Type: application/json
Body:    (JSON)
```

---

## 🎯 FLOW TEST: MASYARAKAT

```
1. GET  /test                    ✓ Cek koneksi
2. POST /register                ✓ Daftar
3. POST /login                   ✓ Login (dapat token)
4. GET  /me                      ✓ Info user
5. GET  /jenis-surat             ✓ Lihat jenis surat
6. POST /surat                   ✓ Buat request surat
7. GET  /surat                   ✓ Lihat surat user
8. GET  /surat/{id}              ✓ Lihat detail surat
9. POST /pengaduan               ✓ Kirim pengaduan
10. GET /pengaduan               ✓ Lihat pengaduan user
11. POST /logout                 ✓ Logout
```

---

## 🔑 HEADERS REFERENCE

### Public Endpoints (Login/Register):
```
Content-Type: application/json
```

### Protected Endpoints (Need Auth):
```
Authorization: Bearer {{token}}
Content-Type: application/json
```

---

## ✅ CHECKLIST TESTING

- [ ] Environment sudah dibuat
- [ ] Base URL benar: http://192.168.1.8:8000
- [ ] Test /test endpoint OK
- [ ] Register user berhasil
- [ ] Login dan dapat token
- [ ] Token disimpan di environment
- [ ] /me endpoint OK (test auth)
- [ ] Bisa akses /jenis-surat
- [ ] Bisa buat surat baru
- [ ] Bisa lihat list surat
- [ ] Bisa kirim pengaduan
- [ ] Logout berhasil

---

## 🆘 ERROR SOLUTIONS

| Error | Solusi |
|-------|--------|
| `Unauthenticated` | Tambah header: `Authorization: Bearer {{token}}` |
| `Invalid token` | Token expired, login ulang |
| `CORS error` | Sudah diatasi di server, coba refresh Postman |
| `Connection refused` | Jalankan: `php artisan serve --host=0.0.0.0` |
| `{{token}} undefined` | Simpan token di environment dulu |
| `NIK/Email sudah terdaftar` | Ganti dengan yang belum terdaftar |

---

## 📸 SAMPLE RESPONSES

### Success Login:
```json
{
  "status": "success",
  "message": "Login berhasil",
  "token": "1|xyzabc...",
  "user": {
    "id": 1,
    "name": "Budi",
    "email": "budi@desa.local",
    "role": "masyarakat"
  }
}
```

### Success Create Surat:
```json
{
  "status": "success",
  "message": "Surat berhasil dibuat",
  "data": {
    "id_pengajuan_surat": 5,
    "status": "diajukan",
    "created_at": "2026-05-14T10:30:00Z"
  }
}
```

### Error Response:
```json
{
  "status": "error",
  "message": "Email atau password salah"
}
```

---

## 💾 SAVE COLLECTION

Untuk dokumentasi & sharing:

1. Klik **Collections** → menu **···** 
2. **Export**
3. Format: **Collection v2.1**
4. File akan terdownload `.json`
5. Share dengan team

Team bisa import dengan: **File → Import → Pilih file**

---

## 🎓 TIPS & TRICKS

### 1. Duplicate Request
Klik request → **Duplicate** (copy request untuk modifikasi)

### 2. Rename Tab
Double-click tab untuk rename

### 3. Keyboard Shortcut
- `Ctrl + Enter` → Send request
- `Ctrl + S` → Save request

### 4. View Console
**View → Show Postman Console** (lihat raw request/response)

### 5. Pre-fill Dynamic Data
Gunakan **Pre-request Script** untuk generate random data

---

**READY TO TEST! 🚀**
