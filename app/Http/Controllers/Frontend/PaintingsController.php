<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShortingRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaintingsController extends Controller
{
    public function index()
    {
        $paintings = Product::where('status', 1)->where('is_purchased', 0)->latest()->paginate(24);
        $shorting_ranges = ShortingRange::where('status', 1)->get();
        $pageTitle = "Paintings";
        return view('frontend.paintings.paintings', compact('pageTitle', 'paintings', 'shorting_ranges'));
    }

    public function show($id)
    {
        $painting = Product::find($id);
        $order = Order::where('product_id', $painting->id)->first();
        // if ($painting->is_purchased == 1) {
        //     if (!Auth::guard('web')->check() ?? $order->user_id != Auth::user()->id) {
        //         alert('Stock Out!', 'That product has been sold!', 'warning');
        //         return redirect()->back();
        //     }
        // }
        $relatedProducts = Product::where('status', 1)->where('is_purchased', 0)->where('category_id', $painting->category_id)->take(3)->get();
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
            ->latest()->paginate(24);
        $shorting_ranges = ShortingRange::where('status', 1)->get();
        $pageTitle = "Result of " . '"' . $key . '"';
        return view('frontend.paintings.search-result', compact('pageTitle', 'key', 'paintings', 'shorting_ranges'));
    }

    public function shortBy($start, $end)
    {
        $start = $start;
        $end = $end;
        $paintings = Product::where('status', 1)->with('category')->where('is_purchased', 0)->whereBetween('product_price', [$start, $end])->latest()->paginate(24);
        $shorting_ranges = ShortingRange::where('status', 1)->get();
        $pageTitle = "Price range " . '"' . intval($start) . ' to ' . intval($end) . '"';
        return view('frontend.paintings.search-result', compact('pageTitle', 'start', 'end', 'paintings', 'shorting_ranges'));
    }

    public function newest()
    {
        $paintings = Product::where('status', 1)->with('category')->where('is_purchased', 0)->latest()->paginate(24);
        $shorting_ranges = ShortingRange::where('status', 1)->get();
        $pageTitle = "Showing New Paintings";
        return view('frontend.paintings.search-result', compact('pageTitle', 'paintings', 'shorting_ranges'));
    }
    public function oldest()
    {
        $paintings = Product::where('status', 1)->with('category')->where('is_purchased', 0)->paginate(24);
        $shorting_ranges = ShortingRange::where('status', 1)->get();
        $pageTitle = "Showing Old Paintings";
        return view('frontend.paintings.search-result', compact('pageTitle', 'paintings', 'shorting_ranges'));
    }
}
