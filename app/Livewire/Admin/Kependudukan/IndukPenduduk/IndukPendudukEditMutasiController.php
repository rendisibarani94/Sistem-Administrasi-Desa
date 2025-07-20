<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukEditMutasiController extends Component
{
    #[Rule('required', message: 'Kolom Tanggal Pengurangan Harus Diisi!')]
    public $tanggal_pengurangan;

    #[Rule(
        ['required_without:tempat_meninggal', 'nullable', 'max:255'],
        message: [
            'required_without' => 'Mohon isi salah satu field: Tujuan Pindah atau Tempat Meninggal',
            'max' => 'Input Tujuan Pindah Maksimal 255 digit karakter!'
        ]
    )]
    public $tujuan_pindah;

    #[Rule(
        ['required_without:tujuan_pindah', 'nullable', 'max:255'],
        message: [
            'required_without' => 'Mohon isi salah satu field: Tujuan Pindah atau Tempat Meninggal',
            'max' => 'Input Tempat Menninggal Maksimal 255 digit karakter!'
        ]
    )]
    public $tempat_meninggal;

    #[Rule('max:255', message: 'Input Keterangan Maksimal 255 digit karakter!')]
    public $keterangan;

    public $id_penduduk;

    public function mount($id)
    {
        $this->id_penduduk = $id;
        $this->loadPendudukMutasi();
    }

    public function loadPendudukMutasi()
    {
        $penduduk = DB::table('penduduk')->where('id_penduduk', $this->id_penduduk)->first();

        if (!$penduduk) {
            return redirect()->route('indukPenduduk.pindah')->with('error', 'Penduduk tidak ditemukan!');
        }
        // Fill properties with data from database
        $this->tanggal_pengurangan = $penduduk->tanggal_pengurangan;
        $this->tujuan_pindah = $penduduk->tujuan_pindah;
        $this->tempat_meninggal = $penduduk->tempat_meninggal;
        $this->keterangan = $penduduk->keterangan;
    }

    public function update()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();

        DB::table('penduduk')->where('id_penduduk', $this->id_penduduk)->update($validated);

        return redirect()->route('indukPenduduk.pindah')->with('success', 'Data Penduduk Pindah Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $pendudukData = DB::table('penduduk')
            ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga') // Select required fields
            ->where('penduduk.id_penduduk', $this->id_penduduk)
            ->first();

        return view('admin.kependudukan.induk-penduduk.edit-mutasi', ['pendudukData' => $pendudukData]);
    }
}
