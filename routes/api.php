<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DzikirController;
use App\Http\Controllers\Api\DoaController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\BookmarkController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
});


Route::get('/doa', [DoaController::class, 'index']);
Route::get('/doa/{id}', [DoaController::class, 'show']);

 Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

Route::get('/dzikirs', [DzikirController::class, 'index']);
Route::get('/dzikirs/{id}', [DzikirController::class, 'show']);


Route::middleware('auth:sanctum')->post('/bookmark/toggle', [BookmarkController::class, 'toggle']);
Route::middleware('auth:sanctum')->get('/bookmark/toggle', [BookmarkController::class, 'getBookmarks']);



