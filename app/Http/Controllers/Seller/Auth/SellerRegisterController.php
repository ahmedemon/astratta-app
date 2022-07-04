<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRegisterRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerRegisterController extends Controller
{
    function __construct()
    {
        $this->redirectTo = env('SELLER_URL_PREFIX', 'seller');
        $this->middleware('seller.guest')->except('logout');
    }
    public function index()
    {
        if (Auth::guard('web')->check()) {
            alert('Please! Logout from buyer profile first!', '', 'warning');
            $this->middleware('guest')->except('logout');
            return redirect()->back();
        }

        $pageTitle = "Join Us";
        return view('seller.auth.register', compact('pageTitle'));
    }
    // $file = new FileManager();
    // if ($request->has('paintings')) {
    //     $photo = $request->paintings;
    //     $file->folder('vendor/paintings')->prefix('vendor-paintings-')
    //         ->postfix(auth()->user()->username)
    //         ->upload($photo) ?
    //         $seller->paintings = $file->getName() : null;
    // }

    // if ($request->hasFile('feature_img')) {
    //     foreach ($request->feature_img as $img) {
    //         if (!in_array($img->getClientOriginalExtension(), $acceptable)) {
    //             return back()->with('error', 'Only jpeg, png, jpg and gif file is supported.');
    //         }
    //     }
    // }
    public function store(SellerRegisterRequest $request)
    {
        $seller = new Seller($request->all());
        $seller->password = Hash::make($request['password']);
        $seller->save();
        toastr()->info('You`ve just registered as an artist. Please wait for confirmation!', 'Success!');
        return redirect()->route('seller.log-in');
    }
}
