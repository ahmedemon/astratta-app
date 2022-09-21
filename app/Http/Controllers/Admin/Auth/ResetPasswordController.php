<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('admin_password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword) {
            alert('Error', 'Invalid token!', 'error');
            return back()->withInput();
        }
        $admin = Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('admin_password_resets')->where(['email' => $request->email])->delete();

        alert('Success!', 'Your password has been changed!', 'success');
        return redirect()->route('admin.log-in');
    }
}
