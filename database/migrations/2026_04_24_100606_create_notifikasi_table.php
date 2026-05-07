<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('notifikasi')) {
            Schema::create('notifikasi', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('judul')->nullable();
                $table->text('pesan')->nullable();
                $table->boolean('is_read')->default(false);

                $table->timestamps();

                // optional relasi ke users (lebih baik ditambahkan)
                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('notifikasi')) {
            Schema::dropIfExists('notifikasi');
        }
    }
};