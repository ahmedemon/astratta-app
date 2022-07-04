<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AdminLoginController::class, 'viewLogin'])->name('log-in');
Route::post('admin-login', [AdminLoginController::class, 'login'])->name('login');
Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'sellers', 'as' => 'seller.'], function () {
        Route::get('/', [SellerController::class, 'index'])->name('index');
        Route::get('requests', [SellerController::class, 'sellerRequest'])->name('request');
        Route::get('approve/{id}', [SellerController::class, 'approve'])->name('approve');
        Route::get('delete/{id}', [SellerController::class, 'destroy'])->name('destroy');
    });
});
