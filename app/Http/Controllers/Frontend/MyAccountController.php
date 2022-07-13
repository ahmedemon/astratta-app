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
        $reasons = RefundReason::where('status', 1)->get();
        return view('frontend.my-account.index', compact('pageTitle', 'orders', 'reasons'));
    }

    public function refundUpdate(Request $request, $id)
    {
        $orderCollection = Order::where('order_track_id', $id);
        $findOrder = $orderCollection->first();
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
        $orders = $orderCollection->get();
        foreach ($orders as $order) {
            $order = Order::find($order->id);
            $order->is_refunded = 1;
            $order->save();
        }
        Refund::create([
            'user_id' => Auth::user()->id,
            'order_id' => $id,
            'reason_id' => $request->reason_id,
        ]);
        alert('Info!', 'Your request has been sent to the administrator!', 'info');
        return redirect()->back();
    }
}
