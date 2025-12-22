<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\HealthLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

Route::get('/', function () {
    return view('index'); 
});

Route::middleware(['auth'])->group(function () {
    
    // 1. DASHBOARD
    Route::get('/dashboard', function () {
        $logs = HealthLog::where('user_id', auth()->id())
                         ->orderBy('log_date', 'desc')
                         ->get();
        return view('dashboard', compact('logs'));
    })->name('dashboard');

    // 2. JOURNAL (Riwayat)
    Route::get('/journal', function () {
        $logs = HealthLog::where('user_id', auth()->id())
                         ->orderBy('log_date', 'desc')
                         ->get();
        return view('journal', compact('logs'));
    })->name('journal');

    // 3. EDIT DATA (Menampilkan form edit)
    Route::get('/journal/edit/{id}', function ($id) {
    $log = HealthLog::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    
    // Jika data ini adalah hasil kalkulasi BMI (punya skor BMI tapi tidak punya data langkah/steps)
    if ($log->bmi_score && !$log->steps) {
        return view('bmi_edit', compact('log'));
    }
    
    // Jika data ini adalah jurnal aktivitas harian
        return view('input_data_edit', compact('log'));
    })->name('input.data.edit');

    // 4. UPDATE DATA (Proses simpan perubahan)
    Route::put('/journal/update/{id}', function (Request $request, $id) {
        $log = HealthLog::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $log->update([
            // Data Aktivitas
            'steps'            => $request->steps,
            'exercise_minutes' => $request->exercise,
            'water_intake'     => $request->water,
            
            // Data Fisik (PENTING UNTUK EDIT BMI)
            'weight'           => $request->weight,    // Simpan berat baru
            'bmi_score'        => $request->bmi_score, // Simpan skor hasil kalkulasi ulang JS
            
            // Data Lainnya
            'mood'             => $request->mood,
            'stress_level'     => $request->stress,
            'focus_level'      => $request->focus,
            'gratitude_note'   => $request->gratitude,
            'sleep_time'       => $request->sleep_time,
            'wake_time'        => $request->wake_time,
            'sleep_quality'    => $request->sleep_quality,
            'log_date'         => $request->log_date,
        ]);

        return redirect()->route('journal')->with('success', 'Catatan berhasil diperbarui!');
    })->name('input.data.update');

    // 5. BMI, TIPS, INPUT DATA
    Route::get('/bmi', function () { return view('bmi'); })->name('bmi');
    Route::get('/tips', function () { return view('tips'); })->name('tips');
    Route::get('/input-data', function () { return view('input-data'); })->name('input.data');

    // 6. SIMPAN DATA BARU
    Route::post('/input-data', function (Request $request) {
        $data = $request->all();
        HealthLog::create([
            'user_id'          => auth()->id(),
            'steps'            => $data['steps'] ?? 0,
            'exercise_minutes' => $data['exercise'] ?? 0,
            'water_intake'     => $data['water'] ?? $data['water_intake'] ?? 0,
            'mood'             => $data['mood'] ?? 'neutral',
            'stress_level'     => $data['stress'] ?? $data['stress_level'] ?? 0,
            'focus_level'      => $data['focus'] ?? $data['focus_level'] ?? 0,
            'gratitude_note'   => $data['gratitude'] ?? $data['gratitude_note'] ?? null,
            'sleep_time'       => $data['sleep_time'] ?? null,
            'wake_time'        => $data['wake_time'] ?? null,
            'sleep_quality'    => $data['sleep_quality'] ?? null,
            'weight'           => $data['weight'] ?? null,
            'bmi_score'        => $data['bmi_score'] ?? null,
            'log_date'         => $data['log_date'] ?? Carbon::today(),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Success']);
        }
        return redirect()->route('journal')->with('success', 'Jurnal kesehatan berhasil disimpan!');
    })->name('input.data.store');

    // 7. HAPUS & BERSIHKAN
    Route::delete('/journal/{id}', function ($id) {
        HealthLog::where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'Catatan berhasil dihapus.');
    })->name('journal.destroy');

    Route::delete('/journal/clear/all', function () {
        HealthLog::where('user_id', auth()->id())->delete();
        return back()->with('success', 'Seluruh jurnal telah dibersihkan.');
    })->name('journal.clear');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';