<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaDesa extends Model
{
    protected $table = 'kepala_desa';
    protected $primaryKey = 'id_kepala_desa';

    protected $fillable = [
        'nama',
        'nip',
        'file_ttd',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: hanya kepala desa aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * URL tanda tangan
     */
    public function getTtdUrlAttribute(): ?string
    {
        if (!$this->file_ttd) return null;
        if (file_exists(public_path($this->file_ttd))) {
            return asset($this->file_ttd);
        }
        return asset('storage/' . $this->file_ttd);
    }

    /**
     * Compatibility accessor for diprosesOleh->name
     */
    public function getNameAttribute(): string
    {
        return $this->nama;
    }
}
