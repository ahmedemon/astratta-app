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
            $data = Order::where('status', 1)->whereIn('seller_approval', [1, 4])->with('product', 'user', 'seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('user_id', function ($data) {
                    $name = $data->user->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->user->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->product->main_image ? '<img width="100" height="140" src="' . asset('storage/products/' . $data->product->main_image) . '">' : '<img width="100" height="140" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('order_track_id', function ($data) {
                    return '#' . $data->order_track_id ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('total_cost', function ($data) {
                    $total_cost = intval($data->total_cost);
                    return '$' . $total_cost ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->product->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('order_date', function ($data) {
                    return $data->created_at->format('M-d-Y');
                })
                ->editColumn('coupon_code', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->coupon_code ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $complete = '<a href="' . route('admin.order.complete', $data->id) . '" class="complete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to complete this product?')" . '">Complete</a>';
                    $delete = '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $complete . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'product_main_image', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Approved Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 0)->whereIn('seller_approval', [1, 4])->with('product', 'user', 'seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('user_id', function ($data) {
                    $name = $data->user->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->user->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->product->main_image ? '<img width="100" height="140" src="' . asset('storage/products/' . $data->product->main_image) . '">' : '<img width="100" height="140" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('order_track_id', function ($data) {
                    return '#' . $data->order_track_id ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('total_cost', function ($data) {
                    $total_cost = intval($data->total_cost);
                    return '$' . $total_cost ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->product->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('coupon_code', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->coupon_code ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $approve = '<a href="' . route('admin.order.approve', $data->id) . '" class="approve btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to approve this product?')" . '">Approve</a>';
                    $reject = '<a href="' . route('admin.order.reject', $data->id) . '" class="reject btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to reject this product?')" . '">Reject</a>';
                    $delete = '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $approve . ' ' . $reject . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'product_main_image', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Requested Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function completed()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 2)->whereIn('seller_approval', [1, 4])->with('product', 'user', 'seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('user_id', function ($data) {
                    $name = $data->user->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->user->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->product->main_image ? '<img width="100" height="140" src="' . asset('storage/products/' . $data->product->main_image) . '">' : '<img width="100" height="140" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('order_track_id', function ($data) {
                    return '#' . $data->order_track_id ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('total_cost', function ($data) {
                    $total_cost = intval($data->total_cost);
                    return '$' . $total_cost ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->product->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('coupon_code', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->coupon_code ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'product_main_image', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Solded Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 3)->whereIn('seller_approval', [1, 4])->with('product', 'user', 'seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('user_id', function ($data) {
                    $name = $data->user->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->user->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('product_main_image', function ($data) {
                    return $data->product->main_image ? '<img width="100" height="140" src="' . asset('storage/products/' . $data->product->main_image) . '">' : '<img width="100" height="140" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('order_track_id', function ($data) {
                    return '#' . $data->order_track_id ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('total_cost', function ($data) {
                    $total_cost = intval($data->total_cost);
                    return '$' . $total_cost ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('category', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->product->category->name ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('coupon_code', function ($data) {
                    return '<span class="btn btn-sm btn-info">' . $data->coupon_code ?? 'Not Updated Yet' . '</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Processing</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $recall = '<a href="' . route('admin.order.recall', $data->id) . '" class="recall btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to recycle this product?')" . '">Recycle</a>';
                    $delete = '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $recall . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'product_main_image', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Solded Orders";
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
    public function complete($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        toastr()->success('Order Completed successfully!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $order = Order::find($id);
        $order->status = 3;
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
