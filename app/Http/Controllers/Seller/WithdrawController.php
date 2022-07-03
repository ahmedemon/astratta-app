<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    use WalletTrait;
    public function index()
    {
        $withdraws = Withdraw::where('seller_id', Auth::guard('seller')->user()->id)->paginate(4);
        $pageTitle = "Withdraw";
        return view('seller.withdraw.index', compact('pageTitle', 'withdraws'));
    }

    public function create()
    {
        $pageTitle = "Withdraw";
        $seller_id = Auth::guard('seller')->user()->id;
        $wallets = $this->allWallets($seller_id);
        $wallet_name = $this->getWalletNames($seller_id);
        $methods = WithdrawMethod::where('status', 1)->get();
        return view('seller.withdraw.create', compact('pageTitle', 'wallets', 'wallet_name', 'methods'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'method_id' => 'required|integer',
        ]);
        $seller_id = Auth::guard('seller')->user()->id;
        $wallets = $this->allWallets($seller_id);
        $current_balance = intval($wallets['current_balance']);
        if ($request->amount > $current_balance) {
            alert('Not enought balance!', '', 'error');
            return redirect()->back();
        }
        $withdraw = new Withdraw();
        $withdraw->seller_id = Auth::guard('seller')->user()->id;
        $withdraw->amount = $request->amount;
        $withdraw->note = $request->method_id;
        $withdraw->save();
        alert('Withdraw Request Sent!', '', 'success');
        return redirect()->back();
    }
}
