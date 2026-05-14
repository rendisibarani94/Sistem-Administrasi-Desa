<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pengaduan')) {
            Schema::create('pengaduan', function (Blueprint $table) {
                $table->id('id_pengaduan');
                $table->unsignedBigInteger('user_id');
                $table->string('judul');
                $table->text('isi');
                $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
                $table->text('catatan_admin')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengaduan')) {
            Schema::dropIfExists('pengaduan');
        }
    }
};
