<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Blog::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($data) {
                    $image = $data->image ? asset('storage/blogs/' . $data->image) : asset('frontend/images/blog-demo.png');
                    return '<img src="' . $image . '" height="50">';
                })
                ->editColumn('category_id', function ($data) {
                    $category = $data->category->name ?? "---";
                    return '<span class="btn btn-sm btn-info">' . $category . '</span>';
                })
                ->editColumn('description', function ($data) {
                    return Str::limit($data->description, 40, '...');
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) {
                        return '<span class="btn btn-sm btn-warning">Deactivated</span>';
                    }
                    if ($data->status == 1) {
                        return '<span class="btn btn-sm btn-success">Activated</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 0) {
                        $activation = '<a href="' . route('admin.blog.active', $data->id) . '" class="delete mb-1 btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to active this blog?')" . '">Active</a>';
                    } else {
                        $activation = '<a href="' . route('admin.blog.deactive', $data->id) . '" class="delete mb-1 btn btn-warning btn-sm" onClick="' . "return confirm('Are you sure you want to deactive this blog?')" . '">Deactive</a>';
                    }
                    if ($data->is_featured == 0) {
                        $feature = '<a href="' . route('admin.blog.feature.make', $data->id) . '" class="delete mb-1 btn btn-success btn-sm" onClick="' . "return confirm('Are you sure you want to add feature list?')" . '">Make Feature</a>';
                    } else {
                        $feature = '<a href="' . route('admin.blog.feature.remove', $data->id) . '" class="delete mb-1 btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want remove from feature list?')" . '">Remove Feature</a>';
                    }
                    $edit = '<a href="' . route('admin.blog.edit', $data->id) . '" class="delete mb-1 btn btn-info btn-sm" onClick="' . "return confirm('Are you sure you want to edit this blog?')" . '">Edit</a>';
                    $delete = '<a href="' . route('admin.blog.destroy', $data->id) . '" class="delete mb-1 btn btn-danger btn-sm" onClick="' . "return confirm('Are you sure you want to delete this blog?')" . '">Delete</a>';
                    return $feature . ' ' . $activation . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'image', 'status', 'category_id'])
                ->make(true);
        }
        $pageTitle = "Blogs";
        return view('admin.blogs.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Blog";
        $categories = Category::where('status', 1)->get();
        return view('admin.blogs.create', compact('pageTitle', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog($request->all());
        if ($request->image == !null) {
            $input = $request->all();
            $parts = explode(";base64,", $input['base64image']);
            $type_aux = explode("image/", $parts[0]);
            $type = $type_aux[1];
            $image_base64 = base64_decode($parts[1]);

            // file naming convension
            $separator = '-';
            $prefix = 'blog-';
            $postfix = '';
            $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
            // file naming convension

            if ($blog->image != null) {
                Storage::disk('blog')->delete($blog->image);
            }
            Storage::disk('blog')->put($filename, $image_base64);

            $blog->image = $filename;
        }
        $blog->save();
        toastr()->success('Blog added successfully!', 'success');
        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $pageTitle = "Edit " . '"' . $blog->title . '"';
        $categories = Category::where('status', 1)->get();
        return view('admin.blogs.edit', compact('pageTitle', 'blog', 'categories'));
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
        $blog = Blog::find($id);
        $blog->topic = $request->topic;
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status;
        if ($request->image == !null) {
            $input = $request->all();
            $parts = explode(";base64,", $input['base64image']);
            $type_aux = explode("image/", $parts[0]);
            $type = $type_aux[1];
            $image_base64 = base64_decode($parts[1]);

            // file naming convension
            $separator = '-';
            $prefix = 'blog-';
            $postfix = '';
            $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
            // file naming convension

            if ($blog->image != null) {
                Storage::disk('blog')->delete($blog->image);
            }
            Storage::disk('blog')->put($filename, $image_base64);

            $blog->image = $filename;
        }
        $blog->save();
        toastr()->success('Blog updated successfully!', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $blog = Blog::find($id);
        $blog->status = 1;
        $blog->save();
        alert('Blog activated Successfully!', '', 'success');
        return redirect()->back();
    }
    public function deactive($id)
    {
        $blog = Blog::find($id);
        $blog->status = 0;
        $blog->save();
        alert('Blog activated Successfully!', '', 'success');
        return redirect()->back();
    }
    public function makeFeature($id)
    {
        $blog = Blog::find($id);
        $blog->is_featured = 1;
        $blog->save();
        alert('Blog added to the featured list!', '', 'success');
        return redirect()->back();
    }
    public function removeFeature($id)
    {
        $blog = Blog::find($id);
        $blog->is_featured = 0;
        $blog->save();
        alert('Blog removed from the featured list!', '', 'success');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        Storage::disk('blog')->delete($blog->image);
        $blog->delete();
        alert('Blog Deleted Successfully!', '', 'success');
        return redirect()->back();
    }
}
