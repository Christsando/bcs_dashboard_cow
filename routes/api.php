<?php

use App\Http\Controllers\ClassifyCow;
use Illuminate\Support\Facades\Route;


// by image upload from frontend to FastAPI backend
Route::post('/predict-bcs', [ClassifyCow::class, 'classifyBCS']);