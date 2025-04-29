<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukMutasiController extends Component
{
    #[Rule('required', message: 'Kolom Tanggal Pengurangan Harus Diisi!')]
    public $tanggal_pengurangan;

    #[Rule(
        ['required_without:tempat_meninggal', 'nullable', 'max:255'],
        message: [
            'required_without' => 'Mohon isi salah satu field: Tujuan Pindah atau Tempat Meninggal',
            'max' => 'Input Tujuan Pindah Maksimal 255 Karakter!'
        ]
    )]
    public $tujuan_pindah;

    #[Rule(
        ['required_without:tujuan_pindah', 'nullable', 'max:255'],
        message: [
            'required_without' => 'Mohon isi salah satu field: Tujuan Pindah atau Tempat Meninggal',
            'max' => 'Input Tempat Menninggal Maksimal 255 Karakter!'
        ]
    )]
    public $tempat_meninggal;

    #[Rule('max:255', message: 'Input Keterangan Terlalu Panjang!')]
    public $keterangan;

    public $pindahId;

    public function mount($id)
    {
        $this->pindahId = $id;
    }

    public function pindah()
    {
        $validated = $this->validate();
        $validated['updated_at'] = now();
        $validated['is_mutated'] = 1;

        DB::table('penduduk')->where('id_penduduk', $this->pindahId)->update($validated);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    }

    #[Layout('Components.layouts.layouts')]
    public function render()
    {
        $pendudukData = DB::table('penduduk')
            ->join('pekerjaan', 'penduduk.pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->select('penduduk.*', 'pekerjaan.pekerjaan', 'kartu_keluarga.nomor_kartu_keluarga') // Select required fields
            ->where('penduduk.id_penduduk', $this->pindahId)
            ->first();

        return view('admin.kependudukan.induk-penduduk.mutasi', ['pendudukData' => $pendudukData]);
    }
}
