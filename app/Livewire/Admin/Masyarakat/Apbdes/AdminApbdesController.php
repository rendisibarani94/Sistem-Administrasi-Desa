<?php

namespace App\Livewire\Admin\Masyarakat\Apbdes;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdminApbdesController extends Component
{
    public $deleteId;
    public $search;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data Apbdes ini akan dihapus.',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function delete()
    {
        DB::table('apbdes')
            ->where('id_apbdes', $this->deleteId)
            ->update(['is_deleted' => 1]);

        // Show success message
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Data Apbdes berhasil dihapus.',
        ]);
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        // Define base columns (without 'r_' prefix)
        $pendapatanColumns = [
            'hasil_usaha',
            'hasil_aset',
            'swadaya_partisipasi_gotong_royong',
            'pendapatan_asli_lain',
            'dana_desa',
            'bagian_pajak_daerah',
            'retribusi_daerah',
            'alokasi_dana_desa',
            'bantuan_keuangan_provinsi',
            'bantuan_keuangan_kabupaten',
            'penerimaan_kerja_sama',
            'bantuan_perusahaan_di_desa',
            'hibah_sumbangan_pihak_ketiga',
            'koreksi_kesalahan_belanja',
            'bunga_bank_desa',
            'pendapatan_lain_sah'
        ];

        $pembiayaanColumns = [
            'silpa_tahun_sebelumnya',
            'pencairan_dana_cadangan',
            'hasil_penjualan_kekayaan_desa',
            'pembentukan_dana_cadangan',
            'penyertaan_modal'
        ];

        $belanjaColumns = [
            'penyelenggaraan_pemerintahan',
            'pelaksanaan_pembangunan',
            'pembinaan_kemasyarakatan',
            'pemberdayaan_masyarakat',
            'penanggulangan_bencana_darurat_mendesak',
            'belanja_tak_terduga',
        ];

        // Build Pembiayaan COALESCE expressions for anggaran and realisasi
        $belanjaAnanggaranExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(belanja_desa.{$col}, 0)",
            $belanjaColumns
        ));

        $belanjaRealisasiExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(belanja_desa.r_{$col}, 0)",
            $belanjaColumns
        ));

        // Build Pembiayaan COALESCE expressions for anggaran and realisasi
        $pembiayaanAnanggaranExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(pembiayaan_desa.{$col}, 0)",
            $pembiayaanColumns
        ));

        $pembiayaanRealisasiExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(pembiayaan_desa.r_{$col}, 0)",
            $pembiayaanColumns
        ));

        // Build Pendapatan COALESCE expressions for anggaran and realisasi
        $pendapatAnanggaranExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(pendapatan_desa.{$col}, 0)",
            $pendapatanColumns
        ));

        $pendapatanRealisasiExpr = implode(' + ', array_map(
            fn($col) => "COALESCE(pendapatan_desa.r_{$col}, 0)",
            $pendapatanColumns
        ));

        // Build the query with join
$results = DB::table('apbdes')
    ->join('belanja_desa', 'apbdes.belanja_desa', '=', 'belanja_desa.id_belanja_desa')
    ->join('pendapatan_desa', 'apbdes.pendapatan_desa', '=', 'pendapatan_desa.id_pendapatan_desa')
    ->join('pembiayaan_desa', 'apbdes.pembiayaan_desa', '=', 'pembiayaan_desa.id_pembiayaan_desa')
    ->select([
        'apbdes.*',
        'belanja_desa.*',
        'pembiayaan_desa.*',
        'pendapatan_desa.*',
        DB::raw("({$belanjaAnanggaranExpr}) AS anggaranBelanja"),
        DB::raw("({$belanjaRealisasiExpr}) AS realisasiBelanja"),
        DB::raw("({$pembiayaanAnanggaranExpr}) AS anggaranPembiayaan"),
        DB::raw("({$pembiayaanRealisasiExpr}) AS realisasiPembiayaan"),
        DB::raw("({$pendapatAnanggaranExpr}) AS anggaranPendapatan"),
        DB::raw("({$pendapatanRealisasiExpr}) AS realisasiPendapatan")
    ])
    ->paginate(10);

        return view(
            'admin.masyarakat.apbdes.index',
            [
                'apbdesData' => $results,
            ]
        );
    }
}
