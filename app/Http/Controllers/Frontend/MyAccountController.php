<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use App\Models\RefundReason;
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
        $orders = Order::where('user_id', Auth::user()->id)->with('refund')->latest()->paginate(8);
        $count = $orders->count('seller_id');
        $reasons = RefundReason::where('status', 1)->get();
        return view('frontend.my-account.index', compact('pageTitle', 'orders', 'reasons', 'count'));
    }

    public function refundUpdate(Request $request, $id)
    {
        $findOrder = Order::where('order_track_id', $id)->first();
        $orderDate = $findOrder->created_at->format('ymd');
        $today = date('ymd');
        if ($orderDate < $today) {
            alert('Oops!', 'You can`t refund now! Refundable time is out!', 'info');
            return redirect()->back();
        }

        $refund = Refund::where('order_id', $id)->count();
        if ($refund > 0) {
            alert('Note!', 'You`ve already refund this order, please wait for the confirmation', 'info');
            return redirect()->back();
        }
        $orders = Order::where('order_track_id', $id)->get();
        foreach ($orders as $order) {
            $order = Order::find($order->id);
            $order->is_refunded = 1;
            $order->save();
        }
        Refund::create([
            'user_id' => Auth::user()->id,
            'seller_id' => $findOrder->seller_id,
            'order_id' => $id,
            'reason_id' => $request->reason_id,
        ]);
        alert('Info!', 'Your request has been sent to the administrator!', 'info');
        return redirect()->back();
    }

    public function gotTheProduct($id)
    {
        $orders = Order::where('order_track_id', $id)->get();
        foreach ($orders as $order) {
            $order = Order::find($order->id);
            $order->status = 2;
            $order->buyer_approval = 1;
            $order->seller_approval = 3;
            $order->save();
        }
        alert('Got The Product!', 'You`ve got your product, enjoy!', 'success');
        return redirect()->back();
    }
}
