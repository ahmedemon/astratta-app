<?php

use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProfileController;
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
    });
});
