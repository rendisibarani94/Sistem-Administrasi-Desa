<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * - Buat email nullable agar register tanpa email bisa berjalan
     * - Tambah kolom nik jika belum ada
     * - Perbaiki enum role agar mendukung 'masyarakat' dan 'kepala_desa'
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Buat email nullable
            $table->string('email')->nullable()->change();

            // 2. Tambah kolom nik jika belum ada
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik', 16)->nullable()->unique()->after('email');
            }
        });

        // 3. Perbaiki enum role: tambahkan 'masyarakat' dan 'kepala_desa'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','masyarakat','kepala_desa') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();

            if (Schema::hasColumn('users', 'nik')) {
                $table->dropColumn('nik');
            }
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin') NULL");
    }
};
