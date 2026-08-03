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
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/acara/{slug}', [PublicSubEventController::class, 'show'])->name('sub-event.show');
Route::get('/dokumen/{document}/download', [PublicSubEventController::class, 'download'])->name('document.download');

// === Otentikasi (Laravel Breeze) ===
require __DIR__.'/auth.php';

// Pengalihan route /dashboard bawaan Breeze langsung ke dashboard admin
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');

// === Panel Admin (Wajib Login & Verifikasi Ganti Password) ===
Route::middleware(['auth', 'force.password.change'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin (Superadmin & Kesekretariatan)
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/change-year', [DashboardController::class, 'changeYear'])->name('change-year');

        // Ganti Password Admin
        Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('change-password');
        Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

        // Manajemen Link Pendaftaran Event
        Route::get('/registration-links', [RegistrationLinkController::class, 'index'])->name('registration-links.index');
        Route::put('/registration-links/{subEvent}', [RegistrationLinkController::class, 'update'])->name('registration-links.update');

        // === Khusus Akses Superadmin ===
        Route::middleware('role:SUPERADMIN')->group(function () {
            // Kelola Sub-Acara / Lomba
            Route::resource('sub-events', SubEventController::class)->except(['show']);
            Route::put('sub-events/{subEvent}/status', [SubEventController::class, 'updateStatus'])->name('sub-events.status');

            // Kelola Dokumen Sub-Acara
            Route::get('sub-events/{subEvent}/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::post('sub-events/{subEvent}/documents', [DocumentController::class, 'store'])->name('documents.store');
            Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
            Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

            // Kelola Timeline / Alur Waktu
            Route::resource('timeline', TimelineController::class)->except(['show']);

            // Kelola Pengguna / Panitia
            Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
            Route::put('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
            Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
            Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

            // Kelola Data Sponsor
            Route::resource('sponsors', SponsorController::class)->except(['show']);

            // Log Aktivitas Sistem
            Route::get('audit-log', [AuditLogController::class, 'index'])->name('audit-log.index');
        });
    });

// Route penyaji file media & gambar dari folder storage publik
Route::get('/media/{path}', function ($path) {
    // 1. Cek file di folder storage/app/public/
    $fullPath = storage_path('app/public/' . $path);
    if (file_exists($fullPath) && !is_dir($fullPath)) {
        return response()->file($fullPath, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    // 2. Cek file di folder public/storage/
    $publicPath = public_path('storage/' . $path);
    if (file_exists($publicPath) && !is_dir($publicPath)) {
        return response()->file($publicPath, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    abort(404);
})->where('path', '.*')->name('media.show');

// Route cadangan untuk akses file statis di /storage/
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (file_exists($fullPath) && !is_dir($fullPath)) {
        return response()->file($fullPath, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    $publicPath = public_path('storage/' . $path);
    if (file_exists($publicPath) && !is_dir($publicPath)) {
        return response()->file($publicPath, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    abort(404);
})->where('path', '.*');



