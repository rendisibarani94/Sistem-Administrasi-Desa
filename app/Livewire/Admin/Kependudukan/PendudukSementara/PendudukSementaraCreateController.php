<?php

namespace App\Livewire\Admin\Kependudukan\PendudukSementara;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class PendudukSementaraCreateController extends Component
{
    #[Rule('required', message: 'Kolom Nama Lengkap Harus Diisi!')]
    #[Rule('max:100', message: 'Input Nama Lengkap maksimal 100 digit karakter')]
    public $nama_lengkap;

    #[Rule('required', message: 'Kolom Jenis Kelamin Harus Diisi!')]
    public $jenis_kelamin;

    #[Rule('required', message: 'Kolom Nomor Pengenal Harus Diisi!')]
    #[Rule('max:50', message: 'Input Nomor Pengenal maksimal 50 digit karakter')]
    #[Rule('unique:penduduk_sementara,nomor_pengenal', message: 'Nomor Pengenal sudah digunakan!')]
    public $nomor_pengenal;

    #[Rule('required', message: 'Kolom Tempat Lahir Harus Diisi!')]
    #[Rule('max:150', message: 'Input Tempat Lahir maksumal 150 digit karakter!')]
    public $tempat_lahir;

    #[Rule('required', message: 'Kolom Tanggal Lahir Harus Diisi!')]
    public $tanggal_lahir;

    #[Rule('required', message: 'Kolom Pekerjaan Harus Diisi!')]
    #[Rule('max:100', message: 'Input Pekerjaan Maksimal 100 Karakter')]
    public $pekerjaan;

    #[Rule('required', message: 'Kolom Kewarganegaraan Harus Diisi!')]
    public $kewarganegaraan;

    #[Rule('required', message: 'Kolom Keturunan Harus Diisi!')]
    #[Rule('max:50', message: 'Input Keturunan maksimal 50 digit karakter!')]
    public $keturunan;

    #[Rule('required', message: 'Kolom Asal Kedatangan Harus Diisi!')]
    #[Rule('max:150', message: 'Input Asal Kedatangan maksimal 150 digit karakter')]
    public $asal;

    #[Rule('required', message: 'Kolom Maksud Kedatangan Harus Diisi!')]
    #[Rule('max:255', message: 'Input Maksud Kedatangan maksimal 255 digit karakter')]
    public $maksud_kedatangan;

    #[Rule('required', message: 'Kolom Tokoh Tujuan Harus Diisi!')]
    #[Rule('max:100', message: 'Input Tokoh Tujuan maksimal 100 digit karakter')]
    public $tokoh_tujuan;

    #[Rule('required', message: 'Kolom Alamat Tujuan Harus Diisi!')]
    #[Rule('max:150', message: 'Input Alamat Tujuan maksimal 150 digit karakter')]
    public $alamat_tujuan;

    #[Rule('required', message: 'Kolom Tanggal Kedatangan Harus Diisi!')]
    public $tanggal_kedatangan;

    #[Rule('required', message: 'Kolom Tanggal Kepulangan Harus Diisi!')]
    public $tanggal_kepulangan;

    #[Rule('required', message: 'Kolom Keterangan Harus Diisi!')]
    #[Rule('max:255', message: 'Input Keterangan maksimal 255 digit karakter')]
    public $keterangan;

    public function store(){
        $validated = $this->validate();

        DB::table('penduduk_sementara')->insert($validated);

        $this->reset([
            'nama_lengkap',
            'jenis_kelamin',
            'nomor_pengenal',
            'tempat_lahir',
            'tanggal_lahir',
            'pekerjaan',
            'kewarganegaraan',
            'keturunan',
            'asal',
            'maksud_kedatangan',
            'tokoh_tujuan',
            'alamat_tujuan',
            'tanggal_kedatangan',
            'tanggal_kepulangan',
            'keterangan'
        ]);

        return redirect()->route('pendudukSementara')->with('success', 'Data penduduk sementara berhasil disimpan!');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view(
            'admin.kependudukan.penduduk-sementara.create'
        );
    }
}
