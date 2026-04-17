<?php

use App\Http\Controllers\CvController;
use App\Http\Controllers\CvSettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Middleware\BlockAdminFromCVDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Alias route for dashboard
Route::redirect('/dashboard', '/dashboard/', 301)->name('dashboard');

// Page routes (no prefix)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.view');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update.alt');
    Route::get('/cv', [CvController::class, 'index'])->name('cv.index');
    Route::resource('experiences', ExperienceController::class)->only(['index', 'show']);
});

Route::middleware(['auth', BlockAdminFromCVDashboard::class])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Aide & Guide
    Route::get('/aide', function () {
        return view('pages.help');
    })->name('help');

    // Profile & Photo
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/cv', [ProfileController::class, 'updateCv'])->name('profile.updateCv');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');

    // Experiences
    Route::resource('experiences', ExperienceController::class)->except(['show']);

    // Educations
    Route::resource('educations', EducationController::class)->except(['show']);

    // Skills
    Route::resource('skills', SkillController::class)->except(['show', 'create', 'edit']);

    // Hobbies
    Route::resource('hobbies', HobbyController::class)->except(['show', 'create', 'edit']);

    // CV Settings
    Route::get('/cv-settings', [CvSettingController::class, 'edit'])->name('cv-settings.edit');
    Route::put('/cv-settings', [CvSettingController::class, 'update'])->name('cv-settings.update');

    // CV Preview & Download
    Route::get('/cv/preview', [CvController::class, 'preview'])->name('cv.preview');
    Route::get('/cv/download', [CvController::class, 'download'])
        ->middleware('throttle:10,3600')  // 10 per hour - prevent DoS
        ->name('cv.download');
});

// Filament Admin Login POST route
Route::post('/admin/login', function () {
    return redirect('/admin');
})->name('filament.admin.auth.login.store')->middleware('throttle:5,1');

require __DIR__.'/auth.php';
