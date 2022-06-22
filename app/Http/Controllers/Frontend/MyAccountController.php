<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index()
    {
        $pageTitle = "My Account";
        return view('frontend.my-account.index', compact('pageTitle'));
    }
}
