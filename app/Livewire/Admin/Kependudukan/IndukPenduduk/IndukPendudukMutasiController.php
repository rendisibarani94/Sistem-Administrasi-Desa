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

    public $isLoneHead;

    public $pendudukPindahIdKk;

    public function mount($id)
    {
    $this->pendudukPindahIdKk = DB::table('penduduk')->where('id_penduduk', $id)->value('id_kartu_keluarga');

        $this->pindahId = $id;

    // 1. Check if he is a non-deleted Head
    $isHead = DB::table('penduduk')
        ->where('id_penduduk', $id)
        ->where('is_deleted', 0)
        ->where('kedudukan_keluarga', 'KEPALA KELUARGA')
        ->exists();

    // 2. Check if he is the only one in his family
    $isOnlyMember = DB::table('penduduk')
        ->where('id_kartu_keluarga', $this->pendudukPindahIdKk) // Get this from the first query if needed
        ->where('is_deleted', 0)
        ->count() == 1; // Only 1 member left?

    $this->isLoneHead = $isHead && $isOnlyMember;
    }

    public function pindah()
    {
        if ($this->isLoneHead){
        // If he is a lone head, we need to delete the kartu keluarga
        $validated = $this->validate();
        $validated['updated_at'] = now();
        $validated['is_mutated'] = 1;
        $validated['is_deleted'] = 1;

        // Error
        DB::table('penduduk')->where('id_penduduk', $this->pindahId)->update($validated);

        DB::table('kartu_keluarga')
            ->where('id_kartu_keluarga', $this->pendudukPindahIdKk)
            ->update([
                'is_deleted' => 1,
                'updated_at' => now() // Optional: update timestamp if needed
            ]);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    } else {
        // If not a lone head, just update the pindah data
        $validated = $this->validate();
        $validated['updated_at'] = now();
        $validated['is_mutated'] = 1;

        DB::table('penduduk')->where('id_penduduk', $this->pindahId)->update($validated);

        return redirect()->route('indukPenduduk')->with('success', 'Data Induk Penduduk Berhasil Diubah');
    }
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        $pendudukData = DB::table('penduduk')
            ->join('kartu_keluarga', 'penduduk.id_kartu_keluarga', '=', 'kartu_keluarga.id_kartu_keluarga')
            ->select('penduduk.*', 'kartu_keluarga.nomor_kartu_keluarga') // Select required fields
            ->where('penduduk.id_penduduk', $this->pindahId)
            ->first();

        return view('admin.kependudukan.induk-penduduk.mutasi', ['pendudukData' => $pendudukData]);
    }
}
