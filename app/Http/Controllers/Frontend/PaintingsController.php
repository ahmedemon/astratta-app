<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaintingsController extends Controller
{
    public function index()
    {
        $pageTitle = "Paintings";
        return view('frontend.paintings.paintings', compact('pageTitle'));
    }

    public function show($id)
    {
        $pageTitle = "View Painting";
        return view('frontend.paintings.view-painting', compact('pageTitle'));
    }
}
