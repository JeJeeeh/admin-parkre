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
});

Route::prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff.home');
    Route::get('/detail/{id}', [StaffController::class, 'detailReservation'])->name('staff.reservationDetail');
    Route::get('/announcement', [StaffController::class, 'viewAnnouncement'])->name('staff.announcement');
    Route::get('/announcemet/{id}', [StaffController::class, 'detailAnnouncement'])->name('staff.announcementDetail');
    Route::get('/addAnnouncement', [StaffController::class, 'addAnnouncement'])->name('staff.addAnnouncement');
    Route::post('/addAnnouncement', [StaffController::class, 'doAddAnnouncement'])->name('staff.doAddAnnouncement');

    Route::get('/report', [StaffController::class, 'viewReport'])->name('staff.report');
});

Route::prefix('home')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
    Route::prefix('profile')->group(function () {
        Route::get('/', [CustomerController::class, 'profile'])->name('customer.profile');
        Route::get('/edit', [CustomerController::class, 'editProfile'])->name('customer.editProfile');
        Route::post('/edit', [CustomerController::class, 'doEditProfile'])->name('customer.doEditProfile');
        Route::prefix('vehicle')->group(function () {
            Route::get('add', [CustomerController::class, 'addVehicle'])->name('customer.addVehicle');
            Route::post('add', [CustomerController::class, 'doAddVehicle'])->name('customer.doAddVehicle');
            Route::post('edit', [CustomerController::class, 'editVehicle'])->name('customer.editVehicle');
            Route::post('doedit', [CustomerController::class, 'doEditVehicle'])->name('customer.doEditVehicle');
            Route::post('delete', [CustomerController::class, 'deleteVehicle'])->name('customer.deleteVehicle');
        });
    });

    Route::post('/reserve', [CustomerController::class, 'doReserve'])->name('customer.doReserve');
    Route::get('/payment', [CustomerController::class, 'payment'])->name('customer.payment');

    Route::get('/search', [CustomerController::class, 'searchMall'])->name('customer.search.mall');
    Route::get('/{mall_slug}', [CustomerController::class, 'mallDetail'])->name('customer.mall.detail');
    Route::get('/{mall_slug}/reserve', [CustomerController::class, 'reserve'])->name('customer.reserve');
});
