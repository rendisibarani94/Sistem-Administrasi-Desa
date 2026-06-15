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
            // Find NIK field
            $nikField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where(function ($query) {
                    $query->where('nama_field', 'like', '%nik%')
                          ->orWhere('nama_field', 'like', '%n.i.k%');
                })->first();

            // Find Nama field
            $namaField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where(function ($query) {
                    $query->where('nama_field', 'like', '%nama%')
                          ->where('nama_field', 'not like', '%ayah%')
                          ->where('nama_field', 'not like', '%ibu%');
                })->first();

            if ($nikField) {
                $nikField->update(['tipe_field' => 'number']);
            }

            if ($namaField) {
                $namaField->update(['tipe_field' => 'text']);
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
            $nikField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where('nama_field', 'like', '%nik%')->first();

            $namaField = PersyaratanSurat::where('jenis_surat_id', $jenisSurat->id_jenis_surat)
                ->where('nama_field', 'like', '%nama%')
                ->where('nama_field', 'not like', '%ayah%')
                ->where('nama_field', 'not like', '%ibu%')->first();

            if ($nikField) {
                $nikField->update(['tipe_field' => 'text']);
            }

            if ($namaField) {
                $namaField->update(['tipe_field' => 'number']);
            }
        }
    }
};
