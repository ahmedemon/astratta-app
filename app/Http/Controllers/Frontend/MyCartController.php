<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCartController extends Controller
{
    public function index()
    {
        $items = MyCart::where('buyer_id', Auth::user()->id)->with('product');
        $cartItems = $items->get();
        $pageTitle = "Cart";
        return view('frontend.my-cart.index', compact('pageTitle', 'cartItems'));
    }

    public function addToCart($id)
    {
        if (Auth::guard('seller')->check()) {
            alert('Warning!', 'Please login from a buyer account!');
            return redirect()->back();
        }
        $check = MyCart::where('product_id', $id)->where('buyer_id', Auth::user()->id)->count();
        if ($check > 0) {
            alert('Note!', 'You`ve already added to your cart!', 'info');
            return redirect()->back();
        }
        MyCart::create([
            'product_id' => $id,
            'buyer_id' => Auth::user()->id,
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
