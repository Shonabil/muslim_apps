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
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\DoaController as UserDoaController;
use App\Http\Controllers\User\DzikirController as UserDzikirController;


Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';


Route::get('/dashboard', [QuranController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');


    Route::get('articles', [AdminArticleController::class, 'index'])->name('article.index');
    Route::get('articles/create', [AdminArticleController::class, 'create'])->name('article.create');
    Route::post('articles', [AdminArticleController::class, 'store'])->name('article.store');
    Route::get('articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('article.edit');
    Route::put('articles/{article}', [AdminArticleController::class, 'update'])->name('article.update');
    Route::delete('articles/{article}', [AdminArticleController::class, 'destroy'])->name('article.destroy');


    Route::get('doa', [AdminDoaController::class, 'index'])->name('doa.index');
    Route::get('doa/create', [AdminDoaController::class, 'create'])->name('doa.create');
    Route::post('doa', [AdminDoaController::class, 'store'])->name('doa.store');
    Route::get('doa/{doa}/edit', [AdminDoaController::class, 'edit'])->name('doa.edit');
    Route::put('doa/{doa}', [AdminDoaController::class, 'update'])->name('doa.update');
    Route::delete('doa/{doa}', [AdminDoaController::class, 'destroy'])->name('doa.destroy');


    Route::get('dzikir', [AdminDzikirController::class, 'index'])->name('dzikir.index');
    Route::get('dzikir/create', [AdminDzikirController::class, 'create'])->name('dzikir.create');
    Route::post('dzikir', [AdminDzikirController::class, 'store'])->name('dzikir.store');
    Route::get('dzikir/{dzikir}/edit', [AdminDzikirController::class, 'edit'])->name('dzikir.edit');
    Route::put('dzikir/{dzikir}', [AdminDzikirController::class, 'update'])->name('dzikir.update');
    Route::delete('dzikir/{dzikir}', [AdminDzikirController::class, 'destroy'])->name('dzikir.destroy');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {

    Route::get('dzikir', [UserDzikirController::class, 'index'])->name('dzikir.index');
    Route::get('dzikir/{dzikir}', [UserDzikirController::class, 'show'])->name('dzikir.show');






    Route::get('articles', [UserArticleController::class, 'index'])->name('article.index');
    Route::get('articles/{article}', [UserArticleController::class, 'show'])->name('article.show');


    Route::get('doa', [UserDoaController::class, 'index'])->name('doa.index');
    Route::get('doa/{id}', [UserDoaController::class, 'show'])->name('doa.show');
});

// Route::get('/', [QuranController::class, 'index'])->name('quran.index');

// Route untuk menampilkan detail surah + ayat, hanya bisa diakses user yang login dan terverifikasi
Route::get('/quran/{nomor}', [QuranController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('user.quran.show');

// Route untuk menyimpan bookmark (akses setelah login)
Route::post('/quran/bookmark', [QuranController::class, 'bookmark'])
    ->middleware(['auth', 'verified'])
    ->name('quran.bookmark');

// Route opsional: hapus bookmark
Route::delete('/quran/bookmark', [QuranController::class, 'unbookmark'])
    ->middleware(['auth', 'verified'])
    ->name('quran.unbookmark');

Route::get('/jadwal-sholat', [jadwalsholatController::class, 'jadwal'])->name('jadwal.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('quran')->group(function () {
    Route::post('/bookmark', [QuranController::class, 'bookmark'])->name('quran.bookmark');
    Route::delete('/bookmark', [QuranController::class, 'unbookmark'])->name('quran.unbookmark');
});

