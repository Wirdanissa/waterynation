<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ProgramsRegistrasiController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\VolunterRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('force.verified')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    // Tentang
    Route::get('/profile', [LandingController::class, 'profile'])->name('profile');
    Route::get('/visi-misi', [LandingController::class, 'landingVisiMisi'])->name('visi-misi');
    Route::get('/tim', [LandingController::class, 'landingTim'])->name('tim');
    // Publikasi
    Route::get('/publikasi', [PublikasiController::class, 'userPublikasi'])->name('publikasi');
    Route::get('/publikasi/{slug}', [PublikasiController::class, 'show'])->name('publikasi.show');
});

Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function() {
    // Dashboard
    Route::get('/admin/dashboard', [LandingController::class, 'admin'])->name('admin.dashboard');
    // Donasi
    Route::resource('/admin/donasi', DonasiController::class)->names('admin.donasi');
    // Programs
    Route::resource('/admin/programs', ProgramsController::class)->names('admin.program');
    // ProgramsRegistrasi
    Route::resource('/admin/programs-registrasi', ProgramsRegistrasiController::class)->names('admin.program-registrasi');
    // Publikasi
    Route::resource('/admin/publikasi', PublikasiController::class)
        ->names('admin.publikasi')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // Volunteer
    Route::resources(['admin/volunteer' => VolunteerController::class], ['names' => 'admin.volunteer']);
    // VolunteerRegistrations
    Route::resources(['admin/volunteer-registrations' => VolunterRegisterController::class], ['names' => 'admin.volunteer-registrasi']);
    // Organisasi
    Route::resources(['admin/organisasi' => OrganisasiController::class], ['names' => 'admin.organisasi']);
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
