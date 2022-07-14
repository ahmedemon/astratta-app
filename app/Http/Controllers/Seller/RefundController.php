<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    public function index()
    {
        $pageTitle = "Refund Request";
        $orders = Order::where('is_refunded', '!=', null)->where('seller_id', Auth::guard('seller')->user()->id)->with('product')->paginate(5);
        $count = Order::groupBy('order_track_id')->count('order_track_id');
        return view('seller.order.refunded', compact('pageTitle', 'orders', 'count'));
    }

    public function approve($id)
    {
        $order = Order::find($id);
        $refund = Refund::where('order_id', $order->order_track_id)->first();
        $refund->seller_approval = 1;
        $refund->save();
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->is_refunded = 1;
            $order->save();
        }
        alert('Approved!', 'Refund Request Accepted!', 'success');
        return redirect()->back();
    }
    public function reject($id)
    {
        $order = Order::find($id);
        $refund = Refund::where('order_id', $order->order_track_id)->first();
        $refund->seller_approval = 2;
        $refund->save();
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 2;
            $order->save();
        }
        alert('Rejected!', 'Refund Request Rejected!', 'error');
        return redirect()->back();
    }
    public function makeDelete($id)
    {
        $order = Order::find($id);
        $refund = Refund::where('order_id', $order->order_track_id)->first();
        $refund->seller_approval = 4;
        $refund->save();
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->seller_approval = 4;
            $order->save();
        }
        alert('Deleted!', 'Refund Request Deleted!', 'error');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $refund = Refund::where('order_id', $order->order_track_id)->first();
        $refund->delete();
        $orders = Order::where('order_track_id', $order->order_track_id)->get();
        foreach ($orders as $order) {
            $order->delete();
        }
        alert('Deleted!', 'Refund Request Deleted!', 'error');
        return redirect()->back();
    }
}
