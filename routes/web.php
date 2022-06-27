<?php

use App\Http\Controllers\Frontend\ArtistsController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\MyCartController;
use App\Http\Controllers\Frontend\PaintingsController;
use App\Http\Controllers\HomeController;
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
});
Route::controller(MyAccountController::class)->prefix('my-account')->as('my-account.')->group(function () {
    Route::get('/', 'index')->name('index');
});
Route::controller(MyCartController::class)->prefix('my-cart')->as('my-cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('add-to-cart/{id}', 'addToCart')->name('add-to-cart');
    Route::get('remove-from-cart/{id}', 'removeFromCart')->name('remove-from-cart');
});
Route::controller(CheckoutController::class)->prefix('check-point')->as('checkout.')->group(function () {
    Route::get('checkout', 'checkout')->name('checkout');
    Route::post('place-order', 'placeOrder')->name('place.order');
    Route::get('completed/{order}', 'completed')->name('completed');
});
