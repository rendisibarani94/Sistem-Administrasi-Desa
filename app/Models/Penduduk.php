<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    // =========================
    // TABLE & PRIMARY KEY
    // =========================
    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';

    // =========================
    // FILLABLE FIELDS
    // =========================
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'id_kartu_keluarga',
        'tempat_lahir',
        'tanggal_lahir',
        'kewarganegaraan',
        'nomor_akta_lahir',
        'golongan_darah',
        'agama',
        'tanggal_keluar_ktp',
        'keturunan',
        'status_perkawinan',
        'pendidikan_terakhir',
        'pekerjaan',
        'baca_huruf',
        'kedudukan_keluarga',
        'dusun',
        'asal_penduduk',
        'nomor_telepon',
        'suku',
        'tanggal_penambahan',
        'tanggal_pengurangan',
        'tujuan_pindah',
        'tempat_meninggal',
        'keterangan',
        'is_mutated',
        'is_deleted',
        'id_pengelola',
    ];

    // =========================
    // CAST TYPES
    // =========================
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tanggal_keluar_ktp' => 'date',
            'tanggal_penambahan' => 'date',
            'tanggal_pengurangan' => 'date',
            'is_mutated' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    // =========================
    // RELATIONSHIP: KARTU KELUARGA
    // =========================
    public function kartuKeluarga()
    {
        return $this->belongsTo(\App\Models\KartuKeluarga::class, 'id_kartu_keluarga', 'id_kartu_keluarga');
    }

// =========================
    // RELATIONSHIP: DUSUN
    // =========================
    public function dusun()
    {
        return $this->belongsTo(\App\Models\Dusun::class, 'dusun', 'id_dusun');
    }

    // =========================
    // RELATIONSHIP: USER (Account)
    // =========================
    /**
     * Get the user account (auth data) linked via NIK
     */
    public function user()
    {
        return $this->hasOne(User::class, 'nik', 'nik');
    }

    // =========================
    // SCOPE: ACTIVE RECORDS
    // =========================
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0)->where('is_mutated', 0);
    }

    public function scopeAllRecords($query)
    {
        return $query->where('is_deleted', 0);
    }
}
