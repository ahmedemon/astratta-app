<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewPainting;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SellerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Seller::where('is_approved', '!=', 0)->where('is_approved', '!=', 2)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('profile_image', function ($data) {
                    return $data->image ? '<img width="50" src="' . asset('storage/seller/' . $data->image) . '">' : '<img width="50" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('name', function ($data) {
                    return $data->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('username', function ($data) {
                    return $data->username ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('email', function ($data) {
                    return $data->email ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('phone', function ($data) {
                    return $data->phone ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('account_number', function ($data) {
                    return $data->account_number ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_active == 1) {
                        $activation = '<a href="' . route('admin.seller.deactive', $data->id) . '" class="edit btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this account?')" . '">Deactive</a>';
                    } else {
                        $activation = '<a href="' . route('admin.seller.active', $data->id) . '" class="edit btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this account?')" . '">Active</a>';
                    }
                    if ($data->is_blocked == 0) {
                        $blocking = '<a href="' . route('admin.seller.block', $data->id) . '" class="edit btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to block this account?')" . '">Block</a>';
                    } else {
                        $blocking = '<a href="' . route('admin.seller.unblock', $data->id) . '" class="edit btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to block this account?')" . '">Unblock</a>';
                    }
                    if ($data->is_top == 0) {
                        $topmaking = '<a href="' . route('admin.seller.addtop', $data->id) . '" class="edit btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to add this account to top artist?')" . '">Make Top</a>';
                    } else {
                        $topmaking = '<a href="' . route('admin.seller.removetop', $data->id) . '" class="edit btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to add this account to top artist?')" . '">Remove Top</a>';
                    }
                    return $activation . ' ' . $blocking . ' ' . $topmaking . ' ' . '<a href="' . route('admin.seller.destroy', $data->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['action', 'name', 'username', 'email', 'phone', 'account_number', 'profile_image'])
                ->make(true);
        }
        $pageTitle = "Sellers";
        return view('admin.sellers.index', compact('pageTitle'));
    }
    public function sellerRequest()
    {
        if (request()->ajax()) {
            $data = Seller::where('is_approved', 0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('profile_image', function ($data) {
                    return $data->image ? '<img width="50" src="' . asset('storage/seller/' . $data->image) . '">' : '<img width="50" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('name', function ($data) {
                    return $data->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('username', function ($data) {
                    return $data->username ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('email', function ($data) {
                    return $data->email ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('phone', function ($data) {
                    return $data->phone ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('account_number', function ($data) {
                    return $data->account_number ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="' . route('admin.seller.approve', $data->id) . '" class="edit mb-1 btn btn-success btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Approve</a>
                        <a href="' . route('admin.seller.reject', $data->id) . '" class="edit mb-1 btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Reject</a>
                        <a href="' . route('admin.seller.destroy', $data->id) . '" class="delete mb-1 btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Delete</a>
                        <a href="' . route('admin.seller.view.paintings', $data->id) . '" class="edit btn btn-info btn-sm" target="_blank">View Images</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'username', 'email', 'phone', 'account_number', 'profile_image'])
                ->make(true);
        }
        $pageTitle = "Sellers Request";
        return view('admin.sellers.index', compact('pageTitle'));
    }
    public function rejected()
    {
        if (request()->ajax()) {
            $data = Seller::where('is_approved', 2)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('profile_image', function ($data) {
                    return $data->image ? '<img width="50" src="' . asset('storage/seller/' . $data->image) . '">' : '<img width="50" src="' . asset('vendor/images/artist/avatar.svg') . '">';
                })
                ->editColumn('name', function ($data) {
                    return $data->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('username', function ($data) {
                    return $data->username ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('email', function ($data) {
                    return $data->email ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('phone', function ($data) {
                    return $data->phone ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('account_number', function ($data) {
                    return $data->account_number ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="' . route('admin.seller.recall', $data->id) . '" class="edit btn btn-info btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Recall</a>
                        <a href="' . route('admin.seller.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Delete</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'username', 'email', 'phone', 'account_number', 'profile_image'])
                ->make(true);
        }
        $pageTitle = "Rejected Sellers";
        return view('admin.sellers.index', compact('pageTitle'));
    }
    public function review_paintings($id)
    {
        $paintings = ReviewPainting::where('seller_id', $id)->get();
        $pageTitle = "Review Paintings";
        return view('admin.sellers.review_paintings', compact('pageTitle', 'paintings'));
    }
    public function approve($id)
    {
        $seller = Seller::find($id);
        $seller->is_approved = 1;
        $seller->save();
        $paintings = ReviewPainting::where('seller_id', $id)->get();
        foreach ($paintings as $painting) {
            Storage::disk('profile')->delete($painting->image);
            $painting->delete();
        }
        toastr()->success('Seller request accepted for ' . $seller->username . '!', 'Approved!');
        return redirect()->back();
    }
    public function reject($id)
    {
        $seller = Seller::find($id);
        $seller->is_approved = 2;
        $seller->save();
        toastr()->error('Seller request rejected for ' . $seller->username . '!', 'Rejected!');
        return redirect()->back();
    }
    public function recall($id)
    {
        $seller = Seller::find($id);
        $seller->is_approved = 0;
        $seller->save();
        toastr()->info('Seller request recalled for ' . $seller->username . '!', 'Recycled!');
        return redirect()->back();
    }
    public function active($id)
    {
        $seller = Seller::find($id);
        $seller->is_active = 1;
        $seller->save();
        toastr()->success('Account Activated!', 'Activate!');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $seller = Seller::find($id);
        $seller->is_active = 0;
        $seller->save();
        toastr()->warning('Account Deactivated!', 'Deactivated!');
        return redirect()->back();
    }
    public function block($id)
    {
        $seller = Seller::find($id);
        $seller->is_blocked = 1;
        $seller->is_active = 0;
        $seller->is_top = 0;
        $seller->save();
        toastr()->error($seller->username . ' is blocked!', 'Blocked!');
        return redirect()->back();
    }
    public function unblock($id)
    {
        $seller = Seller::find($id);
        $seller->is_blocked = 0;
        $seller->save();
        toastr()->info($seller->username . ' is unblocked!', 'Unblocked!');
        return redirect()->back();
    }
    public function addtop($id)
    {
        $seller = Seller::find($id);
        $seller->is_top = 1;
        $seller->save();
        toastr()->info($seller->username . ' is added on top artist list!', 'Top artist!');
        return redirect()->back();
    }
    public function removetop($id)
    {
        $seller = Seller::find($id);
        $seller->is_top = 0;
        $seller->save();
        toastr()->warning($seller->username . ' is remove from top artist list!', 'Top artist!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $seller = Seller::find($id);
        $seller->delete();
        toastr()->success('Seller request deleted for ' . $seller->username . '!', 'Deleted!');
        return redirect()->back();
    }
}
