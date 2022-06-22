<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function about()
    {
        $pageTitle = "About Us";
        return view('frontend.about', compact('pageTitle'));
    }
    public function contact()
    {
        $pageTitle = "Contact";
        return view('frontend.contact', compact('pageTitle'));
    }
    public function contract()
    {
        $pageTitle = "Contract";
        $pageDescription = "Lorem ipsum dolor sit amet, consectetur.";
        return view('frontend.contract', compact('pageTitle', 'pageDescription'));
    }
    public function blogs()
    {
        $pageTitle = "Blogs";
        return view('frontend.blogs', compact('pageTitle'));
    }
    public function viewBlog($id)
    {
        $pageTitle = "View Blog";
        return view('frontend.view-blog', compact('pageTitle'));
    }
}
