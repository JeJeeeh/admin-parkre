<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

// shared routes

Route::middleware('guest.custom')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::get('login', [SiteController::class, 'login'])->name('login');
    Route::post('login', [SiteController::class, 'doLogin'])->name('doLogin');

    Route::get('register', [SiteController::class, 'register'])->name('register');
    Route::post('register', [SiteController::class, 'doRegister'])->name('doRegister');

    // forgot password routes
    Route::get('/forgot', [SiteController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot', [SiteController::class, 'doForgotPassword'])->name('doForgotPassword');

    Route::get('/verify', [SiteController::class, 'verifyToken'])->name('verifyToken')->middleware('auth.forgot');
    Route::post('/verify', [SiteController::class, 'doVerifyToken'])->name('doVerifyToken')->middleware('auth.forgot');

    Route::get('/change', [SiteController::class, 'changePassword'])->name('changePassword')->middleware('auth.forgot');
    Route::post('/change', [SiteController::class, 'doChangePassword'])->name('doChangePassword')->middleware('auth.forgot');
});

Route::post('/logout', [SiteController::class, 'logout'])->name('logout')->middleware('auth.logout');
// Route::get('/logout', [SiteController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::post('/', [AdminController::class, 'searchUser'])->name('admin.searchUser');
    Route::prefix('/report')->group(function () {
        Route::get('/', [AdminController::class, 'report'])->name('admin.report');
        Route::get('/{q?}', [AdminController::class, 'detailsReport'])->name('admin.report.details');
        Route::put('/details/{type}/{month}', [AdminController::class, 'detailsReportJSON']);
        Route::put('/updatestats/{type}/{month}', [AdminController::class, 'updateStat']);
        Route::put("/user_transaction", [AdminController::class, 'reportTransaksiUser'])->name('admin.reportTransaksiUser');
        Route::put("/profit", [AdminController::class, 'reportKeuntunganCustomer'])->name('admin.reportKeuntunganCustomer');
        Route::put("/reservation_customer", [AdminController::class, 'reportReservasiCustomer'])->name('admin.reportReservasiCustomer');
        Route::put("/reservation_success", [AdminController::class, 'reportReservasiSukses'])->name('admin.reportReservasiSukses');
        Route::put("/review_customer", [AdminController::class, 'reportReviewCustomer'])->name('admin.reportReviewCustomer');
    });

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


Route::prefix('staff')->middleware('auth.staff')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('staff.home');
    Route::get('/detail/{id}', [StaffController::class, 'detailReservation'])->name('staff.reservationDetail');
    Route::get('/announcement', [StaffController::class, 'viewAnnouncement'])->name('staff.announcement');
    Route::get('/announcemet/{id}', [StaffController::class, 'detailAnnouncement'])->name('staff.announcementDetail');
    Route::get('/addAnnouncement', [StaffController::class, 'addAnnouncement'])->name('staff.addAnnouncement');
    Route::post('/addAnnouncement', [StaffController::class, 'doAddAnnouncement'])->name('staff.doAddAnnouncement');

    Route::get('/report', [StaffController::class, 'viewReport'])->name('staff.report');
    Route::put('/reportjson', [StaffController::class, 'viewReportJSON'])->name('staff.reportjson');
});

Route::prefix('home')->middleware('auth.user')->group(function () {
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
    Route::get('/reservations', [CustomerController::class, 'reservations'])->name('customer.reservations');

    Route::get('/search', [CustomerController::class, 'searchMall'])->name('customer.search.mall');
    Route::get('/{mall_slug}', [CustomerController::class, 'mallDetail'])->name('customer.mall.detail');
    Route::get('/{mall_slug}/reserve', [CustomerController::class, 'reserve'])->name('customer.reserve');
});


// testing payment route

// Route::prefix('/payment')->group(function () {
//     Route::get('/', function () {

//         $res = \App\Utilities\PaymentHelper::redirectPayment([
//             'product' => ['test'],
//             'qty' => [1],
//             'price' => [10000],
//             'returnUrl' => 'http://localhost:8000/payment/return',
//             'cancelUrl' => 'http://localhost:8000/payment/cancel',
//             'notifyUrl' => 'https://d17a-180-247-166-214.ap.ngrok.io/api/payment/notify',
//             'referenceId' => '123456789',
//             'buyerName' => 'John Doe',
//             'buyerEmail' => 'john@doe.com',
//             'buyerPhone' => '08123456789',
//         ]);

//         return redirect($res->Data->Url);
//     });

//     Route::get('/return', function (Request $req) {
//         return 'redirected';
//     });
//     Route::get('/cancel', function () {
//         return 'cancel';
//     });
//     Route::post('/notify', function (Request $req) {
//         return $req->trx_id;
//     });
// });
