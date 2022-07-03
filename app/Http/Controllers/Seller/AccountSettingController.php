<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Account Settings';
        return view('seller.settings.index', compact('pageTitle'));
    }

    public function updateuAccount(Request $request, $id)
    {
        $this->validate($request, [
            'account_number' => ['required', 'integer'],
            'current_password' => ['string', 'nullable'],
            'new_password' => ['string', 'nullable'],
            'confirm_password' => ['string', 'nullable'],
        ]);
        $seller = Seller::find($id);
        $seller->account_number = $request->account_number;
        $checkPass = Hash::check($request->current_password, $seller->password);
        if (!$checkPass) {
            alert('Your current password is incorrect!', '', 'error');
            return redirect()->back();
        }
        if ($request->new_password != null) {
            $if_matched = $request->new_password == $request->confirm_password;
            if (!$if_matched) {
                alert('Password Not Matched!', '', 'error');
                return redirect()->back();
            } else {
                $seller->password = Hash::make($request->new_password);
            }
        }
        $seller->save();
        alert('Updated!', 'Your account setting is updated successfully!', 'success');
        return redirect()->route('seller.profile.index');
    }
}
