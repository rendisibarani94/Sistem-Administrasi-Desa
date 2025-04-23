<?php

namespace App\Livewire\Admin\AdministrasiUmum\AparaturPemerintahDesa;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;


class AparaturPemerintahDesaCreateController extends Component
{

    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:150', message: 'Kolom Nama Lengkap Harus Diisi!')]
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
    
    #[Rule('date', message: 'Format tanggal tidak valid')]
    public $tanggal_pemberhentian;
    

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang')]
    public $keterangan;

    public function store()
    {
        $validated = $this->validate();

        DB::table('aparatur_desa')->insert($validated);


        $this->reset([
            'nama_lengkap',
            'nip',
            'nipd',
            'jenis_kelamin',
            'agama',
            'tempat_lahir',
            'tanggal_lahir',
            'golongan',
            'jabatan',
            'pendidikan',
            'tanggal_pengangkatan',
            'keterangan'
        ]);

        return redirect()->route('AparaturDesa')->with('success', 'Data Aparatur Desa berhasil disimpan!');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.umum.aparatur-pemerintah-desa.create',
            [
                'jabatanData' => DB::table('jabatan')
                    ->where('is_deleted', 0)
                    ->orderBy('id_jabatan', 'desc')
                    ->get()
            ]
        );
    }
}
