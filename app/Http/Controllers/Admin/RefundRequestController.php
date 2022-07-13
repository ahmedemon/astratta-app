<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RefundRequestController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Refund::where('seller_approval', 1)->where('status', 1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->user->name ?? '---';
                })
                ->editColumn('reason_id', function ($data) {
                    return $data->reason->reason ?? '---';
                })
                ->editColumn('order_id', function ($data) {
                    return '#' . $data->order_id;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $delete = '<a href="' . route('admin.refund.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    $complete = '<a href="' . route('admin.refund.complete', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to complete this product?')" . '">Complete</a>';
                    return $complete . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Completed Refunds";
        return view('admin.refunds.index', compact('pageTitle'));
    }
    public function completed()
    {
        if (request()->ajax()) {
            $data = Refund::where('seller_approval', 1)->where('status', 3)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->user->name ?? '---';
                })
                ->editColumn('reason_id', function ($data) {
                    return $data->reason->reason ?? '---';
                })
                ->editColumn('order_id', function ($data) {
                    return '#' . $data->order_id;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $delete = '<a href="' . route('admin.refund.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Completed Refunds";
        return view('admin.refunds.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Refund::where('seller_approval', 1)->where('status', 0)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->user->name ?? '---';
                })
                ->editColumn('reason_id', function ($data) {
                    return $data->reason->reason ?? '---';
                })
                ->editColumn('order_id', function ($data) {
                    return '#' . $data->order_id;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $approve = '<a href="' . route('admin.refund.approve', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to approve this category?')" . '">Approve</a>';
                    $reject = '<a href="' . route('admin.refund.reject', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to reject this category?')" . '">Reject</a>';
                    $delete = '<a href="' . route('admin.refund.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $approve . ' ' . $reject . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Requested Refunds";
        return view('admin.refunds.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Refund::where('seller_approval', 1)->where('status', 2)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function ($data) {
                    return $data->user->name ?? '---';
                })
                ->editColumn('reason_id', function ($data) {
                    return $data->reason->reason ?? '---';
                })
                ->editColumn('order_id', function ($data) {
                    return '#' . $data->order_id;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Approved</span>';
                    }
                    if ($data->status == 2) {
                        return '<span class="btn btn-sm btn-danger">Rejected</span>';
                    }
                    if ($data->status == 3) {
                        return '<span class="btn btn-sm btn-info">Completed</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $recall = '<a href="' . route('admin.refund.recall', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to recycle this category?')" . '">Recycle</a>';
                    $delete = '<a href="' . route('admin.refund.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $recall . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Rejected Refunds";
        return view('admin.refunds.index', compact('pageTitle'));
    }
    public function approve($id)
    {
        $refund = Refund::find($id);
        $refund->status = 1;
        $refund->save();
        toastr()->success('Refund Request approved!', 'Success!');
        return redirect()->back();
    }
    public function complete($id)
    {
        $refund = Refund::find($id);
        $refund->status = 3;

        $orders = Order::where('order_track_id', $refund->order_id)->get();
        foreach ($orders as $order) {
            $order->is_refunded = 3;
            $order->save();
        }
        $refund->save();
        toastr()->success('Refund Completed!', 'Succeed!');
        return redirect()->back();
    }

    public function reject($id)
    {
        $refund = Refund::find($id);
        $refund->status = 2;
        $orders = Order::where('order_track_id', $refund->order_id)->get();
        foreach ($orders as $order) {
            $order->is_refunded = 0;
            $order->save();
        }
        $refund->save();
        toastr()->warning('Refund Request rejected!', 'Warning!');
        return redirect()->back();
    }

    public function recall($id)
    {
        $refund = Refund::find($id);
        $refund->status = 0;
        $refund->save();
        toastr()->info('Refund Request recalled!', 'Info!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $refund = Refund::find($id);
        $refund->delete();
        toastr()->error('Refund request deleted!', 'Deleted!');
        return redirect()->back();
    }
}
