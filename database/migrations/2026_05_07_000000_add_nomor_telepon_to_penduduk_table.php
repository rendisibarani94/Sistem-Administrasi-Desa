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
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('nomor_telepon', 15)->nullable();
        });

        Schema::table('penduduk_sementara', function (Blueprint $table) {
            $table->string('nomor_telepon', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            if (Schema::hasColumn('penduduk', 'nomor_telepon')) {
                $table->dropColumn('nomor_telepon');
            }
        });

        Schema::table('penduduk_sementara', function (Blueprint $table) {
            if (Schema::hasColumn('penduduk_sementara', 'nomor_telepon')) {
                $table->dropColumn('nomor_telepon');
            }
        });
    }
};
