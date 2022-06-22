<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyCartController extends Controller
{
    public function index()
    {
        $pageTitle = "Cart";
        return view('frontend.my-cart.index', compact('pageTitle'));
    }
}
