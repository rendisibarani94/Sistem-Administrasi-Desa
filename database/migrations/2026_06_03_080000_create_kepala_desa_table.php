<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kepala_desa', function (Blueprint $table) {
            $table->id('id_kepala_desa');
            $table->string('nama', 150);
            $table->string('nip', 50)->nullable();
            $table->string('file_ttd', 255)->nullable()->comment('Path gambar tanda tangan');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_desa');
    }
};
