<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::VENDOR_HOME;

    function __construct()
    {
        $this->redirectTo = env('VENDOR_URL_PREFIX', 'vendor');
        $this->middleware('vendor.guest')->except('logout');
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
        $pageTitle = "Vendor Login";
        return view('vendor.auth.login', compact('pageTitle'));
    }

    protected function guard()
    {
        return Auth::guard('vendor');
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
            return redirect()->route('vendor.dashboard.index');
            // return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        $this->guard('vendor')->logout();
        // $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('vendor.log-in');
    }
}
