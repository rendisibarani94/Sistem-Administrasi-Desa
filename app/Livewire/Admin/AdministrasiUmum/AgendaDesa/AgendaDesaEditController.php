<?php

namespace App\Livewire\Admin\AdministrasiUmum\AgendaDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Livewire\Component;

class AgendaDesaEditController extends Component
{

    use WithFileUploads;


    public $id_agenda_surat;
    public $jenis_surat = 'Surat Keluar';
    public $tanggal_pengiriman_penerimaan;
    public $tanggal_surat;
    public $kode_surat;
    public $tujuan_penerima;
    public $isi_singkat;
    public $keterangan;
    // public $bukti_diterima;

    public function mount($id_agenda_surat){
        $this->id_agenda_surat = $id_agenda_surat;
        $this->loadEditData();
    }

    protected function rules()
    {
        $rules = [
            'jenis_surat' => 'required|in:Surat Keluar,Surat Ekspedisi,Surat Masuk',
            'tanggal_pengiriman_penerimaan' => 'required|date',
            'tanggal_surat' => 'required|date',
            'kode_surat' => 'required|string|max:10',
            'tujuan_penerima' => 'required|string|max:150',
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
        'tujuan_penerima.required' => 'Tujuan penerima surat harus diisi',
        'isi_singkat.required' => 'Isi singkat surat harus diisi',
    ];

    public function loadEditData(){
        $sk = DB::table('id_agenda_surat')->where('id_agenda_surat', $this->id_agenda_surat)->first();

         $this->jenis_surat = $sk->jenis_surat;
         $this->tanggal_pengiriman_penerimaan = $sk->tanggal_pengiriman_penerimaan;
         $this->tanggal_surat = $sk->tanggal_surat;
         $this->kode_surat = $sk->kode_surat;
         $this->tujuan_penerima = $sk->tujuan_penerima;
         $this->isi_singkat = $sk->isi_singkat;
         $this->keterangan = $sk->keterangan;
    }


    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('agenda_surat')->where('id_agenda_surat', $this->id_agenda_surat)->update($validated);

        // Proper reset
        $this->reset();
        $this->jenis_surat = 'Surat Masuk';

        return redirect()->route('AgendaDesa')->with('success', 'Data Agenda Surat berhasil diubah!');
    }



    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view('admin.umum.agenda-surat.edit');
    }
}
