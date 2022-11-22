<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// shared routes
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('login', [SiteController::class, 'login'])->name('login');
Route::post('login', [SiteController::class, 'doLogin'])->name('doLogin');
Route::get('register', [SiteController::class, 'register'])->name('register');
Route::post('register', [SiteController::class, 'doRegister'])->name('doRegister');
