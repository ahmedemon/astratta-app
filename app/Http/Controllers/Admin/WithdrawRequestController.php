<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe\Charge;
use Stripe\Payout;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Transfer;
use Yajra\DataTables\DataTables;

class WithdrawRequestController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = Withdraw::where('status', 1)->with('seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('account_number', function ($data) {
                    if ($data->stripe_id == !null) {
                        $account_number = $data->stripe_id;
                        return $account_number;
                    }
                    if ($data->paypal_id == !null) {
                        $account_number = $data->paypal_id;
                        return $account_number;
                    }
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
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
                    $complete = '
                        <a href="' . route('admin.withdraw.complete', $data->id) . '" class="complete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to payout this request?')" . '">Complete</a>
                    ';
                    $delete = '<a href="' . route('admin.withdraw.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this request?')" . '">Delete</a>';
                    return $complete . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'method_id', 'status', 'account_number'])
                ->make(true);
        }
        $pageTitle = "Approved Withdraws";
        return view('admin.withdraw-request.index', compact('pageTitle'));
    }
    public function requested()
    {
        if (request()->ajax()) {
            $data = Withdraw::where('status', 0)->with('seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('account_number', function ($data) {
                    if ($data->stripe_id == !null) {
                        $account_number = $data->stripe_id;
                        return $account_number;
                    }
                    if ($data->paypal_id == !null) {
                        $account_number = $data->paypal_id;
                        return $account_number;
                    }
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
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
                    $approve = '<a href="' . route('admin.withdraw.approve', $data->id) . '" class="approve btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to approve this request?')" . '">Approve</a>';
                    $reject = '<a href="' . route('admin.withdraw.reject', $data->id) . '" class="reject btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to reject this request?')" . '">Reject</a>';
                    $delete = '<a href="' . route('admin.withdraw.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this request?')" . '">Delete</a>';
                    return $approve . ' ' . $reject . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'method_id', 'status', 'account_number'])
                ->make(true);
        }
        $pageTitle = "Requested Withdraws";
        return view('admin.withdraw-request.index', compact('pageTitle'));
    }
    public function completed()
    {
        if (request()->ajax()) {
            $data = Withdraw::where('status', 2)->with('seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('account_number', function ($data) {
                    if ($data->stripe_id == !null) {
                        $account_number = $data->stripe_id;
                        return $account_number;
                    }
                    if ($data->paypal_id == !null) {
                        $account_number = $data->paypal_id;
                        return $account_number;
                    }
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
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
                    return '<a href="' . route('admin.withdraw.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this request?')" . '">Delete</a>';
                })
                ->rawColumns(['action', 'seller_id', 'method_id', 'status', 'account_number'])
                ->make(true);
        }
        $pageTitle = "Solded Withdraws";
        return view('admin.withdraw-request.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Withdraw::where('status', 3)->with('seller')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('seller_id', function ($data) {
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('account_number', function ($data) {
                    if ($data->stripe_id == !null) {
                        $account_number = $data->stripe_id;
                        return $account_number;
                    }
                    if ($data->paypal_id == !null) {
                        $account_number = $data->paypal_id;
                        return $account_number;
                    }
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>';
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Pending</span>';
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
                    $recall = '<a href="' . route('admin.withdraw.recall', $data->id) . '" class="recall btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to recycle this request?')" . '">Recycle</a>';
                    $delete = '<a href="' . route('admin.withdraw.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this request?')" . '">Delete</a>';
                    return $recall . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'method_id', 'status', 'account_number'])
                ->make(true);
        }
        $pageTitle = "Solded Withdraws";
        return view('admin.withdraw-request.index', compact('pageTitle'));
    }


    public function approve($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 1;
        $withdraw->save();
        toastr()->success('Withdraw request approved successfully!');
        return redirect()->route('admin.withdraw.index');
    }
    public function complete($id)
    {
        $withdraw = Withdraw::find($id);
        $total = intval($withdraw->amount);
        if ($withdraw->method_id == 2) {
            try {
                // $transfer = new StripeClient(
                //     env('STRIPE_SECRET')
                // );
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $transfer = Transfer::create([
                    'amount' => $total,
                    'currency' => 'USD',
                    'destination' => $withdraw->stripe_id,
                    'transfer_group' => $withdraw->id,
                ]);
            } catch (\Throwable $th) {
                toastr()->error('Something went wrong! ' . $th . '', 'Error!');
                return redirect()->back();
            }
        }
        $withdraw->status = 2;
        $withdraw->charge_id = $transfer->id;
        $withdraw->save();
        toastr()->success('Withdraw request Completed successfully!');
        return redirect()->route('admin.withdraw.completed');
    }

    public function reject($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 3;
        $withdraw->save();
        toastr()->warning('Withdraw request rejected successfully!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 0;
        $withdraw->save();
        toastr()->info('Withdraw request recalled successfully!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->delete();
        toastr()->error('Withdraw request deleted successfully!');
        return redirect()->back();
    }
}
