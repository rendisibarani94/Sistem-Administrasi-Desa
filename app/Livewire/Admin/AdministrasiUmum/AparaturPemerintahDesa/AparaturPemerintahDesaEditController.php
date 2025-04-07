<?php

namespace App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class AparaturPemerintahDesaEditController extends Component
{

    public $id_aparatur;

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Nama Lengkap Terlalu Panjang!')]
    public $nama_lengkap;

    #[Rule(
        ['required_without:nip', 'nullable', 'size:18'],
        message: [
            'required_without' => 'Mohon isi salah satu field: NIP atau NIPD.',
            'size' => 'Input NIPD harus 18 digit!'
        ]
    )]
    public $nipd;

    #[Rule(
        ['required_without:nipd', 'nullable', 'size:18'],
        message: [
            'required_without' => 'Mohon isi salah satu field: NIP atau NIPD.',
            'size' => 'Input NIP harus 18 digit!'
        ]
    )]
    public $nip;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi')]
    #[Rule('max:255', message: 'Input Tempat Lahir Terlalu Panjang')]
    public $tempat_lahir;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Agama Harus Diisi')]
    public $agama;

    #[Rule('required', message: 'Kolom Golongan Harus Diisi')]
    public $golongan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $jabatan;

    #[Rule('required', message: 'Kolom Jabatan Harus Diisi')]
    public $pendidikan;

    #[Rule('required', message: 'Kolom Tanggal Pengangkatan Harus Diisi')]
    public $tanggal_pengangkatan;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang')]
    public $keterangan;

    public function mount($id_aparatur_desa){
        $this->id_aparatur = $id_aparatur_desa;
        $this->loadEditData();
    }

    public function loadEditData(){
        $kkd = DB::table('aparatur_desa')->where('id_aparatur', $this->id_aparatur)->first();

        $this->nama_lengkap = $kkd->nama_lengkap;
        $this->nipd = $kkd->nipd;
        $this->nip = $kkd->nip;
        $this->jenis_kelamin = $kkd->jenis_kelamin;
        $this->tempat_lahir = $kkd->tempat_lahir;
        $this->tanggal_lahir = $kkd->tanggal_lahir;
        $this->agama = $kkd->agama;
        $this->golongan = $kkd->golongan;
        $this->jabatan = $kkd->jabatan;
        $this->pendidikan = $kkd->pendidikan;
        $this->tanggal_pengangkatan = $kkd->tanggal_pengangkatan;
        $this->keterangan = $kkd->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        // $data = [
        //     'tanggal_keputusan' => $this->tanggal_keputusan,
        //     'tentang' => $this->tentang,
        //     'uraian' => $this->uraian,
        //     'tanggal_dilaporkan' => $this->tanggal_dilaporkan,
        //     'keterangan' => $this->keterangan,
        //     'updated_at' => now()
        // ];

        DB::table('aparatur_desa')->where('id_aparatur', $this->id_aparatur)->update($validated);

        return redirect()->route('AparaturDesa')->with('success', 'Data Aparatur Desa Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.edit',
            [
                'jabatanData' => DB::table('jabatan')
                    ->where('is_deleted', 0)
                    ->orderBy('id_jabatan', 'desc')
                    ->get()
            ]
        );
    }
}