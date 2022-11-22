<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// shared routes
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('login', [SiteController::class, 'login'])->name('login');
Route::post('login', [SiteController::class, 'doLogin'])->name('doLogin');
Route::get('register', [SiteController::class, 'register'])->name('register');
<<<<<<< Updated upstream
Route::post('register', [SiteController::class, 'doRegister'])->name('doRegister');
=======

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
});
>>>>>>> Stashed changes
