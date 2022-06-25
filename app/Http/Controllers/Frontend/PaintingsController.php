<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PaintingsController extends Controller
{
    public function index()
    {
        $paintings = Product::where('status', 1)->latest()->get();
        $pageTitle = "Paintings";
        return view('frontend.paintings.paintings', compact('pageTitle', 'paintings'));
    }

    public function show($id)
    {
        $painting = Product::find($id);
        $relatedProducts = Product::where('status', 1)->where('category', $painting->category)->take(3)->get();
        $pageTitle = $painting->product_name;
        return view('frontend.paintings.view-painting', compact('pageTitle', 'painting', 'relatedProducts'));
    }
}
