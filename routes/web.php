<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ClassifyCow;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Guest routes
Route::get('/', fn() => view('auth.login'));

// Test routes
Route::get('/test-bcs', [TestController::class, 'predictAllBCS']);

// Authenticated web routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Pages
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list', [ListController::class, 'index'])->name('list');
    Route::get('/list/detail/{cow}', [DetailController::class, 'showByCow'])->name('detail');

    // BCS Actions
    Route::post('/bcs/classify', [ClassifyCow::class, 'classifyBCS'])->name('bcs.classify');
    
    // Chart Data API (internal - dipanggil dari Blade)
    Route::get('/bcs-chart-data', [ClassifyCow::class, 'chartData'])->name('bcs.chartData');
    Route::get('/bcs-chart-data/{cow}', [DetailController::class, 'chartData']);
    
    // Detail controller
    Route::put('/body-condition-score/{bcs}/notes',[DetailController::class, 'update'])->name('bcs.notes.update');

    // Data options
    Route::patch('/bcs/{id}/attention', [DashboardController::class, 'updateAttention']);

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
