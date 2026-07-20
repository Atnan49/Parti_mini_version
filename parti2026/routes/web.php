<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SubEventController as PublicSubEventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\RegistrationLinkController;
use App\Http\Controllers\Admin\SubEventController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\AuditLogController;
use Illuminate\Support\Facades\Route;

// === Halaman Publik ===
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/acara/{slug}', [PublicSubEventController::class, 'show'])->name('sub-event.show');
Route::get('/dokumen/{document}/download', [PublicSubEventController::class, 'download'])->name('document.download');

// === Auth (Laravel Breeze) ===
require __DIR__.'/auth.php';

// ponytail: redirect default Breeze dashboard route to admin.dashboard to keep Breeze controllers unchanged
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');

// === Panel Admin (Membutuhkan Auth & Verifikasi Password Baru) ===
Route::middleware(['auth', 'force.password.change'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard (Bisa diakses SUPERADMIN & KESEKRETARIATAN)
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/change-year', [DashboardController::class, 'changeYear'])->name('change-year');

        // Ganti Password (Khusus First Login / Manual)
        Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('change-password');
        Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

        // Manajemen Link Pendaftaran (SUPERADMIN & KESEKRETARIATAN)
        Route::get('/registration-links', [RegistrationLinkController::class, 'index'])->name('registration-links.index');
        Route::put('/registration-links/{subEvent}', [RegistrationLinkController::class, 'update'])->name('registration-links.update');

        // === Fitur Khusus SUPERADMIN ===
        Route::middleware('role:SUPERADMIN')->group(function () {
            // Sub Acara
            Route::resource('sub-events', SubEventController::class)->except(['show']);
            Route::put('sub-events/{subEvent}/status', [SubEventController::class, 'updateStatus'])->name('sub-events.status');

            // Dokumen per Sub Acara
            Route::get('sub-events/{subEvent}/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::post('sub-events/{subEvent}/documents', [DocumentController::class, 'store'])->name('documents.store');
            Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
            Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

            // Timeline
            Route::resource('timeline', TimelineController::class)->except(['show']);

            // User Management (Kesekretariatan)
            Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
            Route::put('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
            Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
            Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

            // Sponsor Management
            Route::resource('sponsors', SponsorController::class)->except(['show']);

            // Audit Logs
            Route::get('audit-log', [AuditLogController::class, 'index'])->name('audit-log.index');
        });
    });

// ponytail: REMOVED /create-symlink, /run-migration, /run-seed routes.
// These exposed Artisan commands to the public internet without authentication.
// For shared hosting without SSH, run these via a one-time PHP script and delete it immediately,
// or protect them behind auth middleware at minimum.



