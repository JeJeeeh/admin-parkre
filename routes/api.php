<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\MallController;
use App\Http\Controllers\API\StaffController;
use App\Http\Controllers\API\VehicleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/logout', [ApiController::class, 'logout'])->middleware(['auth:api-user', 'auth:api-staff', 'auth:api-admin']);

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::put('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'destroy']);
});

Route::prefix('job')->group(function () {
    Route::get('/', [JobController::class, 'index']);
    Route::get('/{id}', [JobController::class, 'show']);
    Route::post('/', [JobController::class, 'store']);
    Route::put('/{id}', [JobController::class, 'update']);
    Route::delete('/{id}', [JobController::class, 'destroy']);
});

Route::prefix('mall')->group(function () {
    Route::get('/', [MallController::class, 'index']);
    Route::get('/{id}', [MallController::class, 'show']);
    Route::post('/', [MallController::class, 'store']);
    Route::put('/{id}', [MallController::class, 'update']);
    Route::delete('/{id}', [MallController::class, 'destroy']);
});

Route::prefix('staff')->group(function () {
    Route::get('/announcement', [StaffController::class, 'announcement']);

    Route::get('/', [StaffController::class, 'index']);
    Route::get('/{id}', [StaffController::class, 'show']);
    Route::post('/', [StaffController::class, 'store']);
    Route::put('/{id}', [StaffController::class, 'update']);
    Route::delete('/{id}', [StaffController::class, 'destroy']);
});

Route::prefix('vehicle')->group(function () {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/{id}', [VehicleController::class, 'show']);
    Route::post('/', [VehicleController::class, 'store']);
    Route::put('/{id}', [VehicleController::class, 'update']);
    Route::delete('/{id}', [VehicleController::class, 'destroy']);
});

// ==============================================================================================
Route::post('/payment/notify', [PaymentController::class, 'notify'])->name('api.payment.notify');
