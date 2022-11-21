<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('login', [SiteController::class, 'login'])->name('login');
Route::get('register', [SiteController::class, 'register'])->name('register');
