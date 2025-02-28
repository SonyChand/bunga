<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RendisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Management\RoleController;
use App\Http\Controllers\Dashboard\Management\UserController;
use App\Http\Controllers\Dashboard\Management\ActivityController;

Route::get('/', function () {
    return view('home.index');
});

Route::post('/diagnose', [DiagnosisController::class, 'diagnose'])->name('diagnose');
Route::get('diagnose', [DiagnosisController::class, 'index'])->name("diagnose.index");

Route::get('lang', [LanguageController::class, 'change'])->name("change.lang");

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'send'])
    ->middleware(['auth'])
    ->name('verification.send');

Auth::routes();

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('profiles', ProfileController::class);
    Route::resource('settings', WebSettingController::class);

    // Users
    Route::get('users/export/{format}', [UserController::class, 'export'])->name('users.export');
    Route::get('users/serverside', [UserController::class, 'serverside'])->name('users.serverside');
    Route::resource('users', UserController::class);

    // Users
    Route::get('activities/export/{format}', [ActivityController::class, 'export'])->name('activities.export');
    Route::get('activities/serverside', [ActivityController::class, 'serverside'])->name('activities.serverside');
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');

    // Users
    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('users/export/{format}', [UserController::class, 'export'])->name('users.export');
    Route::get('users/serverside', [UserController::class, 'serverside'])->name('users.serverside');
    Route::resource('users', UserController::class);

    // Rendis
    Route::get('rendis/export/{format}', [RenDisController::class, 'export'])->name('rendis.export');
    Route::get('rendis/serverside', [RenDisController::class, 'serverside'])->name('rendis.serverside');
    Route::resource('rendis', RenDisController::class);

    Route::get('roles/serverside', [RoleController::class, 'serverside'])->name('roles.serverside');
    Route::resource('roles', RoleController::class);

    Route::get('testing', [UserController::class, 'testing'])->name('users.testing');
});
