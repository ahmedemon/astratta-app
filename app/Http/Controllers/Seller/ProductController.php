<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
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
        $categories = Category::all();
        return view('seller.product.form', compact('pageTitle', 'tags', 'categories'));
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

    public function edit($id)
    {
        $pageTitle = "Edit paint";
        $tags = ProductTag::where('product_id', $id)->get();
        $product = Product::find($id);
        $categories = Category::all();
        return view('seller.product.edit', compact('pageTitle', 'tags', 'product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->seller_id = Auth::guard('seller')->user()->id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->category = $request->category;
        $product->tags = json_encode($request->tags);
        $product->about_this_paint = $request->about_this_paint;
        $product->details_1 = $request->details_1;
        $product->details_2 = $request->details_2;

        // not completed fully
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $images = ProductImage::where('product_id', $id)->get();
                foreach ($images as $image) {
                    $file = new FileManager();
                    $file->folder('products')->prefix('product')->update($img, $image->image);
                    $image->image = $file->getName();

                    $image->product_id = $product->id;
                    $image->save();
                }
            }
        }
        // not completed fully


        if (isset($request->tags) && count($request->tags) > 0) {
            foreach ($request->tags as $key => $tag) {
                $product->tags()->update([
                    'product_id'  => $product->id,
                    'name'  => $tag,
                ]);
            }
        }
        $product->save();
        toastr()->success('Success', 'Product added successfully!');
        alert('Success!', 'Product added successfully!', 'success');
        return redirect()->route('seller.product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        alert('Product Deleted Successfully!', '', 'success');
        return redirect()->back();
    }
}

// if ($request->hasFile('images')) {
//     $images = $request->file('images');

//     $upload->folder('donation')->prefix('images')->update($images, $donation->images);
//     $donation->images = $upload->getName();
// }
