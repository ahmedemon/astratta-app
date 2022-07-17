<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortingRange;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShortingRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = ShortingRange::latest()->get();
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
                        $activation = '<a href="' . route('admin.short-range.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this shorting range?')" . '">Active</a>';
                    } else {
                        $activation = '<a href="' . route('admin.short-range.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this shorting range?')" . '">Deactive</a>';
                    }
                    $edit = '<a href="' . route('admin.short-range.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this shorting range?')" . '">Edit</a>';
                    $delete = '<a href="' . route('admin.short-range.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this shorting range?')" . '">Delete</a>';
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Shorting Range";
        return view('admin.shorting.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'start' => 'required',
            'end' => 'required',
        ]);
        $shorting = new ShortingRange($request->all());
        $shorting->save();
        alert('Shorting Added!', '', 'success');
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
            $data = ShortingRange::latest()->get();
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
                            $activation = '<a href="' . route('admin.short-range.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this shorting range?')" . '">Active</a>';
                        } else {
                            $activation = '<a href="' . route('admin.short-range.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this shorting range?')" . '">Deactive</a>';
                        }
                        $edit = '<a href="' . route('admin.short-range.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this shorting range?')" . '">Edit</a>';
                        $delete = '<a href="' . route('admin.short-range.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this shorting?')" . '">Delete</a>';
                    }
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $shorting = ShortingRange::find($id);
        $pageTitle = "Edit " . $shorting->name;
        return view('admin.shorting.edit', compact('shorting', 'pageTitle'));
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
            'start' => 'required',
            'end' => 'required',
        ]);
        $shorting = ShortingRange::find($id);
        $shorting->update($request->except('_token', '_method'));
        alert('Shorting Updated!', '', 'info');
        return redirect()->route('admin.short-range.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shorting = ShortingRange::find($id);
        $shorting->delete();
        alert('Shorting deleted!', '', 'danger');
        return redirect()->back();
    }
}
