<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom id_penduduk jika belum ada
            if (!Schema::hasColumn('users', 'id_penduduk')) {
                $table->unsignedBigInteger('id_penduduk')
                    ->nullable()
                    ->after('id');
                
                // Buat foreign key
                $table->foreign('id_penduduk')
                    ->references('id_penduduk')
                    ->on('penduduk')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'id_penduduk')) {
                $table->dropForeign(['id_penduduk']);
                $table->dropColumn('id_penduduk');
            }
        });
    }
};
