<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)->with('productImages')->latest()->paginate(4);
        $pageTitle = "Products";
        return view('seller.product.index', compact('pageTitle', 'products'));
    }

    public function create()
    {
        $pageTitle = "Post a paint";
        $tags = ProductTag::all();
        return view('seller.product.form', compact('pageTitle', 'tags'));
    }

    public function store(ProductRequest $request)
    {

        $tags = $request->tags;
        $product = new Product($request->all());
        $product->seller_id = Auth::guard('seller')->user()->id;
        $product->tags = json_encode($tags);
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $image = new ProductImage();
                $file = new FileManager();
                $file->folder('products')->prefix('product')
                    ->postfix(Str::slug($request->product_name, '-'))
                    ->upload($img) ?
                    $image->image = $file->getName() : null;
                $image->product_id = $product->id;
                $image->save();
            }
        }

        if (isset($request->tags) && count($request->tags) > 0) {
            foreach ($request->tags as $key => $tag) {
                $product->tags()->create([
                    'product_id'  => $product->id,
                    'name'  => $tag,
                ]);
            }
        }
        toastr()->success('Success', 'Product added successfully!');
        alert('Success!', 'Product added successfully!', 'success');
        return redirect()->route('seller.product.index');
    }
}
// if ($request->hasFile('images')) {
//     $images = $request->file('images');

//     $upload->folder('donation')->prefix('images')->update($images, $donation->images);
//     $donation->images = $upload->getName();
// }
