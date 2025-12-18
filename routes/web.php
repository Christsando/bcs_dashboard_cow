<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DetailController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
});

// test data dummy
Route::get('/test-bcs', [TestController::class, 'predictAllBCS']);

// Dashboard
// Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// List
// Route::get('/list', function () {return view('list.list');})->middleware(['auth', 'verified'])->name('list');
Route::get('/list', [ListController::class, 'index'])->middleware(['auth', 'verified'])->name('list');

// Detail
Route::get('/list/detail/{cow}', [DetailController::class, 'showByCow'])->middleware(['auth', 'verified'])->name('detail');

// === BCS CHART API ===
Route::get('/bcs-chart-data', function () {
    $year = now()->year;

    // BAR CHART
    $monthly = DB::table('body_condition_score')
        ->selectRaw('MONTH(assessment_date) as month, AVG(bcs_score) as score')
        ->whereYear('assessment_date', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('score');

    // PIE CHART
    $distribution = DB::table('body_condition_score')
        ->selectRaw('bcs_score, COUNT(*) as total')
        ->groupBy('bcs_score')
        ->orderBy('bcs_score')
        ->pluck('total');

    return response()->json([
        'monthly_scores' => $monthly,
        'distribution' => $distribution,
    ]);
})->middleware(['auth', 'verified']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
