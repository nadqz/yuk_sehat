<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthLog extends Model
{
    use HasFactory;

    // Fillable sudah benar, ini mengizinkan data masuk ke database
    protected $fillable = [
        'user_id', 
        'steps', 
        'exercise_minutes', 
        'water_intake', 
        'mood', 
        'stress_level', 
        'focus_level', 
        'gratitude_note', 
        'sleep_time', 
        'wake_time', 
        'sleep_quality', 
        'log_date',
        'weight', 
        'bmi_score'
    ];

    // Model biasanya digunakan untuk mendefinisikan hubungan (Relationship)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}