<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
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
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
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
                    if ($data->method_id == 1) {
                        $form = '';
                    }
                    if ($data->method_id == 2) {
                        $form = '
                            <div class="card card-body">
                                <form action="' . route('admin.withdraw.complete', $data->id) . '" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="' . env('STRIPE_KEY') . '" id="payment-form">
                                ' . csrf_field() . '
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 form-group required text-left">
                                            <label class="control-label">Name on Card</label>
                                            <input type="text" class="form-control" size="4" type="text" value="Test">
                                        </div>
                                        <div class="col-xs-12 col-md-6 form-group required text-left">
                                            <label class="control-label">Card Number</label>
                                            <input autocomplete="off" class="form-control card-number" size="20" type="tel" value="4242424242424242">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group cvc required text-left">
                                            <label class="control-label">CVC</label>
                                            <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="number" value="311">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group expiration required text-left">
                                            <label class="control-label">Expiration Month</label>
                                            <input class="form-control card-expiry-month" placeholder="MM" size="2" type="number" value="02">
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group expiration required text-left">
                                            <label class="control-label">Expiration Year</label>
                                            <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="number" value="2023">
                                        </div>
                                        <button class="btn btn-sm btn-primary w-100">Submit</button>
                                    </div>
                                </form>
                            </div>
                        ';
                    }
                    $modal = '
                            <div class="modal fade" id="withdrawModal' . $data->id . '" tabindex="-1" aria-labelledby="withdrawModal' . $data->id . 'Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="withdrawModal' . $data->id . 'Label">Send Money to "' . $data->seller->username . '"</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ' . $form . '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    $complete = '
                        <a href="javascript:void();" class="complete btn btn-info btn-sm" data-toggle="modal" data-target="#withdrawModal' . $data->id . '">Complete</a>
                        ' . $modal . '
                    ';
                    $delete = '<a href="' . route('admin.withdraw.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this request?')" . '">Delete</a>';
                    return $complete . ' ' . $delete;
                })
                ->rawColumns(['action', 'seller_id', 'method_id', 'status'])
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
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
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
                ->rawColumns(['action', 'seller_id', 'method_id', 'status'])
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
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
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
                ->rawColumns(['action', 'seller_id', 'method_id', 'status'])
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
                    $name = $data->seller->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                    $username = '<small>(' . ($data->seller->username ?? '<span class="btn btn-sm btn-warning rounded-0">Not Updated</span>') . ')</small>';
                    return $name . ' ' . $username;
                })
                ->editColumn('method_id', function ($data) {
                    return $data->withdrawMethod->name ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
                })
                ->editColumn('amount', function ($data) {
                    $amount = intval($data->amount);
                    return '$' . $amount ?? '<span class="btn btn-sm btn-warning rounded-0">Not Selected</span>';
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
                ->rawColumns(['action', 'seller_id', 'method_id', 'status'])
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
    public function complete(Request $request, $id)
    {
        $withdraw = Withdraw::find($id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create([
            "amount" => round($withdraw->amount * 100),
            "currency" => "USD",
            "source" => $request->stripeToken,
            "description" => "Accepted withdraw request and send money to this (" . $withdraw->account_number . ") acount number",
        ]);
        $withdraw->status = 2;
        $withdraw->charge_id = $charge->id;
        $withdraw->save();
        toastr()->success('Withdraw request Completed successfully!');
        return redirect()->back();
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
