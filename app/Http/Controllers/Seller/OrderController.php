<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $pageTitle = "Orders";
        $orders = Order::with('orderItems')->paginate(5);
        return view('seller.order.index', compact('pageTitle', 'orders'));
    }
}
