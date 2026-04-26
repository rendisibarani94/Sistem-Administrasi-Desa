namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // 📌 LIST pengaduan milik user
    public function index()
    {
        $data = Pengaduan::where('user_id', Auth::id())->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // 📌 KIRIM pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengaduan berhasil dikirim',
            'data' => $pengaduan
        ]);
    }

    // 📌 DETAIL
    public function show($id)
    {
        $data = Pengaduan::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // 📌 VALIDASI ADMIN (proses)
    public function proses($id)
    {
        $data = Pengaduan::findOrFail($id);
        $data->update(['status' => 'diproses']);

        return response()->json([
            'message' => 'Pengaduan diproses'
        ]);
    }

    // 📌 SELESAI
    public function selesai($id)
    {
        $data = Pengaduan::findOrFail($id);
        $data->update(['status' => 'selesai']);

        return response()->json([
            'message' => 'Pengaduan selesai'
        ]);
    }

    // 📌 TOLAK
    public function tolak(Request $request, $id)
    {
        $data = Pengaduan::findOrFail($id);

        $data->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan
        ]);

        return response()->json([
            'message' => 'Pengaduan ditolak'
        ]);
    }
}