<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = WithdrawMethod::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Deactivated</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Activated</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 0) {
                        $activation = '<a href="' . route('admin.method.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this method?')" . '">Active</a>';
                    } else {
                        $activation = '<a href="' . route('admin.method.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this method?')" . '">Deactive</a>';
                    }
                    $edit = '<a href="' . route('admin.method.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this method?')" . '">Edit</a>';
                    $delete = '<a href="' . route('admin.method.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this method?')" . '">Delete</a>';
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Withdraw Methods";
        return view('admin.withdraw-method.index', compact('pageTitle'));
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
            'name' => 'required|string',
        ]);
        $method = new WithdrawMethod($request->all());
        $method->save();
        alert('Method Added!', '', 'success');
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
            $data = WithdrawMethod::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="badge badge-warning rounded-0">Deactivated</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="badge badge-success rounded-0">Activated</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if (request()->id == $data->id) {
                        $delete = 'Edit in progress';
                        $edit = '';
                        $activation = '';
                    } else {
                        if ($data->status == 0) {
                            $activation = '<a href="' . route('admin.method.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this method?')" . '">Active</a>';
                        } else {
                            $activation = '<a href="' . route('admin.method.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this method?')" . '">Deactive</a>';
                        }
                        $edit = '<a href="' . route('admin.method.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this method?')" . '">Edit</a>';
                        $delete = '<a href="' . route('admin.method.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this method?')" . '">Delete</a>';
                    }
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $method = WithdrawMethod::find($id);
        $pageTitle = "Edit " . $method->name;
        return view('admin.withdraw-method.edit', compact('method', 'pageTitle'));
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
            'name' => 'required|string',
        ]);
        $method = WithdrawMethod::find($id);
        $method->name = $request->name;
        $method->save();
        alert('Method Updated!', '', 'success');
        return redirect()->route('admin.method.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $method = WithdrawMethod::find($id);
        $method->delete();
        alert('Method Deleted!', '', 'warning');
        return redirect()->back();
    }
    public function active($id)
    {
        $method = WithdrawMethod::find($id);
        $method->status = 1;
        $method->save();
        alert('Method activated!', '', 'success');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $method = WithdrawMethod::find($id);
        $method->status = 0;
        $method->save();
        alert('Method deactivated!', '', 'warning');
        return redirect()->back();
    }
}
