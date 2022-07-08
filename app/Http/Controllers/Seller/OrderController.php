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
        $orders = Order::where('seller_approval', '!=', 4)->where('seller_id', Auth::guard('seller')->user()->id)->with('product')->paginate(5);
        return view('seller.order.index', compact('pageTitle', 'orders'));
    }
    public function approve($id)
    {
        $order = Order::find($id);
        $order->seller_approval = 1;
        $order->save();
        alert('Approved!', 'Order Request Accepted!', 'success');
        return redirect()->back();
    }
    public function reject($id)
    {
        $order = Order::find($id);
        $order->seller_approval = 2;
        $order->save();
        alert('Rejected!', 'Order Request Rejected!', 'error');
        return redirect()->back();
    }
    public function makeDelete($id)
    {
        $order = Order::find($id);
        $order->seller_approval = 4;
        $order->save();
        alert('Deleted!', 'Order Request Deleted!', 'error');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        alert('Deleted!', 'Order Request Deleted!', 'error');
        return redirect()->back();
    }
}
