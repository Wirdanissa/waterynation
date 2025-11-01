<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('force.verified')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
    Route::get('/dashboard', [LandingController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
