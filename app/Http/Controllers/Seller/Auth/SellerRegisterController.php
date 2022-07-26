<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRegisterRequest;
use App\Mail\Register;
use App\Mail\SellerRegisterMailer;
use App\Models\ReviewPainting;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
    public function store(SellerRegisterRequest $request)
    {
        $seller = new Seller($request->all());
        $seller->password = Hash::make($request['password']);
        $seller->save();

        $file = new FileManager();
        if ($request->has('images')) {
            if (isset($request->images) && count($request->images) > 0) {
                foreach ($request->images as $img) {
                    $review_painting = new ReviewPainting();
                    $photo = $img;
                    $file->folder('seller')->prefix('vendor-review-image')
                        ->postfix($seller->username)
                        ->upload($photo) ? $review_painting->image = $file->getName() : null;
                    $review_painting->seller_id = $seller->id;
                    $review_painting->save();
                }
            }
        }

        if ($seller) {
            Mail::to($seller->email)->send(new SellerRegisterMailer($seller));
        }

        toastr()->info('You`ve just registered as an artist. Please wait for confirmation!', 'Success!');
        return redirect()->route('seller.log-in');
    }
}
