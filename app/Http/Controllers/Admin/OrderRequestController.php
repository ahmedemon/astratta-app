<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class OrderRequestController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 1)->with('product', 'user', 'seller')->latest()->get()->unique('order_track_id');
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
                ->editColumn('rescript', function ($data) {
                    return '<a href="' . route('admin.order.rescript', $data->order_track_id) . '" class="approve btn btn-primary btn-sm" target="_blank"><i class="fas fa-receipt" style="font-size: 20px"></i>Rescript</a>';
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
                    if ($data->seller_approval == 5) {
                        $complete = '<a href="' . route('admin.order.complete', $data->id) . '" class="complete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to complete this product?')" . '">Complete</a>';
                    } else {
                        $complete = '<a href="javascript::void();" class="complete btn btn-info btn-sm" onClick="' . "return confirm('Waiting for sending product!')" . '">Complete</a>';
                    }
                    $delete = '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $complete . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'rescript', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Approved Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 0)->whereIn('seller_approval', [0, 1])->with('product', 'user', 'seller')->latest()->get()->unique(['order_track_id']);
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
                ->editColumn('rescript', function ($data) {
                    return '<a href="' . route('admin.order.rescript', $data->order_track_id) . '" class="approve btn btn-primary btn-sm" target="_blank"><i class="fas fa-receipt" style="font-size: 20px"></i>Rescript</a>';
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
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'rescript', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Requested Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function completed()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 2)->with('product', 'user', 'seller')->latest()->get()->unique('order_track_id')->unique('order_track_id');
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
                ->editColumn('rescript', function ($data) {
                    return '<a href="' . route('admin.order.rescript', $data->order_track_id) . '" class="approve btn btn-primary btn-sm" target="_blank"><i class="fas fa-receipt" style="font-size: 20px"></i>Rescript</a>';
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
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'rescript', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Solded Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Order::where('status', 3)->with('product', 'user', 'seller')->latest()->get()->unique('order_track_id')->unique('order_track_id');
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
                ->editColumn('rescript', function ($data) {
                    return '<a href="' . route('admin.order.rescript', $data->order_track_id) . '" class="approve btn btn-primary btn-sm" target="_blank"><i class="fas fa-receipt" style="font-size: 20px"></i>Rescript</a>';
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
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'rescript', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Solded Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }
    public function rejectedBySeller()
    {
        if (request()->ajax()) {
            $data = Order::whereIn('status', [0, 1, 3])->where('seller_approval', 4)->with('product', 'user', 'seller')->latest()->get()->unique('order_track_id');
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
                ->editColumn('rescript', function ($data) {
                    return '<a href="' . route('admin.order.rescript', $data->order_track_id) . '" class="approve btn btn-primary btn-sm" target="_blank"><i class="fas fa-receipt" style="font-size: 20px"></i>Rescript</a>';
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
                    if ($data->seller_approval == 4) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $delete = '<a href="' . route('admin.order.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $delete;
                })
                ->rawColumns(['action', 'seller_id', 'user_id', 'category', 'rescript', 'status', 'order_track_id', 'total_cost', 'coupon_code'])
                ->make(true);
        }
        $pageTitle = "Seller Rejected Orders";
        return view('admin.orders.index', compact('pageTitle'));
    }


    public function approve($id)
    {
        $findorder = Order::find($id);
        $orders = Order::where('order_track_id', $findorder->order_track_id)->get();
        foreach ($orders as $order) {
            $order->status = 1;
            $order->save();
        }
        toastr()->success('Order approved successfully!');
        return redirect()->back();
    }
    public function complete($id)
    {
        $findorder = Order::find($id);
        $orders = Order::where('order_track_id', $findorder->order_track_id)->get();
        foreach ($orders as $order) {
            $order->status = 2;
            $order->buyer_approval = 1;
            $order->seller_approval = 3;
            $order->save();
        }
        toastr()->success('Order Completed successfully!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $findorder = Order::find($id);
        $orders = Order::where('order_track_id', $findorder->order_track_id)->get();
        foreach ($orders as $order) {
            $order->status = 3;
            $order->save();
        }
        toastr()->warning('Order rejected successfully!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $order = Order::find($id);
        $findorder = Order::find($id);
        $orders = Order::where('order_track_id', $findorder->order_track_id)->get();
        foreach ($orders as $order) {
            $order->status = 0;
            $order->save();
        }
        toastr()->info('Order recalled successfully!');
        return redirect()->back();
    }

    public function rescript($order_track_id)
    {
        $collection = Order::where('order_track_id', $order_track_id);
        $total = $collection->sum('product_price');
        $orders = $collection->get();
        $order = $collection->first();
        $pageTitle = "Rescript " . $order_track_id;
        return view('admin.orders.rescript', compact('pageTitle', 'orders', 'order', 'total'));
    }
    public function destroy($id)
    {
        $findorder = Order::find($id);
        $orders = Order::where('order_track_id', $findorder->order_track_id)->get();
        foreach ($orders as $order) {
            $order->delete();
        }
        toastr()->error('Order deleted successfully!');
        return redirect()->back();
    }
}
