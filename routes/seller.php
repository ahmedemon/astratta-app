<?php

use App\Http\Controllers\Seller\AccountSettingController;
use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProfileController;
use App\Http\Controllers\Seller\RefundController;
use App\Http\Controllers\Seller\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::get('join-us', [SellerRegisterController::class, 'index'])->name('join-us');
Route::post('join', [SellerRegisterController::class, 'store'])->name('join');

Route::get('login', [SellerLoginController::class, 'viewLogin'])->name('log-in');
Route::post('seller-login', [SellerLoginController::class, 'login'])->name('login');
Route::post('logout', [SellerLoginController::class, 'logout'])->name('logout');

Route::middleware('seller')->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('update-profile/{id}', [ProfileController::class, 'update'])->name('update');
    });
    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('add-product', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('edit-product/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('approve/{id}', [OrderController::class, 'approve'])->name('approve');
        Route::get('reject/{id}', [OrderController::class, 'reject'])->name('reject');
        Route::get('delete/{id}', [OrderController::class, 'destroy'])->name('destroy');
        Route::get('make-delete/{id}', [OrderController::class, 'makeDelete'])->name('make.delete');
    });
    Route::group(['prefix' => 'refunds', 'as' => 'refund.'], function () {
        Route::get('/', [RefundController::class, 'index'])->name('index');
        Route::get('approve/{id}', [RefundController::class, 'approve'])->name('approve');
        Route::get('reject/{id}', [RefundController::class, 'reject'])->name('reject');
        Route::get('delete/{id}', [RefundController::class, 'destroy'])->name('destroy');
        Route::get('make-delete/{id}', [RefundController::class, 'makeDelete'])->name('make.delete');
    });
    Route::group(['prefix' => 'withdraws', 'as' => 'withdraw.'], function () {
        Route::get('/', [WithdrawController::class, 'index'])->name('index');
        Route::get('create', [WithdrawController::class, 'create'])->name('create');
        Route::post('store', [WithdrawController::class, 'store'])->name('store');
    });
    Route::group(['prefix' => 'settings', 'as' => 'setting.'], function () {
        Route::get('/', [AccountSettingController::class, 'index'])->name('index');
        Route::put('update/{id}', [AccountSettingController::class, 'updateuAccount'])->name('update');
    });
});
