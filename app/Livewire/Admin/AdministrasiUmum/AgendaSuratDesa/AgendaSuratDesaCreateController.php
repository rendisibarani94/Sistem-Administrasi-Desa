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

    protected function rules()
    {
        $rules = [
            'jenis_surat' => 'required|in:Surat Keluar,Surat Ekspedisi,Surat Masuk',
            'tanggal_pengiriman_penerimaan' => 'required|date',
            'tanggal_surat' => 'required|date',
            'kode_surat' => 'required|string|max:25',
            'pengirim_penerima' => 'required|string|max:150',
            'isi_singkat' => 'required|string|max:150',
            'keterangan' => 'nullable|string|max:255',
        ];

        return $rules;
    }

    protected $messages = [
        'jenis_surat.required' => 'Jenis surat harus dipilih!',
        'tanggal_pengiriman_penerimaan.required' => 'Tanggal pengiriman harus diisi!',
        'tanggal_surat.required' => 'Tanggal surat harus diisi!',
        'kode_surat.required' => 'Kode surat harus diisi!',
        'kode_surat.max' => 'Kode surat maksimal berisi 25 digit karakter!',
        'kode_surat.required' => 'Kode surat harus diisi!',
        'pengirim_penerima.required' => 'Pengirim / Penerima surat harus diisi!',
        'pengirim_penerima.max' => 'Pengirim / Penerima maksimal 150 digit karakter!',
        'isi_singkat.required' => 'Isi singkat surat harus diisi!',
        'isi_singkat.max' => 'Isi singkat surat maksimal 150 digit karakter !',
        'keterangan.max' => 'Isi keterangan maksimal 255 digit karakter!',
    ];

    public function store()
    {
        $validated = $this->validate();

        DB::table('agenda_surat')->insert($validated);

        // Proper reset
        $this->reset();

        return redirect()->route('AgendaSuratDesa')->with('success', 'Data Agenda Surat berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.agenda-surat.create');
    }
}
