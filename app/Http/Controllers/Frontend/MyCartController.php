<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

        // // my location
        // $json = file_get_contents('https://geolocation-db.com/json');
        // $location = json_decode($json);
        // // my location
        return view('frontend.my-cart.index', compact('pageTitle', 'cartItems'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if ($product->is_purchased == 1) {
            alert('Stock Out!', 'This product has veen sold!', 'warning');
            return redirect()->back();
        }
        if (Auth::guard('seller')->check()) {
            alert('Warning!', 'Please login from a buyer account!');
            return redirect()->back();
        }
        if (Auth::guard('web')->check()) {
            $check = MyCart::where('product_id', $id)->where('buyer_id', Auth::user()->id)->count();
            if ($check > 0) {
                alert('Note!', 'You`ve already added to your cart!', 'info');
                return redirect()->back();
            }
            MyCart::create([
                'product_id' => $id,
                'buyer_id' => Auth::user()->id,
                'guest_id' => null,
            ]);
        }


        $check = MyCart::where('product_id', $id)->where('guest_id', Auth::guest())->count();
        if ($check > 0) {
            alert('Note!', 'You`ve already added to your cart!', 'info');
            return redirect()->back();
        }
        MyCart::create([
            'product_id' => $id,
            'buyer_id' => null,
            'guest_id' => Auth::guest(),
        ]);
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
