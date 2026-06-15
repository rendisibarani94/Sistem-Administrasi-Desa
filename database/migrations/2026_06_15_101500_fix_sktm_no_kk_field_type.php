<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\JenisSurat;
use App\Models\PersyaratanSurat;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $jenisSurat = JenisSurat::where('nama_surat', 'Surat Keterangan Tidak Mampu')->first();
        if ($jenisSurat) {
            // Find Nomor KK field
            $kkField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where(function ($query) {
                    $query->where('nama_field', 'like', '%kk%')
                          ->orWhere('nama_field', 'like', '%kartu keluarga%');
                })->first();

            if ($kkField) {
                $kkField->update(['tipe_field' => 'number']);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $jenisSurat = JenisSurat::where('nama_surat', 'Surat Keterangan Tidak Mampu')->first();
        if ($jenisSurat) {
            $kkField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where(function ($query) {
                    $query->where('nama_field', 'like', '%kk%')
                          ->orWhere('nama_field', 'like', '%kartu keluarga%');
                })->first();

            if ($kkField) {
                $kkField->update(['tipe_field' => 'text']);
            }
        }
    }
};
