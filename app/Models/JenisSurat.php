namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PengajuanSurat;

class JenisSurat extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_surat';
    protected $primaryKey = 'id_jenis_surat';

    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'nama_surat',
        'deskripsi',
        'template_file'
    ];

    // RELASI
    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'id_jenis_surat');
    }
}