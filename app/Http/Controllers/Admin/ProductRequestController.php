<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductRequestController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Product::where('status', 1)->where('is_purchased', 0)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    return $data->user->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->main_image ? '<img width="120" height="160" src="' . asset('storage/products/' . $data->main_image) . '">' : '<img width="120" height="160" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('product_price', function ($data) {
                    return '$' . $data->product_price ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="badge badge-info rounded-0">' . $data->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('tags', function ($data) {
                    return str_replace(['[', ']', '"'], ['', ','], $data->tags);
                })
                ->editColumn('about_this_paint', function ($data) {
                    return Str::limit($data->about_this_paint, 70, ' (...)');
                })
                ->editColumn('details_1', function ($data) {
                    return Str::limit($data->details_1, 70, ' (...)');
                })
                ->editColumn('details_2', function ($data) {
                    return Str::limit($data->details_2, 70, ' (...)');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="badge badge-danger rounded-0">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.product.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Products";
        return view('admin.products.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Product::where('status', 0)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    return $data->user->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->main_image ? '<img width="120" height="160" src="' . asset('storage/products/' . $data->main_image) . '">' : '<img width="120" height="160" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('product_price', function ($data) {
                    return '$' . $data->product_price ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="badge badge-info rounded-0">' . $data->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('tags', function ($data) {
                    return str_replace(['[', ']', '"'], ['', ','], $data->tags);
                })
                ->editColumn('about_this_paint', function ($data) {
                    return Str::limit($data->about_this_paint, 70, ' (...)');
                })
                ->editColumn('details_1', function ($data) {
                    return Str::limit($data->details_1, 70, ' (...)');
                })
                ->editColumn('details_2', function ($data) {
                    return Str::limit($data->details_2, 70, ' (...)');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="badge badge-danger rounded-0">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $approve = '<a href="' . route('admin.product.approve', $data->id) . '" class="edit btn btn-success btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to approve this product?')" . '">Approve</a>';
                    $reject = '<a href="' . route('admin.product.reject', $data->id) . '" class="edit btn btn-warning btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to reject this product?')" . '">Reject</a>';
                    return $approve . ' ' . $reject .  ' ' . '<a href="' . route('admin.product.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Requested Products";
        return view('admin.products.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Product::where('status', 2)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    return $data->user->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->main_image ? '<img width="120" height="160" src="' . asset('storage/products/' . $data->main_image) . '">' : '<img width="120" height="160" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('product_price', function ($data) {
                    return '$' . $data->product_price ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="badge badge-info rounded-0">' . $data->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('tags', function ($data) {
                    return str_replace(['[', ']', '"'], ['', ','], $data->tags);
                })
                ->editColumn('about_this_paint', function ($data) {
                    return Str::limit($data->about_this_paint, 70, ' (...)');
                })
                ->editColumn('details_1', function ($data) {
                    return Str::limit($data->details_1, 70, ' (...)');
                })
                ->editColumn('details_2', function ($data) {
                    return Str::limit($data->details_2, 70, ' (...)');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="badge badge-danger rounded-0">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $recall = '<a href="' . route('admin.product.recall', $data->id) . '" class="edit btn btn-info btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to recall this product?')" . '">Recall</a>';
                    return $recall .  ' ' . '<a href="' . route('admin.product.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Rejected Products";
        return view('admin.products.index', compact('pageTitle'));
    }
    public function soldOut()
    {
        if (request()->ajax()) {
            $data = Product::where('is_purchased', 1)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    return $data->user->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->main_image ? '<img width="120" height="160" src="' . asset('storage/products/' . $data->main_image) . '">' : '<img width="120" height="160" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('product_price', function ($data) {
                    return '$' . $data->product_price ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="badge badge-info rounded-0">' . $data->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('tags', function ($data) {
                    return str_replace(['[', ']', '"'], ['', ','], $data->tags);
                })
                ->editColumn('about_this_paint', function ($data) {
                    return Str::limit($data->about_this_paint, 70, ' (...)');
                })
                ->editColumn('details_1', function ($data) {
                    return Str::limit($data->details_1, 70, ' (...)');
                })
                ->editColumn('details_2', function ($data) {
                    return Str::limit($data->details_2, 70, ' (...)');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="badge badge-danger rounded-0">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.product.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Sold Out Products";
        return view('admin.products.index', compact('pageTitle'));
    }


    public function approve($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        toastr()->success('Product approved successfully!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $product = Product::find($id);
        $product->status = 2;
        $product->save();
        toastr()->warning('Product rejected successfully!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        toastr()->info('Product recalled successfully!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product_images = ProductImage::where('product_id', $product->id)->get();
        if ($product->main_image) {
            Storage::disk('product')->delete($product->main_image);
        }
        foreach ($product_images as $image) {
            if ($image->image) {
                Storage::disk('product')->delete($image->image);
            }
        }
        $product->delete();
        toastr()->error('Product deleted successfully!');
        return redirect()->back();
    }
}
