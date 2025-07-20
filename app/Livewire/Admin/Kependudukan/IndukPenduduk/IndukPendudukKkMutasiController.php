<?php

namespace App\Livewire\Admin\Kependudukan\IndukPenduduk;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Rule;

class IndukPendudukKkMutasiController extends Component
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

    #[Rule('required', message: 'Kolom Kepala Keluarga Baru Harus Diisi!')]
    public $newKepalaKeluarga;

    // first form step
    #[Rule('required', message: 'Kolom Nomor Kartu Keluarga Baru Harus Diisi!')]
    #[Rule('size:16', message: 'Input Nomor Kartu Keluarga Baru Harus 16 Karakter!')]
    public $newNomorKK;

    public $pendudukPindahId;
    public $pendudukPindahIdKk;

    public function mount($id)
    {
        $this->pendudukPindahId = $id;
        $this->pendudukPindahIdKk = DB::table('penduduk')->where('id_penduduk', $id)->value('id_kartu_keluarga');
    }

    public function pindah()
    {
        $this->validate();

        $dataPenduduk['updated_at'] = now();
        $dataPenduduk['tanggal_pengurangan'] = $this->tanggal_pengurangan;
        $dataPenduduk['tujuan_pindah'] = $this->tujuan_pindah;
        $dataPenduduk['tempat_meninggal'] = $this->tempat_meninggal;
        $dataPenduduk['keterangan'] = $this->keterangan;
        $dataPenduduk['is_mutated'] = 1;
        $dataPenduduk['id_kartu_keluarga'] = null;
        $dataPenduduk['is_deleted'] = 1;

        DB::table('penduduk')->where('id_penduduk', $this->pendudukPindahId)->update($dataPenduduk);

        $dataKk['nomor_kartu_keluarga'] = $this->newNomorKK;
        $dataKk['updated_at'] = now();

        DB::table('kartu_keluarga')->where('id_kartu_keluarga', $this->pendudukPindahIdKk)->update($dataKk);

        $dataNewKepalaKeluarga['kedudukan_keluarga'] = "KEPALA KELUARGA";
        $dataNewKepalaKeluarga['updated_at'] = now();

        DB::table('penduduk')->where('id_penduduk', $this->newKepalaKeluarga)->update($dataNewKepalaKeluarga);

        return redirect()->route('indukPenduduk')->with('success', 'Mutasi Induk Penduduk Berhasil Diubah');
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $pendudukData = DB::table('penduduk')
            ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga') // Select required fields
            ->where('penduduk.id_penduduk', $this->pendudukPindahId)
            ->first();

        $keluargaData = DB::table('penduduk')
            ->where('is_deleted', 0)
            ->where('is_mutated', 0)
            ->where('id_kartu_keluarga', $this->pendudukPindahIdKk)
            ->whereNot('kedudukan_keluarga', 'KEPALA KELUARGA')
            ->get();

        return view('admin.kependudukan.induk-penduduk.mutasi-kepala-keluarga', [
            'pendudukData' => $pendudukData,
            'keluargaData' => $keluargaData,
        ]);
    }
}
