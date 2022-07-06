<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Coupon::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('is_active', function ($data) {
                    if ($data->is_active == 0) {
                        return '<span class="btn btn-sm btn-warning">Deactivated</span>';
                    }
                    if ($data->is_active == 1) {
                        return '<span class="btn btn-sm btn-success">Activated</span>';
                    }
                })
                ->editColumn('percentage', function ($data) {
                    return $data->percentage . '%';
                })
                ->addColumn('action', function ($data) {
                    if ($data->is_active == 0) {
                        $activation = '<a href="' . route('admin.coupon.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this coupon?')" . '">Active</a>';
                    } else {
                        $activation = '<a href="' . route('admin.coupon.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this coupon?')" . '">Deactive</a>';
                    }
                    $edit = '<a href="' . route('admin.coupon.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this coupon?')" . '">Edit</a>';
                    $delete = '<a href="' . route('admin.coupon.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'is_active', 'percentage'])
                ->make(true);
        }
        $pageTitle = "Coupons";
        return view('admin.coupon.index', compact('pageTitle'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'percentage' => 'required|integer',
        ]);
        $coupon = new Coupon($request->all());
        $coupon->save();
        alert('Coupon Added Successfully!', '', 'success');
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Coupon::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('is_active', function ($data) {
                    if ($data->is_active == 0) {
                        return '<span class="btn btn-sm btn-warning">Deactivated</span>';
                    }
                    if ($data->is_active == 1) {
                        return '<span class="btn btn-sm btn-success">Activated</span>';
                    }
                })
                ->editColumn('percentage', function ($data) {
                    return $data->percentage . '%';
                })
                ->addColumn('action', function ($data) {
                    if (request()->id == $data->id) {
                        $delete = 'Edit in progress';
                        $edit = '';
                        $activation = '';
                    } else {
                        if ($data->is_active == 0) {
                            $activation = '<a href="' . route('admin.coupon.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this coupon?')" . '">Active</a>';
                        } else {
                            $activation = '<a href="' . route('admin.coupon.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this coupon?')" . '">Deactive</a>';
                        }
                        $edit = '<a href="' . route('admin.coupon.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this coupon?')" . '">Edit</a>';
                        $delete = '<a href="' . route('admin.coupon.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    }
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'is_active', 'percentage'])
                ->make(true);
        }
        $coupon = Coupon::find($id);
        $pageTitle = "Edit " . $coupon->code;
        return view('admin.coupon.edit', compact('coupon', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'percentage' => 'required|integer',
        ]);
        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->percentage = $request->percentage;
        $coupon->save();
        alert('Coupon Updated!', '', 'success');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        alert('Coupon Deleted!', '', 'warning');
        return redirect()->back();
    }
    public function active($id)
    {
        $coupon = Coupon::find($id);
        $coupon->is_active = 1;
        $coupon->save();
        alert('Coupon activated!', '', 'success');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $coupon = Coupon::find($id);
        $coupon->is_active = 0;
        $coupon->save();
        alert('Coupon deactivated!', '', 'warning');
        return redirect()->back();
    }
}
