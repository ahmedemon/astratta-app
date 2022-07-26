<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMailer;
use App\Models\Coupon;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Notifications\OrderNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;
use Omnipay\Omnipay;

class CheckoutController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
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

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {

                $arr = $response->getData();

                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];

                $payment->save();

                include('PlaceOrder.php');
                $buyer = $user ?? $newuser;
                if ($order) {
                    Mail::to($buyer->email)->send(new OrderMailer($order, $buyer));
                }
                alert('Order Complete!', 'Your order has been placed!', 'success');
                return redirect()->route('checkout.completed', [Crypt::encrypt($order)])->with('success', "Payment is Successfull. Your Transaction Id is : " . $arr['id']);
            } else {
                return $response->getMessage();
            }
        } else {
            alert('Error!', 'Payment declined!!!', 'error');
            return redirect()->back();
        }
    }

    public function placeOrder(Request $request)
    {
        foreach ($request->items as $key => $item) {
            $product = Product::find($item['product_id']);
            if ($product->is_purchased == 1) {
                alert('Stock Out!', 'You have selected a product that is already sold!', 'warning');
                return redirect()->route('painting.index');
            }
        }

        $order_track_id = mt_rand(100000, 999999);
        $total  = Crypt::decrypt($request->total_cost);
        $method_id = Crypt::decrypt($request->method_id);

        if ($method_id == 1) {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $charge = Charge::create([
                    "amount" => round($total * 100),
                    "currency" => "USD",
                    "source" => $request->stripeToken,
                    "description" => "Order Tracking No: #" . $order_track_id,
                ]);
                include('PlaceOrder.php');
            } catch (\Throwable $th) {
                alert('Error!', $th->getMessage(), 'error');
                return redirect()->back();
            }
        } elseif ($method_id == 2) {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->amount,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => route('checkout.success'),
                    'cancelUrl' => route('checkout.checkout')
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect();
                } else {
                    alert('Error!', $response->getMessage(), 'error');
                    return redirect()->back();
                }
            } catch (\Throwable $th) {
                alert('Error!', $th->getMessage(), 'error');
                return redirect()->back();
            }
        } else {
            return 'none';
        }
        if ($method_id == 1) {
            $buyer = $user ?? $newuser;
            if ($order) {
                Mail::to($buyer->email)->send(new OrderMailer($order, $buyer));
            }
            alert('Order Complete!', 'Your order has been placed!', 'success');
            return redirect()->route('checkout.completed', [Crypt::encrypt($order)]);
        }
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
