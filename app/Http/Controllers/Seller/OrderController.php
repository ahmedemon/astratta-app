<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $pageTitle = "Orders";
        $orders = Order::where('seller_id', Auth::guard('seller')->user()->id)->with('product')->paginate(5);
        return view('seller.order.index', compact('pageTitle', 'orders'));
    }
}
