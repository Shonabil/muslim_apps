<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\jadwalsholatController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DoaController as AdminDoaController;
use App\Http\Controllers\Admin\DzikirController as AdminDzikirController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\DoaController as UserDoaController;
use App\Http\Controllers\User\DzikirController as UserDzikirController;

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';

// Dashboard untuk user
Route::get('/dashboard', [QuranController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Dashboard untuk admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

// ========================= Admin Routes =========================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Manajemen User
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Artikel
    Route::resource('article', AdminArticleController::class)->except(['show']);

    // Doa
    Route::resource('doa', AdminDoaController::class)->except(['show']);

    // Dzikir
    Route::resource('dzikir', AdminDzikirController::class)->except(['show']);
});

// ========================= User Routes =========================
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    // Dzikir
    Route::get('dzikir', [UserDzikirController::class, 'index'])->name('dzikir.index');
    Route::get('dzikir/{dzikir}', [UserDzikirController::class, 'show'])->name('dzikir.show');

    // Artikel
    Route::get('articles', [UserArticleController::class, 'index'])->name('article.index');
    Route::get('articles/{article}', [UserArticleController::class, 'show'])->name('article.show');

    // Doa
    Route::get('doa', [UserDoaController::class, 'index'])->name('doa.index');
    Route::get('doa/{id}', [UserDoaController::class, 'show'])->name('doa.show');
});

// ========================= Quran Routes =========================
Route::get('/quran/{nomor}', [QuranController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('user.quran.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/quran/bookmark', [QuranController::class, 'bookmark'])->name('quran.bookmark');
    Route::get('/quran/bookmark', [QuranController::class, 'getBookmark'])->name('quran.bookmark.get');
    Route::delete('/quran/bookmark', [QuranController::class, 'unbookmark'])->name('quran.unbookmark');
});

// ========================= Jadwal Sholat =========================
Route::get('/jadwal-sholat', [jadwalsholatController::class, 'jadwal'])->name('jadwal.index');

// ========================= Profile =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
