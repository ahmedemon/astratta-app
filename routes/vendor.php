<?php

use App\Http\Controllers\Vendor\Auth\VendorLoginController;
use App\Http\Controllers\Vendor\Auth\VendorRegisterController;
use App\Http\Controllers\Vendor\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('join-us', [VendorRegisterController::class, 'index'])->name('join-us');
Route::post('join', [VendorRegisterController::class, 'store'])->name('join');

Route::get('login', [VendorLoginController::class, 'viewLogin'])->name('log-in');
Route::post('vendor-login', [VendorLoginController::class, 'login'])->name('login');
Route::post('logout', [VendorLoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'vendor', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});
