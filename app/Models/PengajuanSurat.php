<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanSurat extends Model
{
    use SoftDeletes;

    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id_pengajuan_surat';

    protected $fillable = [
        'id_penduduk',
        'id_jenis_surat',
        'data_form',
        'status',
        'alasan_tolak',
        'id_diproses_oleh',
        'tanggal_respons',
        'tanggal_selesai',
        'nomor_surat',
        'file_pdf',
        // Support new EAV dynamic fields
        'user_id',
        'jenis_surat_id'
    ];

    protected $casts = [
        'data_form' => 'array',
        'tanggal_respons' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    // Status Constants (compatibility)
    const DIAJUKAN = 'diajukan';
    const PENDING = 'diajukan'; // Map pending to diajukan
    const DIPROSES = 'diproses';
    const DITOLAK = 'ditolak';
    const SELESAI = 'selesai';

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!isset($model->attributes['data_form'])) {
                $model->attributes['data_form'] = json_encode([]);
            }
        });
    }

    // Accessor/Mutator for user_id to map to id_penduduk
    public function getUserIdAttribute()
    {
        return $this->attributes['id_penduduk'] ?? null;
    }

    public function setUserIdAttribute($value)
    {
        // Try to find the user with this ID and get their id_penduduk
        $user = User::find($value);
        if ($user && $user->id_penduduk) {
            $this->attributes['id_penduduk'] = $user->id_penduduk;
        } else {
            $this->attributes['id_penduduk'] = $value;
        }
    }

    // Accessor/Mutator for jenis_surat_id to map to id_jenis_surat
    public function getJenisSuratIdAttribute()
    {
        return $this->attributes['id_jenis_surat'] ?? null;
    }

    public function setJenisSuratIdAttribute($value)
    {
        $this->attributes['id_jenis_surat'] = $value;
    }

    // Status Constants
    // Semua nilai sesuai dengan nilai di database: 'diajukan', 'diproses', 'selesai', 'ditolak'
    // Tidak ada mapping/accessor status agar konsisten antara admin web dan API mobile

    /**
     * Get the user who submitted this letter application.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_penduduk', 'id_penduduk');
    }

    /**
     * Get the letter type associated with this application.
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat', 'id_jenis_surat');
    }

    /**
     * Get the resident who submitted this.
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }

    /**
     * Get the user who processed this.
     */
    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'id_diproses_oleh');
    }

    /**
     * Get the detail fields/values submitted for this application.
     * Relation: One to Many (PengajuanSurat -> DetailPengajuanSurat)
     */
    public function detailPengajuanSurat()
    {
        return $this->hasMany(DetailPengajuanSurat::class, 'pengajuan_id', 'id_pengajuan_surat');
    }
}