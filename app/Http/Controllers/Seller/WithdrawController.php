<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\CurrentBalance;
use App\Models\Seller;
use App\Models\Withdraw;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    use WalletTrait;
    public function index()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $wallets = $this->allWallets($seller_id);
        $wallet_name = $this->getWalletNames($seller_id);
        $withdraws = Withdraw::where('seller_id', Auth::guard('seller')->user()->id)->with('withdrawMethod')->paginate(4);
        $pageTitle = "Withdraws";
        return view('seller.withdraw.index', compact('pageTitle', 'withdraws', 'wallets', 'wallet_name'));
    }

    public function create()
    {
        $pageTitle = "Withdraw";
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = Seller::find($seller_id);
        $wallets = $this->allWallets($seller_id);
        $wallet_name = $this->getWalletNames($seller_id);
        $methods = WithdrawMethod::where('status', 1)->get();
        return view('seller.withdraw.create', compact('pageTitle', 'wallets', 'wallet_name', 'methods', 'seller'));
    }

    public function setMethod()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = Seller::find($seller_id);
        $pageTitle = "Set Withdraw Method";
        return view('seller.withdraw.method', compact('pageTitle', 'seller'));
    }
    public function putMethod(Request $request)
    {
        $this->validate($request, [
            'stripe_id' => 'nullable|string',
            'paypal_id' => 'nullable|string',
            'password' => 'required|string',
        ]);
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = Seller::find($seller_id);
        $check = Hash::check($request->password, $seller->password);
        if ($check != 1) {
            alert('Wrong Password!', 'Please check your password again!', 'error');
            return redirect()->back();
        }
        $seller->stripe_id = $request->stripe_id;
        $seller->paypal_id = $request->paypal_id;
        $seller->save();
        alert()->success('Method set successfully!', 'Success!');
        return redirect()->route('seller.withdraw.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'method_id' => 'required|integer',
        ]);
        if ($request->method_id != 1 && $request->method_id != 2) {
            alert('Wrong Method!', 'Please check your method again!', 'error');
            return redirect()->back();
        }
        $seller_id = Auth::guard('seller')->user()->id;
        $seller = Seller::find($seller_id);
        $wallets = $this->allWallets($seller_id);
        $current_balance = str_replace(',', '', $wallets['current_balance']);
        if ($request->amount > $current_balance) {
            alert('Not enought balance!', '', 'error');
            return redirect()->back();
        }
        $withdraw = new Withdraw();
        $withdraw->seller_id = $seller_id;
        $withdraw->method_id = $request->method_id;
        if ($withdraw->method_id == 1) {
            $withdraw->paypal_id = $seller->paypal_id;
        }
        if ($withdraw->method_id == 2) {
            $withdraw->stripe_id = $seller->stripe_id;
        }
        $withdraw->amount = $request->amount;
        $withdraw->note = 'General Withdraw';
        $withdraw->save();
        CurrentBalance::create([
            'seller_id' => $seller_id,
            'debit_amount' => $request->amount,
            'note' => 'Withdraw request' . Auth::guard('seller')->user()->name,
            'trnx_id' => Str::random(16),
        ]);
        alert('Withdraw Request Sent!', '', 'success');
        return redirect()->route('seller.withdraw.index');
    }
}
