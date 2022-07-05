<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaintingsController extends Controller
{
    public function index()
    {
        $paintings = Product::where('status', 1)->where('is_purchased', 0)->latest()->get();
        $pageTitle = "Paintings";
        return view('frontend.paintings.paintings', compact('pageTitle', 'paintings'));
    }

    public function show($id)
    {
        $painting = Product::find($id);
        $order = Order::where('product_id', $painting->id)->first();
        if ($painting->is_purchased == 1) {
            alert('Stock Out!', 'That product has been sold!', 'warning');
            return redirect()->route('painting.index');
        }
        $relatedProducts = Product::where('status', 1)->where('category_id', $painting->category_id)->take(3)->get();
        $pageTitle = $painting->product_name;
        return view('frontend.paintings.view-painting', compact('pageTitle', 'painting', 'relatedProducts'));
    }

    public function search()
    {
        $key = request()->search_key;
        $paintings = Product::where('status', 1)
            ->with('category')
            ->where('is_purchased', 0)
            ->where('product_name', 'LIKE', '%' . $key . '%')
            ->orWhere('product_price', 'LIKE', '%' . $key . '%')
            ->orWhere('tags', 'LIKE', '%' . $key . '%')
            // ->orWhereHas('category', function ($query) use ($key) {
            //     $query->where('status', 1)->where('name', 'like', $key . '%');
            // })
            ->latest()->get();
        $pageTitle = "Result of " . '"' . $key . '"';
        return view('frontend.paintings.search-result', compact('pageTitle', 'key', 'paintings'));
    }

    public function default()
    {
        $key = request()->search_key;
        $paintings = Product::where('status', 1)->with('category')->where('is_purchased', 0)->latest()->get();
        $pageTitle = "Result of " . '"' . $key . '"';
        return view('frontend.paintings.search-result', compact('pageTitle', 'key', 'paintings'));
    }
}
