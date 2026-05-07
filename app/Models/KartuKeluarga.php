<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    // =========================
    // TABLE & PRIMARY KEY
    // =========================
    protected $table = 'kartu_keluarga';
    protected $primaryKey = 'id_kartu_keluarga';

    // =========================
    // FILLABLE FIELDS
    // =========================
    protected $fillable = [
        'nomor_kartu_keluarga',
        'tanggal_keluar',
        'alamat_kk',
        'rt',
        'rw',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'kode_pos',
        'provinsi',
        'is_deleted',
    ];

    // =========================
    // CAST TYPES
    // =========================
    protected function casts(): array
    {
        return [
            'tanggal_keluar' => 'date',
            'is_deleted' => 'boolean',
        ];
    }

    // =========================
    // RELATIONSHIP: PENDUDUK
    // =========================
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_kartu_keluarga', 'id_kartu_keluarga');
    }

    // =========================
    // SCOPE: ACTIVE RECORDS
    // =========================
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }
}
