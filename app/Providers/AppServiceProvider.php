<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Seller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('path.public', function () {
        //     return realpath(base_path() . '/../public_html');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $product = ProductImage::first();
        $top_artists = Seller::where('is_top', 1)->get();
        config(['image.product' => $product, 'top_artists' => $top_artists, 'currency.usd' => '$']);
    }
}
