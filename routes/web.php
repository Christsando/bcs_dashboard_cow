<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // direct langsung ke login page --> skip welcome page
    return view('auth.login');
    // return view('welcome');
});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/list', function () {return view('list.list');})->middleware(['auth', 'verified'])->name('list');

Route::get('/list/detail', function () {return view('detail.detail');})->middleware(['auth', 'verified'])->name('detail');
// diakhir tambah ini {$tag_id_sapi}

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
