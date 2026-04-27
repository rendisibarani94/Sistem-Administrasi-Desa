<?php

namespace App\Models;

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
        'role'
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

    public function isMasyarakat()
    {
        return $this->role === 'masyarakat';
    }

    public function isKades()
    {
        return $this->role === 'kades';
    }
}