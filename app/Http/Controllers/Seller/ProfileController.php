<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $pageTitle = "Profile";
        return view('seller.profile.index', compact('pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'designation' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
        ]);
        $id = Auth::guard('seller')->user()->id;
        $seller_profile = Seller::find($id);
        $seller_profile->name = $request->name;
        $seller_profile->designation = $request->designation;
        $seller_profile->description = $request->description;

        if ($request->has('image')) {
            $input = $request->all();
            $parts = explode(";base64,", $input['base64image']);
            $type_aux = explode("image/", $parts[0]);
            $type = $type_aux[1];
            $image_base64 = base64_decode($parts[1]);

            // file naming convension
            $separator = '-';
            $prefix = 'seller-profile-';
            $postfix = '';
            $filename = $prefix . Str::uuid() . $separator . $postfix .  date('Y-m-d') . '.' . $type;
            // file naming convension

            if ($seller_profile->image != null) {
                Storage::disk('profile')->delete($seller_profile->image);
            }
            Storage::disk('profile')->put($filename, $image_base64);

            $seller_profile->image = $filename;
        }
        $seller_profile->save();

        alert('Updated', 'Profile updated successfully!', 'success');
        return redirect()->back();
    }
}
