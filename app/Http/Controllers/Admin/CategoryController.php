<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Category::latest()->get();
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
                        $activation = '<a href="' . route('admin.category.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this category?')" . '">Active</a>';
                    } else {
                        $activation = '<a href="' . route('admin.category.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this category?')" . '">Deactive</a>';
                    }
                    $edit = '<a href="' . route('admin.category.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this category?')" . '">Edit</a>';
                    $delete = '<a href="' . route('admin.category.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $pageTitle = "Categories";
        return view('admin.category.index', compact('pageTitle'));
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
        $category = new Category($request->all());
        $category->save();
        alert('Category Added!', '', 'success');
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
            $data = Category::latest()->get();
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
                            $activation = '<a href="' . route('admin.category.active', $data->id) . '" class="delete btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this category?')" . '">Active</a>';
                        } else {
                            $activation = '<a href="' . route('admin.category.deactive', $data->id) . '" class="delete btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this category?')" . '">Deactive</a>';
                        }
                        $edit = '<a href="' . route('admin.category.edit', $data->id) . '" class="delete btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this category?')" . '">Edit</a>';
                        $delete = '<a href="' . route('admin.category.destroy', $data->id) . '" class="delete btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this product?')" . '">Delete</a>';
                    }
                    return $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $category = Category::find($id);
        $pageTitle = "Edit " . $category->name;
        return view('admin.category.edit', compact('category', 'pageTitle'));
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
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        alert('Category Updated!', '', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        alert('Category Deleted!', '', 'warning');
        return redirect()->back();
    }
    public function active($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        alert('Category activated!', '', 'success');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        alert('Category deactivated!', '', 'warning');
        return redirect()->back();
    }
}
