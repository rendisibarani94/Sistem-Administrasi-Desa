<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersyaratanSurat extends Model
{
    protected $table = 'persyaratan_surat';

    protected $fillable = [
        'jenis_surat_id',
        'nama_field',
        'tipe_field',
        'is_required'
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    /**
     * Get the letter type that owns this requirement.
     * Relation: Belongs To (PersyaratanSurat -> JenisSurat)
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id', 'id_jenis_surat');
    }

    /**
     * Get the submitted detail values for this requirement field.
     * Relation: One to Many (PersyaratanSurat -> DetailPengajuanSurat)
     */
    public function detailPengajuanSurat()
    {
        return $this->hasMany(DetailPengajuanSurat::class, 'persyaratan_id');
    }
}
