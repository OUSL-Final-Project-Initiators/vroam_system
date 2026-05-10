<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserhomepageController;  // ← ADD THIS

Route::get('/', [UserhomepageController::class, 'index'])->name('user.index');
Route::get('/vehicles/category/{category}', [UserhomepageController::class, 'category'])->name('user.category');
Route::get('/vehicles/{id}', [UserhomepageController::class, 'show'])->name('user.show');
