<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = "Dashboard";
        return view('vendor.index', compact('pageTitle'));
    }
}
