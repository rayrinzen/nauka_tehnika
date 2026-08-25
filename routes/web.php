<?php

use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Публичные маршруты
Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/api/search', [NewsController::class, 'liveSearch'])->name('api.search');

// Авторизация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Админ-панель (защищена middleware auth)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/news', [AdminNewsController::class, 'index'])->name('news.index');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('news.store');
    Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
});
