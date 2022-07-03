<?php

namespace App\Http\Controllers\Seller;

use App\Helpers\Traits\WalletTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use WalletTrait;
    public function index()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $pageTitle = "Dashboard";
        $wallet = $this->allWallets($seller_id);
        $wallet_name = $this->getWalletNames($seller_id);
        return view('seller.index', compact('pageTitle', 'wallet', 'wallet_name'));
    }
}
