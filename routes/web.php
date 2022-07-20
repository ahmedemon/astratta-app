<?php

use App\Http\Controllers\Frontend\AccountSettingController;
use App\Http\Controllers\Frontend\ArtistsController;
use App\Http\Controllers\Frontend\BillingController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\MyCartController;
use App\Http\Controllers\Frontend\PaintingsController;
use App\Http\Controllers\Frontend\RefundController;
use App\Http\Controllers\Frontend\ShippingController;
use App\Http\Controllers\HomeController;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(FrontendController::class)->group(function () {
    Route::get('about', 'about')->name('about');

    Route::get('contact', 'contact')->name('contact');
    Route::post('contact', 'contactStore')->name('contact.store');

    Route::get('contract', 'contract')->name('contract');

    Route::get('blogs', 'blogs')->name('blogs');
    Route::get('blog/{id}', 'viewBlog')->name('blog');
});

Route::controller(ArtistsController::class)->prefix('artists')->as('artist.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('view/{id}', 'show')->name('show');
});
Route::controller(PaintingsController::class)->prefix('paintings')->as('painting.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('view/{id}', 'show')->name('show');
    Route::get('search', 'search')->name('search');
    Route::get('short/by/{start}/{end}', 'shortBy')->name('short.by');
    Route::get('newest', 'newest')->name('newest');
    Route::get('oldest', 'oldest')->name('oldest');
});

Route::controller(MyAccountController::class)->prefix('my-account')->as('my-account.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('update-refund/{id}', 'refundUpdate')->name('refund.update');
    Route::get('buyer/approval/{id}', 'gotTheProduct')->name('got.the.product');
});
Route::controller(AccountSettingController::class)->prefix('settings')->as('settings.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('save-changes/{id}', 'update')->name('update');
});
Route::controller(BillingController::class)->prefix('billing')->as('billing.')->group(function () {
    Route::get('edit', 'edit')->name('edit');
    Route::put('update-billing/{id}', 'update')->name('update');
});
Route::controller(ShippingController::class)->prefix('shipping')->as('shipping.')->group(function () {
    Route::get('edit', 'edit')->name('edit');
    Route::put('update-shipping/{id}', 'update')->name('update');
});
Route::controller(MyCartController::class)->prefix('my-cart')->as('my-cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('check-coupon', 'coupon_check')->name('check.coupon');
    Route::get('add-to-cart/{id}', 'addToCart')->name('add-to-cart');
    Route::get('remove-from-cart/{id}', 'removeFromCart')->name('remove-from-cart');
});
Route::controller(CheckoutController::class)->prefix('check-point')->as('checkout.')->group(function () {
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('buy-now/{id}', 'buyNow')->name('buy.now');
    Route::post('place-order', 'placeOrder')->name('place.order');
    Route::get('completed/{order}', 'completed')->name('completed');
    Route::get('success', 'success')->name('success');
});

Route::get('artisan-call', function () {
    Artisan::call('storage:link');
});
