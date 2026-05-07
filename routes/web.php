<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserhomepageController;  // ← ADD THIS

Route::get('/', [UserhomepageController::class, 'index'])->name('user.index');
