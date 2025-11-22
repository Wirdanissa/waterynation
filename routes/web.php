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
    // Programs
    Route::get('/programs/offline-action', [ProgramsController::class, 'offlineAction'])->name('programs.offline-action');
    Route::get('/programs/online-webinar', [ProgramsController::class, 'onlineWebinar'])->name('programs.online-webinar');
    Route::get('/programs/modul-development-for-kids', [ProgramsController::class, 'modulDevelopmentForKids'])->name('programs.modul-development-for-kids');
    Route::get('/programs/{slug}', [ProgramsController::class, 'show'])->name('programs.show');
    // Donasi
    Route::get('/donasi', [DonasiController::class, 'donasiUser'])->name('donasi');
    // Volunteer
    Route::get('/volunteer', [VolunteerController::class, 'volunteerUser'])->name('volunteer');
    Route::get('/volunteer/{slug}', [VolunteerController::class, 'show'])->name('volunteer.show');
});

Route::group(['middleware' => [ 'role:admin','auth', 'verified']], function() {
    // Dashboard
    Route::get('/admin/dashboard', [LandingController::class, 'admin'])->name('admin.dashboard');
    // Donasi
    Route::resource('/admin/donasi', DonasiController::class)->names('admin.donasi')
        ->only(['index', 'create', 'edit', 'update', 'destroy']);
    // Programs
    Route::resource('/admin/programs', ProgramsController::class)->names('admin.program')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // ProgramsRegistrasi
    Route::resource('/admin/programs-registrasi', ProgramsRegistrasiController::class)->names('admin.program-registrasi')
        ->only(['index', 'create','show', 'edit', 'update', 'destroy']);
    // Publikasi
    Route::resource('/admin/publikasi', PublikasiController::class)
        ->names('admin.publikasi')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // Volunteer
    Route::resource('/admin/volunteer', VolunteerController::class)
        ->names('admin.volunteer')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // VolunteerRegistrations
    Route::resources(['admin/volunteer-registrations' => VolunterRegisterController::class], ['names' => 'admin.volunteer-registrasi']);
    // Organisasi
    Route::resources(['admin/organisasi' => OrganisasiController::class], ['names' => 'admin.organisasi']);
    // Users
    Route::get('/admin/users', [LandingController::class, 'adminUser'])->name('admin.user.index');
    Route::delete('/admin/users/{id}', [LandingController::class, 'adminDeleteUser'])->name('admin.user.delete');
    Route::get('/admin/users/{id}/edit', [LandingController::class, 'adminEditUser'])->name('admin.user.edit');
});

Route::group(['middleware' => ['role:user','auth', 'verified']], function() {
    // ProgramsRegistrasi
    Route::resource('/programs-registrasi', ProgramsRegistrasiController::class)->names('program-registrasi');
    Route::resource('/volunteer-registrasi', VolunterRegisterController::class)->names('volunteer-registrasi');
    // Donasi
    Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
