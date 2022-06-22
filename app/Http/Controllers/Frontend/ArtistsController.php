<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $pageTitle = "Artists";
        return view('frontend.artists.artists', compact('pageTitle'));
    }

    public function show($id)
    {
        $pageTitle = "View Artist";
        return view('frontend.artists.view-artist', compact('pageTitle'));
    }
}
