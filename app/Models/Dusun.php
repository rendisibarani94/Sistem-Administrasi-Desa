<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    // =========================
    // TABLE & PRIMARY KEY
    // =========================
    protected $table = 'dusun';
    protected $primaryKey = 'id_dusun';

    // =========================
    // FILLABLE FIELDS
    // =========================
    protected $fillable = [
        'dusun',
        'is_deleted',
    ];

    // =========================
    // CAST TYPES
    // =========================
    protected function casts(): array
    {
        return [
            'is_deleted' => 'boolean',
        ];
    }

    // =========================
    // RELATIONSHIP: PENDUDUK
    // =========================
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'dusun', 'id_dusun');
    }

    // =========================
    // SCOPE: ACTIVE RECORDS
    // =========================
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }
}
