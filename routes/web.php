<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Guest\LowonganController as GuestLowonganController;
use App\Http\Controllers\Guest\PendaftaranController as GuestPendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('lowongan', AdminLowonganController::class);

    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{id}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::post('/pendaftaran/{id}/approve', [AdminPendaftaranController::class, 'approve'])->name('pendaftaran.approve');
    Route::post('/pendaftaran/{id}/reject', [AdminPendaftaranController::class, 'reject'])->name('pendaftaran.reject');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});

// Guest Routes
Route::middleware(['auth', 'role:guest'])->prefix('guest')->name('guest.')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('guest.lowongan.index');
    })->name('dashboard');

    Route::get('/lowongan', [GuestLowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/{id}', [GuestLowonganController::class, 'show'])->name('lowongan.show');

    Route::get('/lowongan/{id}/daftar', [GuestPendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [GuestPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/riwayat', [GuestPendaftaranController::class, 'myPendaftaran'])->name('pendaftaran.history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
