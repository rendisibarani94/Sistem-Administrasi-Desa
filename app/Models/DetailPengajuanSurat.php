<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuanSurat extends Model
{
    protected $table = 'detail_pengajuan_surat';

    protected $fillable = [
        'pengajuan_id',
        'persyaratan_id',
        'value'
    ];

    /**
     * Get the application that owns this detail value.
     * Relation: Belongs To (DetailPengajuanSurat -> PengajuanSurat)
     */
    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class, 'pengajuan_id', 'id_pengajuan_surat');
    }

    /**
     * Get the requirement field associated with this detail value.
     * Relation: Belongs To (DetailPengajuanSurat -> PersyaratanSurat)
     */
    public function persyaratanSurat()
    {
        return $this->belongsTo(PersyaratanSurat::class, 'persyaratan_id');
    }
}
