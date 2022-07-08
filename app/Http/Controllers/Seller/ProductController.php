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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)->latest()->paginate(4);
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

        if ($request->has('main_image')) {
            $input = $request->all();
            $parts = explode(";base64,", $input['base64image1']);
            $type_aux = explode("image/", $parts[0]);
            $type = $type_aux[1];
            $image_base64 = base64_decode($parts[1]);

            // file naming convension
            $separator = '-';
            $prefix = 'main-product-';
            $postfix = '';
            $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
            // file naming convension

            if ($product->image != null) {
                Storage::disk('product')->delete($product->image);
            }
            Storage::disk('product')->put($filename, $image_base64);

            $product->main_image = $filename;
        }

        $product->save();

        $image_array = array_filter($request['base64image']);
        if (count($image_array) > 0) {
            if (isset($request->base64image) && count($request->base64image) > 0) {
                foreach ($request['base64image'] as $img) {
                    $product_image = new ProductImage();
                    $parts = explode(";base64,", $img);
                    $type_aux = explode("image/", $parts[0]);
                    $type = $type_aux[1];
                    $image_base64 = base64_decode($parts[1]);

                    // file naming convension
                    $separator = '-';
                    $prefix = 'product-';
                    $postfix = '';
                    $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
                    // file naming convension

                    if ($product_image->image != null) {
                        Storage::disk('product')->delete($product_image->image);
                    }
                    Storage::disk('product')->put($filename, $image_base64);
                    $product_image->product_id = $product->id;
                    $product_image->image = $filename;
                    $product_image->save();
                }
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
        $product->category_id = $request->category_id;
        $product->tags = json_encode($request->tags);
        $product->about_this_paint = $request->about_this_paint;
        $product->details_1 = $request->details_1;
        $product->details_2 = $request->details_2;

        if ($request->has('main_image')) {
            $input = $request->all();
            $parts = explode(";base64,", $input['base64image1']);
            $type_aux = explode("image/", $parts[0]);
            $type = $type_aux[1];
            $image_base64 = base64_decode($parts[1]);

            // file naming convension
            $separator = '-';
            $prefix = 'main-product-';
            $postfix = '';
            $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
            // file naming convension

            if ($product->main_image) {
                Storage::disk('product')->delete($product->main_image);
            }
            Storage::disk('product')->put($filename, $image_base64);

            $product->main_image = $filename;
        }
        $product->save();

        $image_array = array_filter($request['base64image']);
        if (count($image_array) < 0) {
            if (isset($request->base64image) && count($request->base64image) > 0) {
                foreach ($request['base64image'] as $key => $img) {
                    $product_images = ProductImage::where('product_id', $product->id)->get();
                    foreach ($product_images as $product_image) {
                        $parts = explode(";base64,", $img);
                        $type_aux = explode("image/", $parts[0]);
                        $type = $type_aux[1];
                        $image_base64 = base64_decode($parts[1]);

                        // file naming convension
                        $separator = '-';
                        $prefix = 'product-';
                        $postfix = '';
                        $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
                        // file naming convension

                        if ($product_image->image) {
                            Storage::disk('product')->delete($product_image->image);
                        }
                        Storage::disk('product')->put($filename, $image_base64);
                        $product_image->image = $filename;
                        $product_image->save();
                    }
                }
            }
        }

        $product->save();
        if (isset($request->tags) && count($request->tags) > 0) {
            foreach ($request->tags as $tag) {
                $product->tags()->update([
                    'product_id'  => $product->id,
                    'name'  => $tag,
                ]);
            }
        }
        alert('Success!', 'Product updated successfully!', 'success');
        return redirect()->route('seller.product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product_images = ProductImage::where('product_id', $product->id)->get();
        foreach ($product_images as $image) {
            if ($image->image) {
                Storage::disk('product')->delete($image->image);
            }
        }
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
