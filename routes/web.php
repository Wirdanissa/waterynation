<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use Illuminate\Support\Facades\Route;

Route::middleware('force.verified')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
    Route::get('/admin/dashboard', [LandingController::class, 'admin'])->name('admin.dashboard');
    // Programs
    Route::resource('/admin/programs', ProgramsController::class)->names('admin.program');
    // Users
    Route::get('/admin/users', [LandingController::class, 'adminUser'])->name('admin.user.index');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
