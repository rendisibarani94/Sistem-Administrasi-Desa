namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\User;

class PengajuanSurat extends Model
{
    use SoftDeletes;

    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id_pengajuan_surat';

    protected $keyType = 'int';
    public $incrementing = true;

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