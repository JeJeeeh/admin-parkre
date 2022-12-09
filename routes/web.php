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

    Route::get('/detail/{id}', [AdminController::class, 'userDetail'])->name('admin.userDetail');
    Route::get('/block/{id}', [AdminController::class, 'blockUser'])->name('admin.blockUser');
    Route::get('/unblock/{id}', [AdminController::class, 'unblockUser'])->name('admin.unblockUser');

    Route::prefix('/mall')->group(function () {
        Route::get('/', [AdminController::class, 'mallList'])->name('admin.mall');
        Route::post('/', [AdminController::class, 'searchMall'])->name('admin.searchMall');
        Route::get('/add', [AdminController::class, 'addMall'])->name('admin.addMall');
        Route::post('/add', [AdminController::class, 'doAddMall'])->name('admin.doAddMall');
        Route::post('/edit', [AdminController::class, 'doEditMall'])->name('admin.doEditMall');

        Route::get('/block/{id}', [AdminController::class, 'blockMall'])->name('admin.blockMall');
        Route::get('/unblock/{id}', [AdminController::class, 'unblockMall'])->name('admin.unblockMall');
        Route::get('/edit/{id}', [AdminController::class, 'editMall'])->name('admin.editMall');
        Route::get('/{id}', [AdminController::class, 'mallDetail'])->name('admin.mallDetail');

        Route::prefix('/segmentation')->group(function () {
            Route::get('/add', [AdminController::class, 'addSegmentation'])->name('admin.addSegmentation');
            Route::post('/add', [AdminController::class, 'doAddSegmentation'])->name('admin.doAddSegmentation');
            Route::post('/edit', [AdminController::class, 'doEditSegmentation'])->name('admin.doEditSegmentation');
            Route::get('/edit/{id}', [AdminController::class, 'editSegmentation'])->name('admin.editSegmentation');
            Route::get('/block/{id}', [AdminController::class, 'blockSegmentation'])->name('admin.blockSegmentation');
            Route::get('/unblock/{id}', [AdminController::class, 'unblockSegmentation'])->name('admin.unblockSegmentation');
            Route::get('/delete/{id}', [AdminController::class, 'deleteSegmentation'])->name('admin.deleteSegmentation');
            Route::get('/{id}', [AdminController::class, 'segmentation'])->name('admin.segmentation');
        });
    });

    Route::prefix('/announcement')->group(function () {
        Route::get('/', [AdminController::class, 'announcement'])->name('admin.announcement');
        Route::get('/add', [AdminController::class, 'addAnnouncement'])->name('admin.addAnnouncement');
        Route::post('/add', [AdminController::class, 'doAddAnnouncement'])->name('admin.doAddAnnouncement');

        Route::get('/delete/{id}', [AdminController::class, 'deleteAnnouncement'])->name('admin.deleteAnnouncement');
        Route::get('/restore/{id}', [AdminController::class, 'restoreAnnouncement'])->name('admin.restoreAnnouncement');
        Route::get('/edit/{id}', [AdminController::class, 'editAnnouncement'])->name('admin.editAnnouncement');
        Route::post('/doEdit}', [AdminController::class, 'doEditAnnouncement'])->name('admin.doEditAnnouncement');
        Route::get('/{id}', [AdminController::class, 'announcementDetail'])->name('admin.announcementDetail');
    });
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
