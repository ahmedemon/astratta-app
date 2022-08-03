<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {
        return view('seller.auth.passwords.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:sellers',
        ]);

        $token = Str::random(64);

        DB::table('seller_password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('email.seller-reset-link', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        alert('Success!', 'We have sent you an email with a link to reset your password!', 'success');
        return back();
    }
}
