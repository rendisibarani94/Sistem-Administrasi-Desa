<?php

namespace App\Livewire\Admin\AdministrasiUmum\AgendaSuratDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Livewire\Component;

class AgendaSuratDesaCreateController extends Component
{

    use WithFileUploads;

    public $jenis_surat;
    public $tanggal_pengiriman_penerimaan;
    public $tanggal_surat;
    public $kode_surat;
    public $pengirim_penerima;
    public $isi_singkat;
    public $keterangan;
    // public $bukti_diterima;

    protected function rules()
    {
        $rules = [
            'jenis_surat' => 'required|in:Surat Keluar,Surat Ekspedisi,Surat Masuk',
            'tanggal_pengiriman_penerimaan' => 'required|date',
            'tanggal_surat' => 'required|date',
            'kode_surat' => 'required|string|max:10',
            'pengirim_penerima' => 'required|string|max:150',
            'isi_singkat' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ];

        return $rules;
    }

    protected $messages = [
        'jenis_surat.required' => 'Jenis surat harus dipilih',
        'tanggal_pengiriman_penerimaan.required' => 'Tanggal pengiriman harus diisi',
        'tanggal_surat.required' => 'Tanggal surat harus diisi',
        'kode_surat.required' => 'Kode surat harus diisi',
        'pengirim_penerima.required' => 'Pengirim / Penerima surat harus diisi',
        'isi_singkat.required' => 'Isi singkat surat harus diisi',
    ];

    public function store()
    {
        $validated = $this->validate();

        // Handle file upload
        // if ($request->bukti_diterima) {
        //     $imageName = time() . '.' . $request->bukti_diterima->extension();
        //     $request->bukti_diterima->move(public_path('images/administrasi-umum/surat-keluar'), $imageName);
        //     $validated['bukti_diterima'] = $imageName;
        // }

        DB::table('agenda_surat')->insert($validated);

        // Proper reset
        $this->reset();
        $this->jenis_surat = 'Surat Keluar';

        return redirect()->route('AgendaDesa')->with('success', 'Data Surat Keluar berhasil disimpan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.agenda-surat.create');
    }
}
