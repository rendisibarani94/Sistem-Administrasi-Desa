<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'user_id',
        'judul',
        'jenis',
        'isi',
        'foto',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
