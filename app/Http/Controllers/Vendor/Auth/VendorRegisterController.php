<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRegisterRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorRegisterController extends Controller
{
    function __construct()
    {
        $this->redirectTo = env('VENDOR_URL_PREFIX', 'vendor');
        $this->middleware('vendor.guest')->except('logout');
    }
    public function index()
    {
        if (Auth::guard('web')->check()) {
            alert('Please! Logout from buyer profile first!', '', 'warning');
            $this->middleware('guest')->except('logout');
            return redirect()->back();
        }

        $pageTitle = "Join Us";
        return view('vendor.auth.register', compact('pageTitle'));
    }
    // $file = new FileManager();
    // if ($request->has('paintings')) {
    //     $photo = $request->paintings;
    //     $file->folder('vendor/paintings')->prefix('vendor-paintings-')
    //         ->postfix(auth()->user()->username)
    //         ->upload($photo) ?
    //         $vendor->paintings = $file->getName() : null;
    // }

    // if ($request->hasFile('feature_img')) {
    //     foreach ($request->feature_img as $img) {
    //         if (!in_array($img->getClientOriginalExtension(), $acceptable)) {
    //             return back()->with('error', 'Only jpeg, png, jpg and gif file is supported.');
    //         }
    //     }
    // }
    public function store(VendorRegisterRequest $request)
    {
        $vendor = new Vendor($request->all());
        $vendor->password = Hash::make($request['password']);
        $vendor->save();
        toastr()->info('You`ve just registered as an artist. Please wait for confirmation!', 'Success!');
        return redirect()->route('vendor.login');
    }
}
