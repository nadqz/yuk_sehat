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
        Schema::create('health_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Body (Fisik)
            $table->integer('steps')->nullable();
            $table->integer('exercise_minutes')->nullable();
            $table->integer('water_intake')->nullable();
            
            // Penambahan Kolom Baru (Agar sinkron dengan Form Input)
            // decimal(5,2) mendukung angka seperti 120.50
            $table->decimal('weight', 5, 2)->nullable(); 
            $table->decimal('bmi_score', 5, 2)->nullable();

            // Mind (Mental)
            $table->string('mood')->nullable();
            $table->integer('stress_level')->nullable();
            $table->integer('focus_level')->nullable();
            $table->text('gratitude_note')->nullable();

            // Rest (Istirahat)
            $table->time('sleep_time')->nullable();
            $table->time('wake_time')->nullable();
            $table->string('sleep_quality')->nullable();

            $table->date('log_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_logs');
    }
};
