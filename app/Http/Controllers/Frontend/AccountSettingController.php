<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            alert('Please Login First!', '', 'info');
            return redirect()->route('login');
        }
        $pageTitle = "Account Setting";
        return view('frontend.my-account.setting', compact('pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'current_password' => ['string', 'nullable'],
            'new_password' => ['string', 'nullable'],
            'confirm_password' => ['string', 'nullable'],
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        if ($request->has('new_password')) {
            $checkPass = Hash::check($request->new_password, $user->password);
            if ($checkPass) {
                if ($request->new_password == $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                }
            }
        }
        $user->save();
        alert('Profile Updated Successfully!', '', 'success');
        return redirect()->back();
    }
}
