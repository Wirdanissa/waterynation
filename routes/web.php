<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ProgramsRegistrasiController;
use App\Http\Controllers\PublikasiController;
use Illuminate\Support\Facades\Route;

Route::middleware('force.verified')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    Route::get('/profile', [LandingController::class, 'profile'])->name('profile');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
    Route::get('/admin/dashboard', [LandingController::class, 'admin'])->name('admin.dashboard');
    // Programs
    Route::resource('/admin/programs', ProgramsController::class)->names('admin.program');
    // ProgramsRegistrasi
    Route::resource('/admin/programs-registrasi', ProgramsRegistrasiController::class)->names('admin.program-registrasi');
    // Publikasi
    Route::resource('/admin/publikasi', PublikasiController::class)->names('admin.publikasi');
    // Users
    Route::get('/admin/users', [LandingController::class, 'adminUser'])->name('admin.user.index');
    Route::delete('/admin/users/{id}', [LandingController::class, 'adminDeleteUser'])->name('admin.user.delete');
    Route::get('/admin/users/{id}/edit', [LandingController::class, 'adminEditUser'])->name('admin.user.edit');
});

Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
