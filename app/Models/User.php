<?php

namespace App\Models;

use App\Models\Notifikasi;
use App\Models\Pengaduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // =========================
    // FILLABLE (UPDATED)
    // =========================
    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'role',
        'id_penduduk',
        'fcm_token',
    ];

    // =========================
    // HIDDEN
    // =========================
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // =========================
    // CASTS
    // =========================
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================
    // OPTIONAL: ROLE HELPER (GOOD PRACTICE)
    // =========================
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // =========================
    // RELATIONS
    // =========================
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'id_penduduk', 'id_penduduk');
    }

    public function pengajuanSuratDiproses()
    {
        return $this->hasMany(PengajuanSurat::class, 'id_diproses_oleh');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id');
    }

    public function isMasyarakat()
    {
        return $this->role === 'masyarakat';
    }

}