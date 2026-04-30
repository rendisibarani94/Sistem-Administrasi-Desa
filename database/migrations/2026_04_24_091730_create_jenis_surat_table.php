<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('jenis_surat', function (Blueprint $table) {
        $table->id('id_jenis_surat');

        $table->string('kode_surat')->unique(); 
        // SD, SKU, SKTM

        $table->string('nama_surat')->unique();

        $table->text('deskripsi')->nullable();

        $table->string('template_file')->nullable();

        $table->boolean('is_active')->default(true);

        $table->integer('urutan')->default(1);

        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_surat');
    }
};
