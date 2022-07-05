<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class OrderRequestController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 1)->with('product')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('buyer', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
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
                    return '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'buyer', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        // order request is not completed
        $pageTitle = "Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 0)->with('product')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('buyer', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
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
                    $approve = '<a href="' . route('admin.order.approve', $data->id) . '" class="edit btn btn-success btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to approve this product?')" . '">Approve</a>';
                    $reject = '<a href="' . route('admin.order.reject', $data->id) . '" class="edit btn btn-warning btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to reject this product?')" . '">Reject</a>';
                    return $approve . ' ' . $reject .  ' ' . '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'buyer', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Requested Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 2)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('buyer', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
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
                    $recall = '<a href="' . route('admin.order.recall', $data->id) . '" class="edit btn btn-info btn-sm mb-1" onClick="' . "return confirm('Are you sure you want to recall this product?')" . '">Recall</a>';
                    return $recall .  ' ' . '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'buyer', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Rejected Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function soldOut()
    {
        if (request()->ajax()) {
            $data = Order::where('is_purchased', 1)->with('productImages', 'category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('buyer', function ($data) {
                    $name = $data->seller->name ?? '<span class="badge badge-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="badge badge-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
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
                    return '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller', 'buyer', 'category', 'product_main_image', 'tags', 'about_this_paint', 'details_1', 'details_2', 'status'])
                ->make(true);
        }
        $pageTitle = "Sold Out Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }


    public function approve($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        toastr()->success('Order approved successfully!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        toastr()->warning('Order rejected successfully!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $order = Order::find($id);
        $order->status = 0;
        $order->save();
        toastr()->info('Order recalled successfully!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        toastr()->error('Order deleted successfully!');
        return redirect()->back();
    }
}
