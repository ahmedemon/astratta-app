<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->redirectTo = RouteServiceProvider::HOME;
        $this->middleware('seller.guest')->except('logout');
    }
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            alert('Please Login First!', '', 'info');
            return redirect()->route('login');
        }
        $pageTitle = "My Account";
        $orders = Order::where('user_id', Auth::user()->id)->with('orderItems')->paginate(8);
        return view('frontend.my-account.index', compact('pageTitle', 'orders'));
    }
}
