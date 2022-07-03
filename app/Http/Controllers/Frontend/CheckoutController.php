<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\CurrentBalance;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    public function buyNow($id)
    {
        $product = Product::find($id);
        if ($product->is_purchased) {
            alert('Stock Out!', 'This product has veen sold!', 'warning');
            return redirect()->back();
        }
        $product = Product::find($id);
        $productId = $product->id;
        $cartItemId = null;
        $items = array('1' => array('product_id' => $productId, 'cart_item_id' => $cartItemId));
        $coupon_code = null;
        $total_cost = $product->product_price;
        $pageTitle = "Checkout";
        return view('frontend.checkout.checkout', compact('items', 'coupon_code', 'total_cost', 'pageTitle'));
    }
    public function placeOrder(Request $request)
    {
        if (isset($request->items) && count($request->items) > 0) {
            $order_track_id = mt_rand(100000, 999999);
            foreach ($request->items as $key => $value) {
                $id = $value['product_id'];
                $my_cart = MyCart::where('product_id', $id)->first();
                $my_cart->delete();

                $product = Product::find($id);
                $product->is_purchased = 1;
                $product->save();

                $order = Order::create([
                    'user_id' => Auth::user()->id ?? Auth::guest(),
                    'seller_id' => $product->seller_id,
                    'product_id' => $value['product_id'],
                    'order_track_id' => $order_track_id,
                    'order_date' => date(now()),
                    'total_cost' => Crypt::decrypt($request->total_cost),
                    'method_id' => 1,
                ]);

                CurrentBalance::create([
                    'seller_id' => $product->seller_id,
                    'credit_amount' => $product->product_price,
                    'debit_amount' => null,
                    'note' => 'Order amount from ' . Auth::user()->name . '',
                    'trnx_id' => Str::random(16),
                ]);
            }
        }

        $this->validate($request, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'town_city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'post_or_zip' => ['required', 'string'],
        ]);

        $authCheck = Auth::guard('web')->check();
        if ($authCheck) {
            $user = User::find(Auth::user()->id);
            $user->name = Auth::user()->name ?? $request->first_name . ' ' . $request->last_name;
            $user->phone = $request->phone;
            $user->save();
        } else {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'username' => Str::slug($request->first_name . $request->last_name),
                'email' => $request->email,
                'phone' => $request->phone,
                'email_verified_at' => date(now()),
                'password' => Hash::make(Str::random(10)),
                'privacy_policy' => 1,
                'is_active' => 1,
                'is_approved' => 1,
                'is_blocked' => 0,
            ]);
        }
        if ($authCheck) {
            $hasBilling = BillingDetail::where('user_id', Auth::user()->id)->count();
            if ($hasBilling == 1) {
                $billing  = BillingDetail::find(Auth::user()->billing->id);
                $billing->first_name    = $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name;
                $billing->last_name     = $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name;
                $billing->phone         = $authCheck ? $request->phone : $request->phone;
                $billing->email         = $authCheck ? Auth::user()->email ?? $request->email : $request->email;
                $billing->country       = $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country;
                $billing->state         = $authCheck ? Auth::user()->billing->state ?? $request->state : $request->state;
                $billing->town_city     = $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country;
                $billing->street        = $authCheck ? Auth::user()->billing->street ?? $request->street :  $request->street;
                $billing->post_or_zip   = $authCheck ? Auth::user()->billing->post_or_zip ?? $request->post_or_zip : $request->post_or_zip;
                $billing->save();
            } else {
                BillingDetail::create([
                    'user_id'       => Auth::user()->id ?? $user->id,
                    'first_name'    => $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name,
                    'last_name'     => $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name,
                    'phone'         => $authCheck ? Auth::user()->phone ?? $request->phone : $request->phone,
                    'email'         => $authCheck ? Auth::user()->email ?? $request->email : $request->email,
                    'country'       => $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country,
                    'state'         => $authCheck ? Auth::user()->billing->state ?? $request->state : $request->state,
                    'town_city'     => $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country,
                    'street'        => $authCheck ? Auth::user()->billing->street ?? $request->street :  $request->street,
                    'post_or_zip'   => $authCheck ? Auth::user()->billing->post_or_zip ?? $request->post_or_zip : $request->post_or_zip,
                ]);
            }
        } else {
            BillingDetail::create([
                'user_id'       => Auth::user()->id ?? $user->id,
                'first_name'    => $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name,
                'last_name'     => $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name,
                'phone'         => $authCheck ? Auth::user()->phone ?? $request->phone : $request->phone,
                'email'         => $authCheck ? Auth::user()->email ?? $request->email : $request->email,
                'country'       => $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country,
                'state'         => $authCheck ? Auth::user()->billing->state ?? $request->state : $request->state,
                'town_city'     => $authCheck ? Auth::user()->billing->country ?? $request->country : $request->country,
                'street'        => $authCheck ? Auth::user()->billing->street ?? $request->street :  $request->street,
                'post_or_zip'   => $authCheck ? Auth::user()->billing->post_or_zip ?? $request->post_or_zip : $request->post_or_zip,
            ]);
        }

        if ($authCheck) {
            $hasShipping = ShippingDetail::where('user_id', Auth::user()->id)->count();
            if ($hasShipping == 1) {
                $shipping  = ShippingDetail::find(Auth::user()->shipping->id);
                $shipping->user_id       = Auth::user()->id ?? $user->id;
                $shipping->first_name    = $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name;
                $shipping->last_name     = $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name;
                $shipping->phone         = $authCheck ? $request->phone : $request->phone;
                $shipping->email         = $authCheck ? Auth::user()->email ?? $request->email : $request->email;
                $shipping->country       = $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country;
                $shipping->state         = $authCheck ? Auth::user()->shipping->state ?? $request->state : $request->state;
                $shipping->town_city     = $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country;
                $shipping->street        = $authCheck ? Auth::user()->shipping->street ?? $request->street :  $request->street;
                $shipping->post_or_zip   = $authCheck ? Auth::user()->shipping->post_or_zip ?? $request->post_or_zip : $request->post_or_zip;
                $shipping->save();
            } else {
                ShippingDetail::create([
                    'user_id'       => Auth::user()->id ?? $user->id,
                    'first_name'    => $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name,
                    'last_name'     => $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name,
                    'phone'         => $authCheck ? Auth::user()->phone ?? $request->phone : $request->phone,
                    'email'         => $authCheck ? Auth::user()->email ?? $request->email : $request->email,
                    'country'       => $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country,
                    'state'         => $authCheck ? Auth::user()->shipping->state ?? $request->state : $request->state,
                    'town_city'     => $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country,
                    'street'        => $authCheck ? Auth::user()->shipping->street ?? $request->street :  $request->street,
                    'post_or_zip'   => $authCheck ? Auth::user()->shipping->post_or_zip ?? $request->post_or_zip : $request->post_or_zip,
                ]);
            }
        } else {
            ShippingDetail::create([
                'user_id'       => Auth::user()->id ?? $user->id,
                'first_name'    => $authCheck ? strtok(Auth::user()->name, ' ') : $request->first_name,
                'last_name'     => $authCheck ? basename(str_replace(' ', '/', Auth::user()->name ?? $request->last_name,)) : $request->last_name,
                'phone'         => $authCheck ? Auth::user()->phone ?? $request->phone : $request->phone,
                'email'         => $authCheck ? Auth::user()->email ?? $request->email : $request->email,
                'country'       => $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country,
                'state'         => $authCheck ? Auth::user()->shipping->state ?? $request->state : $request->state,
                'town_city'     => $authCheck ? Auth::user()->shipping->country ?? $request->country : $request->country,
                'street'        => $authCheck ? Auth::user()->shipping->street ?? $request->street :  $request->street,
                'post_or_zip'   => $authCheck ? Auth::user()->shipping->post_or_zip ?? $request->post_or_zip : $request->post_or_zip,
            ]);
        }
        alert('Order Complete!', 'Your order has been placed!', 'success');
        return redirect()->route('checkout.completed', [Crypt::encrypt($order)]);
    }

    public function completed($order)
    {
        $sent_order = Crypt::decrypt($order);
        $order = Order::find($sent_order->id);
        $all_orders = Order::where('user_id', Auth::user()->id)->where('order_track_id', $sent_order->order_track_id)->get();
        $pageTitle = "Thank you!!";
        return view('frontend.checkout.thank-you', compact('pageTitle', 'all_orders', 'order'));
    }
}
