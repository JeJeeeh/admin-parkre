<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// shared routes
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('login', [SiteController::class, 'login'])->name('login');
Route::post('login', [SiteController::class, 'doLogin'])->name('doLogin');

Route::get('register', [SiteController::class, 'register'])->name('register');
Route::post('register', [SiteController::class, 'doRegister'])->name('doRegister');

Route::post('/logout', [SiteController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::post('/', [AdminController::class, 'searchUser'])->name('admin.searchUser');
    Route::get('/mall', [AdminController::class, 'mallList'])->name('admin.mall');
    Route::post('/mall', [AdminController::class, 'searchMall'])->name('admin.searchMall');
    Route::get('/mall/add', [AdminController::class, 'mallDetail'])->name('admin.addMall');
    Route::get('/mall/{id}', [AdminController::class, 'mallDetail'])->name('admin.mallDetail');
    Route::get('/addMall', [AdminController::class, 'addMall'])->name('admin.addMall');
});

Route::prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff.home');
    Route::get('/detail/{id}', [StaffController::class, 'detailReservation'])->name('staff.reservationDetail');
    Route::get('/announcement', [StaffController::class, 'viewAnnouncement'])->name('staff.announcement');
    Route::get('/announcemet/{id}', [StaffController::class, 'detailAnnouncement'])->name('staff.announcementDetail');
    Route::get('/addAnnouncement', [StaffController::class, 'addAnnouncement'])->name('staff.addAnnouncement');
    Route::post('/addAnnouncement', [StaffController::class, 'doAddAnnouncement'])->name('staff.doAddAnnouncement');

    Route::get('/report', [StaffController::class, 'viewReport'])->name('staff.report');
    Route::put('/reportjson', [StaffController::class, 'viewReportJSON'])->name('staff.reportjson');
});

Route::prefix('home')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
    Route::get('/{mall_slug}', [CustomerController::class, 'mallDetail'])->name('customer.mall.detail');
});
