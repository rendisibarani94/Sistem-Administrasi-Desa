<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id('id_pengajuan_surat');

            $table->unsignedBigInteger('id_penduduk');
            $table->unsignedBigInteger('id_jenis_surat');

            $table->json('data_form');

            $table->enum('status', [
                'diajukan',
                'diverifikasi_admin',
                'ditolak_admin',
                'disetujui_kades',
                'ditolak_kades',
                'selesai'
            ])->default('diajukan');

            $table->text('alasan_tolak')->nullable();

            $table->unsignedBigInteger('id_diproses_oleh')->nullable();
            $table->timestamp('tanggal_respons')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // RELASI
            $table->foreign('id_penduduk')
                  ->references('id_penduduk')
                  ->on('penduduk')
                  ->onDelete('cascade');

            $table->foreign('id_jenis_surat')
                  ->references('id_jenis_surat')
                  ->on('jenis_surat')
                  ->onDelete('cascade');

            $table->foreign('id_diproses_oleh')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->index('status');
            $table->index('id_penduduk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};