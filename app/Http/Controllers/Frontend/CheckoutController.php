<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\Coupon;
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
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (request()->total_cost == 0) {
            alert('Note!', 'You don`t have any item on your cart! Please select an item first!', 'info');
            return redirect()->back();
        }
        $items = request()->items;
        $code = request()->code;
        $total_cost = request()->total_cost;
        $pageTitle = "Checkout";
        if (request()->code != null) {
            $coupon = Coupon::where('code', $code);
            $couponData = $coupon->first();
            $count = $coupon->count();
            if ($count > 0) {
                $percentage = ($couponData->percentage / 100) * $total_cost;
                $total = $total_cost - $percentage;
            } else {
                $percentage = 0;
                $total = $total_cost;
            }
        } else {
            $percentage = 0;
            $total = $total_cost;
        }
        return view('frontend.checkout.checkout', compact('items', 'code', 'total', 'percentage', 'total_cost', 'pageTitle'));
    }
    public function buyNow($id)
    {
        $product = Product::find($id);
        $myCart = MyCart::where('product_id', $id);
        $has_item = $myCart->first();
        $count = $myCart->count();
        if ($count > 0) {
            if (!Auth::guard('web')->check()) {
                if (Auth::guest() == $has_item->guest_id) {
                    alert('Already Added!', 'This product is already added to your cart!', 'info');
                    return redirect()->back();
                }
            }
            if (Auth::guard('web')->check()) {
                if (Auth::user()->id == $has_item->buyer_id) {
                    alert('Already Added!', 'This product is already added to your cart!', 'info');
                    return redirect()->back();
                }
            }
            alert('Stock Out!', 'This product choose by another person!', 'warning');
            return redirect()->back();
        }
        // check if product is already purchased
        if ($product->is_purchased == 1) {
            alert('Stock Out!', 'This product has been sold!', 'warning');
            return redirect()->back();
        }
        // check if product is already purchased

        // check this is not a buyer account
        if (Auth::guard('seller')->check()) {
            alert('Warning!', 'Please login from a buyer account!');
            return redirect()->back();
        }
        // check this is not a buyer acacccount


        if ($product->is_purchased) {
            alert('Stock Out!', 'This product has veen sold!', 'warning');
            return redirect()->back();
        }
        $product = Product::find($id);
        $productId = $product->id;
        $cartItemId = null;
        $items = array('1' => array('product_id' => $productId, 'cart_item_id' => $cartItemId));
        $code = null;
        $total = $product->product_price;
        $total_cost = $product->product_price;
        $percentage = 0;
        $pageTitle = "Checkout";
        return view('frontend.checkout.checkout', compact('items', 'code', 'total', 'total_cost', 'percentage', 'pageTitle'));
    }
    public function placeOrder(Request $request)
    {
        $order_track_id = mt_rand(100000, 999999);
        $total  = Crypt::decrypt($request->total_cost);
        $method_id = Crypt::decrypt($request->method_id);

        if ($method_id == 1) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::create([
                "amount" => round($total * 100),
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Order Tracking No: #" . $order_track_id,
            ]);
        } elseif ($method_id == 2) {
            return 'paypal';
        } else {
            return 'none';
        }
        $authCheck = Auth::guard('web')->check();
        if ($authCheck) {
            $user = User::find(Auth::user()->id);
            $user->name = Auth::user()->name ?? $request->first_name . ' ' . $request->last_name;
            $user->phone = $request->phone;
            $user->save();
        } else {
            $newuser = User::create([
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
        if (isset($request->items) && count($request->items) > 0) {
            foreach ($request->items as $key => $value) {
                $id = $value['product_id'];
                if ($value['cart_item_id'] != null) {
                    if (Auth::guard('web')->check()) {
                        $my_cart = MyCart::where('product_id', $id)->where('buyer_id', Auth::user()->id)->first();
                        $my_cart->delete();
                    } else {
                        $my_cart = MyCart::where('product_id', $id)->where('guest_id', Auth::guest())->first();
                        $my_cart->delete();
                    }
                }

                $product = Product::find($id);
                $product->is_purchased = 1;
                $product->save();

                // if ($code != null) {
                //     $coupon = Coupon::where('is_active', 1)->where('code', $code)->first();
                //     $percentage = $coupon->percentage;
                // } else {
                //     $percentage = 0;
                // }

                // if ($code != 0) {
                //     $sub_amount = ($percentage / 100) * $total_cost;
                //     $amount = $total_cost - $sub_amount;
                // } else {
                //     $amount = Crypt::decrypt($request->total_cost);
                // }

                $code = Crypt::decrypt($request->code) ?? null;
                $total_cost = Crypt::decrypt($request->total_cost);

                $order = Order::create([
                    'user_id' => Auth::user()->id ?? $newuser->id,
                    'seller_id' => $product->seller_id,
                    'product_id' => $value['product_id'],
                    'order_track_id' => $order_track_id,
                    'order_date' => date(now()),
                    'product_price' => $product->product_price,
                    'total_cost' => $total_cost,
                    'coupon_code' => $code,
                    'method_id' => 1,
                    'guest_id' => $newuser->id ?? null,
                ]);

                CurrentBalance::create([
                    'seller_id' => $product->seller_id,
                    'credit_amount' => $product->product_price,
                    'debit_amount' => null,
                    'note' => 'Order amount',
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
                    'user_id'       => Auth::user()->id ?? $newuser->id,
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
                'user_id'       => Auth::user()->id ?? $newuser->id,
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
                $shipping->user_id       = Auth::user()->id ?? $newuser->id;
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
                    'user_id'       => Auth::user()->id ?? $newuser->id,
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
                'user_id'       => Auth::user()->id ?? $newuser->id,
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
        if (Auth::guard('seller')->check()) {
            $id = Auth::guard('seller')->user()->id;
            $all_orders = Order::where('seller_id', $id)->where('seller_id', $order->seller_id)->where('order_track_id', $sent_order->order_track_id)->get();
            $total = $all_orders->sum('product_price');
        }
        if (Auth::guard('web')->check()) {
            $id = Auth::user()->id;
            $all_orders = Order::where('user_id', $id)->where('seller_id', $order->seller_id)->where('order_track_id', $sent_order->order_track_id)->get();
            $total = $all_orders->sum('product_price');
        } else {
            $id = $order->guest_id;
            $all_orders = Order::where('guest_id', $id)->where('seller_id', $order->seller_id)->where('order_track_id', $sent_order->order_track_id)->get();
            $total = $all_orders->sum('product_price');
        }
        if (Auth::guard('seller')->check()) {
            $pageTitle = 'Order #' . $order->order_track_id;
        } else {
            $pageTitle = "Thank you!!";
        }
        return view('frontend.checkout.thank-you', compact('pageTitle', 'all_orders', 'order', 'total'));
    }
}
