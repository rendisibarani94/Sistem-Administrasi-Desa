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
        'tanggal_respons'
    ];

    protected $casts = [
        'data_form' => 'array',
        'tanggal_respons' => 'datetime'
    ];

    // 🔥 STATUS CONST (WAJIB)
    const DIAJUKAN = 'DIAJUKAN';
    const DIVERIFIKASI_ADMIN = 'DIVERIFIKASI_ADMIN';
    const DITOLAK_ADMIN = 'DITOLAK_ADMIN';
    const DISETUJUI_KADES = 'DISETUJUI_KADES';
    const DITOLAK_KADES = 'DITOLAK_KADES';
    const SELESAI = 'SELESAI';

    // RELASI
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }

    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'id_diproses_oleh');
    }
}