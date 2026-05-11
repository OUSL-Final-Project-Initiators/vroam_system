<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserhomepageController;

Route::get('/', [UserhomepageController::class, 'index'])->name('user.index');
Route::get('/vehicles/category/{category}', [UserhomepageController::class, 'category'])->name('user.category');
Route::get('/vehicles/{id}', [UserhomepageController::class, 'show'])->name('user.show');
Route::get('/vehicles/{id}/book', [UserhomepageController::class, 'bookingForm'])->name('user.booking.form');
Route::post('/vehicles/{id}/book', [UserhomepageController::class, 'bookingStore'])->name('user.booking.store');
