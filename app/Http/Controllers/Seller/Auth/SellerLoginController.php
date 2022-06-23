<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::SELLER_HOME;

    function __construct()
    {
        $this->redirectTo = env('SELLER_URL_PREFIX', 'seller');
        $this->middleware('seller.guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }



    public function viewLogin()
    {
        if (Auth::guard('web')->check()) {
            alert('Please! Logout from buyer profile first!', '', 'warning');
            $this->middleware('guest')->except('logout');
            return redirect()->back();
        }
        $pageTitle = "Seller Login";
        return view('seller.auth.login', compact('pageTitle'));
    }

    protected function guard()
    {
        return Auth::guard('seller');
    }

    public function login(Request $request)
    {
        // return $request->all();
        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            alert('Greetings!', 'Welcome to Dashboard, Art something new today!', 'success');
            return redirect()->route('seller.dashboard.index');
            // return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        $this->guard('seller')->logout();
        // $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('seller.log-in');
    }
}
