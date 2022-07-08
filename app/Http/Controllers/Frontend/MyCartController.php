<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\MyCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCartController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            $items = MyCart::where('buyer_id', Auth::user()->id)->with('product');
        } else {
            $items = MyCart::where('guest_id', Auth::guest())->with('product');
        }
        $cartItems = $items->get();
        $pageTitle = "Cart";
        return view('frontend.my-cart.index', compact('pageTitle', 'cartItems'));
    }

    public function coupon_check()
    {
        if (request()->coupon_code) {
            $coupon_code = request()->coupon_code;
            $data = Coupon::where('code', $coupon_code)->where('is_active', 1)->count();
            if ($data > 0) {
                return "not_unique";
            } else {
                return "unique";
            }
        }
    }

    public function addToCart($id)
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

        // check user is logged in or not
        if (Auth::guard('web')->check()) {
            // add to cart for user
            $check = MyCart::where('product_id', $id)->where('buyer_id', Auth::user()->id)->count();
            if ($check > 0) {
                alert('Note!', 'You`ve already added to your cart!', 'info');
                return redirect()->back();
            }
            // add to cart for user
            MyCart::create([
                'product_id' => $id,
                'buyer_id' => Auth::user()->id,
                'guest_id' => null,
            ]);
        } else {
            // add to cart for guest
            $check = MyCart::where('product_id', $id)->where('guest_id', Auth::guest())->count();
            if ($check > 0) {
                alert('Note!', 'You`ve already added to your cart!', 'info');
                return redirect()->back();
            }
            // add to cart for guest
            MyCart::create([
                'product_id' => $id,
                'buyer_id' => null,
                'guest_id' => Auth::guest(),
            ]);
        }
        // check user is logged in or not
        toastr()->success('Product added to the cart!', 'Success!');
        return redirect()->back();
    }
    public function removeFromCart($id)
    {
        $cartItems = MyCart::find($id);
        $cartItems->delete();
        toastr()->error('Product removed from cart!', 'Success');
        return redirect()->back();
    }
}
