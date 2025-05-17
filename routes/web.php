<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\jadwalsholatController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DoaController;
use App\Http\Controllers\Admin\DzikirController as AdminDzikirController;
use App\Http\Controllers\User\DoaController as UserDoaController;
use App\Http\Controllers\User\DzikirController as UserDzikirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [QuranController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });


    Route::prefix('admin')->group(function () {
        Route::get('articles', [ArticleController::class, 'index'])->name('admin.article.index');
        Route::get('articles/create', [ArticleController::class, 'create'])->name('admin.article.create');
        Route::post('articles', [ArticleController::class, 'store'])->name('admin.article.store');
        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.article.edit');
        Route::put('articles/{article}', [ArticleController::class, 'update'])->name('admin.article.update');
        Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('admin.article.destroy');
    });

Route::prefix(('admin'))->group(function () {
    Route::get('doa', [DoaController::class, 'index'])->name('admin.doa.index');
    Route::get('doa/create', [DoaController::class, 'create'])->name('admin.doa.create');
    Route::post('doa', [DoaController::class, 'store'])->name('admin.doa.store');
    Route::get('doa/{doa}/edit', [DoaController::class, 'edit'])->name('admin.doa.edit');
    Route::put('doa/{doa}', [DoaController::class, 'update'])->name('admin.doa.update');
    Route::delete('doa/{doa}', [DoaController::class, 'destroy'])->name('admin.doa.destroy');
});

    Route::prefix('admin')->group(function () {
        Route::get('dzikir', [AdminDzikirController::class, 'index'])->name('admin.dzikir.index');
        Route::get('dzikir/create', [AdminDzikirController::class, 'create'])->name('admin.dzikir.create');
        Route::post('dzikir', [AdminDzikirController::class, 'store'])->name('admin.dzikir.store');
        Route::get('dzikir/{dzikir}/edit', [AdminDzikirController::class, 'edit'])->name('admin.dzikir.edit');
        Route::put('dzikir/{dzikir}', [AdminDzikirController::class, 'update'])->name('admin.dzikir.update');
        Route::delete('dzikir/{dzikir}', [AdminDzikirController::class, 'destroy'])->name('admin.dzikir.destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('dzikir', [UserDzikirController::class, 'index'])->name('dzikir.index');
        Route::get('dzikir/{dzikir}', [UserDzikirController::class, 'show'])->name('dzikir.show');
    });

    

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/articles', [UserArticleController::class, 'index'])->name('article.index');
        Route::get('/articles/{article}', [UserArticleController::class, 'show'])->name('article.show');
    });

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/doa', [UserDoaController::class, 'index'])->name('doa.index');
    Route::get('/doa/{id}', [UserDoaController::class, 'show'])->name('doa.show');
});

Route::get('/quran/{nomor}', [QuranController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('user.quran.show');

Route::get('/jadwal-sholat', [jadwalsholatController::class, 'jadwal'])->name('jadwal.index');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/auth.php';
