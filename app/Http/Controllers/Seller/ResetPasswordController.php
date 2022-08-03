<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token)
    {
        return view('seller.auth.passwords.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:sellers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('seller_password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword) {
            alert('Error', 'Invalid token!', 'error');
            return back()->withInput();
        }
        $seller = Seller::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('seller_password_resets')->where(['email' => $request->email])->delete();

        alert('Success!', 'Your password has been changed!', 'success');
        return redirect()->route('seller.log-in');
    }
}
