<?php

use App\Http\Controllers\API\MallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('mall')->group(function () {
    Route::get('/', [MallController::class, 'index'])->name('mall.get');
    Route::post('/', [MallController::class, 'store'])->name('mall.post');
    Route::put('/{id}', [MallController::class, 'update'])->name('mall.put');
    Route::delete('/{id}', [MallController::class, 'destroy'])->name('mall.delete');

    Route::get('/{id}', [MallController::class, 'show'])->name('mall.find');
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.get');
    Route::post('/', [UserController::class, 'store'])->name('user.post');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.put');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/{id}', [UserController::class, 'show'])->name('user.find');
});
