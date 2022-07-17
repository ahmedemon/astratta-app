<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Seller::where('is_approved', 1)->latest()->get();
        $pageTitle = "Artists";
        return view('frontend.artists.artists', compact('pageTitle', 'artists'));
    }

    public function show($id)
    {
        $artist = Seller::find($id);
        $myProducts = Product::where('status', 1)->where('seller_id', $artist->id)->get();
        $pageTitle = "View Artist";
        return view('frontend.artists.view-artist', compact('pageTitle', 'artist', 'myProducts'));
    }
}
