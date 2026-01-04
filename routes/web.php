<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ProgramsRegistrasiController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\VolunterRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// GUEST / PUBLIC ROUTES
Route::middleware('force.verified')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    Route::get('/profile', [LandingController::class, 'profile'])->name('profile');
    Route::get('/visi-misi', [LandingController::class, 'landingVisiMisi'])->name('visi-misi');
    Route::get('/tim', [LandingController::class, 'landingTim'])->name('tim');
    
    Route::get('/publikasi', [PublikasiController::class, 'userPublikasi'])->name('publikasi');
    Route::get('/publikasi/{slug}', [PublikasiController::class, 'show'])->name('publikasi.show');
    
    Route::get('/programs/offline-action', [ProgramsController::class, 'offlineAction'])->name('programs.offline-action');
    Route::get('/programs/online-webinar', [ProgramsController::class, 'onlineWebinar'])->name('programs.online-webinar');
    Route::get('/programs/modul-development-for-kids', [ProgramsController::class, 'modulDevelopmentForKids'])->name('programs.modul-development-for-kids');
    Route::get('/programs/{slug}', [ProgramsController::class, 'show'])->name('programs.show');
    
    Route::get('/donasi', [DonasiController::class, 'donasiUser'])->name('donasi');
    
    Route::get('/volunteer', [VolunteerController::class, 'volunteerUser'])->name('volunteer');
    Route::get('/volunteer/{slug}', [VolunteerController::class, 'show'])->name('volunteer.show');
    Route::get('/apa-kata-mereka', [VolunteerController::class, 'testimoni'])->name('apa-kata-mereka');
    Route::get('/volunteer-tim', [VolunteerController::class, 'volunteerTim'])->name('volunteer.tim');
});

// ADMIN ROUTES (Prefix: admin, Name: admin.xxx)
Route::group(['middleware' => ['role:admin', 'auth', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/dashboard', [LandingController::class, 'admin'])->name('dashboard');
    
    // Donasi
    Route::patch('/donasi/{id}/verify', [DonasiController::class, 'verify'])->name('donasi.verify');
    Route::patch('/donasi/{id}/reject', [DonasiController::class, 'reject'])->name('donasi.reject');
    Route::resource('/donasi', DonasiController::class)->only(['index', 'destroy']);
    
    // Programs
    Route::resource('/programs', ProgramsController::class);
    
    // Programs Registrasi 
    // Route Export diletakkan di atas resource agar tidak terdeteksi sebagai ID
    Route::get('/programs-registrasi/export', [ProgramsRegistrasiController::class, 'exportExcel'])->name('program-registrasi.export');
    Route::resource('/programs-registrasi', ProgramsRegistrasiController::class)->names('program-registrasi');
    
    // Publikasi
    Route::resource('/publikasi', PublikasiController::class);
    
    // Volunteer
    Route::resource('/volunteer', VolunteerController::class);
    
    // Volunteer Registrations
    Route::resource('/volunteer-registrations', VolunterRegisterController::class)->names('volunteer-registrasi');
    
    // Organisasi
    Route::resource('/organisasi', OrganisasiController::class);
    
    // Users Management
    Route::get('/users', [LandingController::class, 'adminUser'])->name('user.index');
    Route::delete('/users/{id}', [LandingController::class, 'adminDeleteUser'])->name('user.delete');
    Route::get('/users/{id}/edit', [LandingController::class, 'adminEditUser'])->name('user.edit');
});

// USER ROUTES (Role: user)
Route::group(['middleware' => ['role:user', 'auth', 'verified']], function () {
    Route::resource('/programs-registrasi', ProgramsRegistrasiController::class)
        ->names('program-registrasi-user')
        ->only(['store', 'index']); 

    Route::resource('/volunteer-registrasi', VolunterRegisterController::class)
        ->names('volunteer-registrasi-user')
        ->only(['store']);

    Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
});

// Auth Routes (Login, Register, dsb)
require __DIR__ . '/auth.php';