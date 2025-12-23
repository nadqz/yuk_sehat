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
        if (Schema::hasTable('health_logs')) {
            Schema::table('health_logs', function (Blueprint $table) {
                // Tambahkan kolom hanya jika belum ada
                if (!Schema::hasColumn('health_logs', 'bmi')) {
                    $table->decimal('bmi', 8, 2)->nullable()->after('weight');
                }
                if (!Schema::hasColumn('health_logs', 'bmi_score')) {
                    $table->decimal('bmi_score', 5, 2)->nullable();
                }
                // Mengubah kolom weight yang sudah ada
                $table->decimal('weight', 5, 2)->nullable()->change();
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
