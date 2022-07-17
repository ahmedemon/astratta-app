<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderRequestController;
use App\Http\Controllers\Admin\ProductRequestController;
use App\Http\Controllers\Admin\RefundRequestController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\ShortingRangeController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\WithdrawRequestController;
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
        Route::get('rejected', [SellerController::class, 'rejected'])->name('rejected');
        Route::get('approve/{id}', [SellerController::class, 'approve'])->name('approve');
        Route::get('reject/{id}', [SellerController::class, 'reject'])->name('reject');
        Route::get('recall/{id}', [SellerController::class, 'recall'])->name('recall');
        Route::get('active/{id}', [SellerController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [SellerController::class, 'deactive'])->name('deactive');
        Route::get('block/{id}', [SellerController::class, 'block'])->name('block');
        Route::get('unblock/{id}', [SellerController::class, 'unblock'])->name('unblock');
        Route::get('addtop/{id}', [SellerController::class, 'addtop'])->name('addtop');
        Route::get('removetop/{id}', [SellerController::class, 'removetop'])->name('removetop');
        Route::get('delete/{id}', [SellerController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
        Route::get('/', [ProductRequestController::class, 'index'])->name('index');
        Route::get('requests', [ProductRequestController::class, 'requested'])->name('request');
        Route::get('rejected', [ProductRequestController::class, 'rejected'])->name('rejected');
        Route::get('soldOut', [ProductRequestController::class, 'soldOut'])->name('soldOut');

        Route::get('make-best/{id}', [ProductRequestController::class, 'makeBest'])->name('make.best');
        Route::get('remove-best/{id}', [ProductRequestController::class, 'removeBest'])->name('remove.best');
        Route::get('approve/{id}', [ProductRequestController::class, 'approve'])->name('approve');
        Route::get('reject/{id}', [ProductRequestController::class, 'reject'])->name('reject');
        Route::get('recall/{id}', [ProductRequestController::class, 'recall'])->name('recall');
        Route::get('delete/{id}', [ProductRequestController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');

        Route::get('active/{id}', [CategoryController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [CategoryController::class, 'deactive'])->name('deactive');
    });

    Route::group(['prefix' => 'shorting-range', 'as' => 'short-range.'], function () {
        Route::get('/', [ShortingRangeController::class, 'index'])->name('index');
        Route::post('store', [ShortingRangeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ShortingRangeController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ShortingRangeController::class, 'update'])->name('update');
        Route::get('delete/{id}', [ShortingRangeController::class, 'destroy'])->name('destroy');

        Route::get('active/{id}', [ShortingRangeController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [ShortingRangeController::class, 'deactive'])->name('deactive');
    });

    Route::group(['prefix' => 'blogs', 'as' => 'blog.'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('create', [BlogController::class, 'create'])->name('create');
        Route::post('store', [BlogController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BlogController::class, 'update'])->name('update');
        Route::get('delete/{id}', [BlogController::class, 'destroy'])->name('destroy');

        Route::get('active/{id}', [BlogController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [BlogController::class, 'deactive'])->name('deactive');
        Route::get('make/feature/{id}', [BlogController::class, 'makeFeature'])->name('feature.make');
        Route::get('remove/feature/{id}', [BlogController::class, 'removeFeature'])->name('feature.remove');
    });

    Route::group(['prefix' => 'coupons', 'as' => 'coupon.'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::post('store', [CouponController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CouponController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CouponController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CouponController::class, 'destroy'])->name('destroy');

        Route::get('active/{id}', [CouponController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [CouponController::class, 'deactive'])->name('deactive');
    });

    Route::group(['prefix' => 'methods', 'as' => 'method.'], function () {
        Route::get('/', [WithdrawMethodController::class, 'index'])->name('index');
        Route::post('store', [WithdrawMethodController::class, 'store'])->name('store');
        Route::get('edit/{id}', [WithdrawMethodController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [WithdrawMethodController::class, 'update'])->name('update');
        Route::get('delete/{id}', [WithdrawMethodController::class, 'destroy'])->name('destroy');

        Route::get('active/{id}', [WithdrawMethodController::class, 'active'])->name('active');
        Route::get('deactive/{id}', [WithdrawMethodController::class, 'deactive'])->name('deactive');
    });

    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::get('/', [OrderRequestController::class, 'index'])->name('index');
        Route::get('requested', [OrderRequestController::class, 'requested'])->name('request');
        Route::get('rejected', [OrderRequestController::class, 'rejected'])->name('rejected');
        Route::get('completed', [OrderRequestController::class, 'completed'])->name('completed');
        Route::get('rejected/by/seller', [OrderRequestController::class, 'rejectedBySeller'])->name('rejectedBySeller');

        Route::get('approve/{id}', [OrderRequestController::class, 'approve'])->name('approve');
        Route::get('complete/{id}', [OrderRequestController::class, 'complete'])->name('complete');
        Route::get('reject/{id}', [OrderRequestController::class, 'reject'])->name('reject');
        Route::get('recall/{id}', [OrderRequestController::class, 'recall'])->name('recall');
        Route::get('delete/{id}', [OrderRequestController::class, 'destroy'])->name('destroy');

        Route::get('rescript/{order_track_id}', [OrderRequestController::class, 'rescript'])->name('rescript');
    });

    Route::group(['prefix' => 'withdraws', 'as' => 'withdraw.'], function () {
        Route::get('/', [WithdrawRequestController::class, 'index'])->name('index');
        Route::get('requested', [WithdrawRequestController::class, 'requested'])->name('requested');
        Route::get('rejected', [WithdrawRequestController::class, 'rejected'])->name('rejected');
        Route::get('completed', [WithdrawRequestController::class, 'completed'])->name('completed');

        Route::get('approve/{id}', [WithdrawRequestController::class, 'approve'])->name('approve');
        Route::post('complete/{id}', [WithdrawRequestController::class, 'complete'])->name('complete');
        Route::get('reject/{id}', [WithdrawRequestController::class, 'reject'])->name('reject');
        Route::get('recall/{id}', [WithdrawRequestController::class, 'recall'])->name('recall');
        Route::get('delete/{id}', [WithdrawRequestController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'refunds', 'as' => 'refund.'], function () {
        Route::get('/', [RefundRequestController::class, 'index'])->name('index');
        Route::get('requested', [RefundRequestController::class, 'requested'])->name('requested');
        Route::get('rejected', [RefundRequestController::class, 'rejected'])->name('rejected');
        Route::get('completed', [RefundRequestController::class, 'completed'])->name('completed');

        Route::get('approve/{id}', [RefundRequestController::class, 'approve'])->name('approve');
        Route::get('complete/{id}', [RefundRequestController::class, 'complete'])->name('complete');
        Route::get('reject/{id}', [RefundRequestController::class, 'reject'])->name('reject');
        Route::get('recall/{id}', [RefundRequestController::class, 'recall'])->name('recall');
        Route::get('delete/{id}', [RefundRequestController::class, 'destroy'])->name('destroy');
    });
});
