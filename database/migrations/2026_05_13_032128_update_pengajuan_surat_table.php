<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {

            $table->foreignId('id_diproses_oleh')
                  ->nullable()
                  ->after('alasan_tolak');

            $table->timestamp('tanggal_selesai')
                  ->nullable()
                  ->after('tanggal_respons');
        });

        DB::statement("
            ALTER TABLE pengajuan_surat
            MODIFY status ENUM(
                'diajukan',
                'diproses',
                'ditolak',
                'selesai'
            ) DEFAULT 'diajukan'
        ");
    }

    public function down(): void
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {

            $table->dropColumn([
                'id_diproses_oleh',
                'tanggal_selesai'
            ]);
        });

        DB::statement("
            ALTER TABLE pengajuan_surat
            MODIFY status ENUM(
                'diajukan',
                'diproses',
                'ditolak',
                'selesai'
            ) DEFAULT 'diajukan'
        ");
    }
};