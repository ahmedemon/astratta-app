<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $pageTitle = "Products";
        return view('seller.product.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Post a paint";
        return view('seller.product.form', compact('pageTitle'));
    }
}
