<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // ------------------------------------------------- home
    public function index()
    {
        $best_sellings = Product::where('best_selling', 1)->where('status', 1)->with('productImages')->latest()->take(6)->get();
        $pageTitle = "Welcome to largest online painting platform!";
        return view('welcome', compact('pageTitle', 'best_sellings'));
    }

    // ------------------------------------------------- about
    public function about()
    {
        $pageTitle = "About Us";
        return view('frontend.about', compact('pageTitle'));
    }
    // ------------------------------------------------- contact
    public function contact()
    {
        $pageTitle = "Contact";
        return view('frontend.contact', compact('pageTitle'));
    }
    public function contactStore(ContactRequest $request)
    {
        $contact = new Contact($request->all());
        $contact->save();
        alert('Message Sent!', 'Your valuable message sented to our community!', 'success');
        return redirect()->back();
    }

    // ------------------------------------------------- contract
    public function contract()
    {
        $pageTitle = "Contract";
        $pageDescription = "Lorem ipsum dolor sit amet, consectetur.";
        return view('frontend.contract', compact('pageTitle', 'pageDescription'));
    }

    // ------------------------------------------------- blogs
    public function blogs()
    {
        $blogs = Blog::where('status', 1)->latest()->take(24)->get();
        $pageTitle = "Blogs";
        return view('frontend.blogs', compact('pageTitle', 'blogs'));
    }
    public function viewBlog($id)
    {
        $blog = Blog::find($id);
        $pageTitle = "View Blog";
        return view('frontend.view-blog', compact('pageTitle', 'blog'));
    }
}
