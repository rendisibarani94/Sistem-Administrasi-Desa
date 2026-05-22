<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSurat extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_surat';
    protected $primaryKey = 'id_jenis_surat';

    protected $fillable = [
        'nama_surat',
        'deskripsi',
        'template_file',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessor/Mutator for backward compatibility if code uses deskripsi_surat
    public function getDeskripsiSuratAttribute()
    {
        return $this->attributes['deskripsi'] ?? null;
    }

    public function setDeskripsiSuratAttribute($value)
    {
        $this->attributes['deskripsi'] = $value;
    }

    /**
     * Get the requirements (dynamic fields) for this letter type.
     * Relation: One to Many (JenisSurat -> PersyaratanSurat)
     */
    public function persyaratanSurat()
    {
        return $this->hasMany(PersyaratanSurat::class, 'jenis_surat_id', 'id_jenis_surat');
    }

    /**
     * Get the submissions associated with this letter type.
     * Relation: One to Many (JenisSurat -> PengajuanSurat)
     */
    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'id_jenis_surat', 'id_jenis_surat');
    }
}