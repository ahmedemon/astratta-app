<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SellerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Seller::where('is_approved', 1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($data) {
                    return $data->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('account_number', function ($data) {
                    return $data->account_number ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="javascript:void();" class="edit btn btn-success btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Edit</a>
                        <a href="' . route('admin.seller.destroy', $data->id) . '" class="delete btn btn-danger btn-sm">Delete</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'account_number'])
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
                ->editColumn('name', function ($data) {
                    return $data->name ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->editColumn('account_number', function ($data) {
                    return $data->account_number ?? '<span class="badge badge-warning rounded-0">Not Updated Yet</span>';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <a href="' . route('admin.seller.approve', $data->id) . '" class="edit btn btn-success btn-sm">Approve</a>
                        <a href="' . route('admin.seller.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure?')" . '">Delete</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'account_number'])
                ->make(true);
        }
        $pageTitle = "Sellers Request";
        return view('admin.sellers.index', compact('pageTitle'));
    }

    public function approve($id)
    {
        $seller = Seller::find($id);
        $seller->is_approved = 1;
        $seller->save();
        toastr()->success('Seller request accepted for ' . $seller->username . '!', 'Approved!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $seller = Seller::find($id);
        $seller->delete();
        toastr()->success('Seller request accepted for ' . $seller->username . '!', 'Approved!');
        return redirect()->back();
    }
}
