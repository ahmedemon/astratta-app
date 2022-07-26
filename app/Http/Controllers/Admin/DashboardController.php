<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\AdminWalletTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AdminWalletTrait;
    public function index()
    {
        $wallets = $this->allWallets();
        $wallets_name = $this->getWalletNames();
        $pageTitle = "Dashboard";
        return view('admin.dashboard.index', compact('pageTitle', 'wallets', 'wallets_name'));
    }
}
