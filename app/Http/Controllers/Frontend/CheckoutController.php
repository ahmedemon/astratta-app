<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Product;
use App\Models\ShippingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $items = request()->items;
        $coupon_code = request()->coupon_code;
        $total_cost = request()->total_cost;
        $pageTitle = "Checkout";
        return view('frontend.checkout.checkout', compact('items', 'coupon_code', 'total_cost', 'pageTitle'));
    }
    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_track_id' => mt_rand(1000000000, 9999999999),
            'order_date' => date(now()),
            'total_cost' => Crypt::decrypt($request->total_cost),
            'method_id' => 1,
        ]);
        if (isset($request->items) && count($request->items) > 0) {
            foreach ($request->items as $key => $value) {
                OrderedItem::create([
                    'order_id' => $order->id,
                    'product_id' => $value['product_id'],
                ]);

                MyCart::find($value['product_id'])->delete();
            }
        }
        BillingDetail::create([
            'order_id' => $order->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'state' => $request->state,
            'town_city' => $request->town_city,
            'street' => $request->street,
            'post_or_zip' => $request->post_or_zip,
        ]);
        ShippingDetail::create([
            'order_id' => $order->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'state' => $request->state,
            'town_city' => $request->town_city,
            'street' => $request->street,
            'post_or_zip' => $request->post_or_zip,
        ]);
        alert('Order Complete!', 'Your order has been placed!', 'success');
        return redirect()->route('checkout.completed', [Crypt::encrypt($order)]);
    }

    public function completed($order)
    {
        $order = Crypt::decrypt($order);
        $viewOrder = Order::find($order->id);
        $pageTitle = "Thank you!!";
        return view('frontend.checkout.thank-you', compact('pageTitle', 'viewOrder'));
    }
}
