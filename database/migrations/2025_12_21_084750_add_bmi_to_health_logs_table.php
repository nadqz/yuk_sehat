<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom.
     */
    public function up()
    {
        Schema::table('health_logs', function (Blueprint $table) {
            // decimal(5,2) artinya maksimal 3 digit di depan koma dan 2 digit di belakang (Contoh: 125.50)
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('bmi_score', 5, 2)->nullable();
        });
    }

    /**
     * Batalkan migrasi (Hapus kolom jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('health_logs', function (Blueprint $table) {
            // Penting: Hapus kolom saat rollback agar database kembali bersih
            $table->dropColumn(['weight', 'bmi_score']);
        });
    }
};