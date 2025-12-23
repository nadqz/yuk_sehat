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
        // Bungkus SEMUA modifikasi ke dalam pengecekan ini
        if (Schema::hasTable('health_logs')) {
            Schema::table('health_logs', function (Blueprint $table) {
                // Cek dulu apakah kolom 'bmi' sudah ada atau belum sebelum ditambah
                if (!Schema::hasColumn('health_logs', 'bmi')) {
                    $table->decimal('bmi', 8, 2)->nullable()->after('weight');
                }
                
                $table->decimal('weight', 5, 2)->nullable()->change();
                $table->decimal('bmi_score', 5, 2)->nullable();
            });
        }
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
