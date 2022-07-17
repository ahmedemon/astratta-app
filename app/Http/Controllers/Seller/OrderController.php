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
        $orders = Order::where('status', '!=', 0)->where('seller_approval', '!=', 4)->where('is_refunded', null)->where('seller_id', Auth::guard('seller')->user()->id)->with('product')->paginate(5);
        $count = $orders->count('order_track_id');
        return view('seller.order.index', compact('pageTitle', 'orders', 'count'));
    }
    public function approve($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 1;
            $order->save();
        }
        alert('Approved!', 'Order Request Accepted!', 'success');
        return redirect()->back();
    }
    public function reject($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 2;
            $order->save();
        }
        alert('Rejected!', 'Order Request Rejected!', 'error');
        return redirect()->back();
    }
    public function sent($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 5;
            $order->save();
        }
        alert('Sending!', 'Order sending to the buyer!', 'info');
        return redirect()->back();
    }
    public function makeDelete($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 4;
            $order->save();
        }
        alert('Deleted!', 'Order Request Deleted!', 'error');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->delete();
        }
        alert('Deleted!', 'Order Request Deleted!', 'error');
        return redirect()->back();
    }
}
