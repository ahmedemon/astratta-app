<?php

namespace App\Helpers;

use App\Models\CurrentBalance;
use App\Models\Order;
use App\Models\Withdraw;
use Carbon\Carbon;

class AdminBalanceHelper
{
    public static function getBalance($balanceModel)
    {
        $balance = $balanceModel::select('credit_amount', 'debit_amount')->get();
        $totalCredit = $balance->sum('credit_amount'); // total amount of deposit
        $totalDebit = $balance->sum('debit_amount'); // total amount of withdraw
        return $totalCredit -= $totalDebit;
    }
    public static function getTotalCurrentOrderQuantity() //processing
    {
        return Order::whereIn('status', [0, 1])->count();
    }
    public static function getTotalFinishedOrderQuantity() //completed
    {
        return Order::where('status', 2)->count();
    }
    public static function getTotalCurrentOrderData() //processing
    {
        return Order::where('status', 0)->get();
    }
    public static function getTotalFinishedOrderData() //processing
    {
        return Order::where('status', 2)->get();
    }
    public static function getBalanceByMonth() //completed
    {
        $startMonth = Carbon::now()->startOfMonth()->subMonth();
        $endMonth = Carbon::now()->startOfMonth();
        return Order::whereBetween('updated_at', [$startMonth, $endMonth])->where('updated_at', '<=', Carbon::now()->subDays(20)->toDateTimeString())->where('status', 2)->sum('total_cost');
    }
    public static function getTotalWithdrawByMonth() //withdraw by month
    {
        $startMonth = Carbon::now()->startOfMonth()->subMonth();
        $endMonth = Carbon::now()->startOfMonth();
        return Withdraw::whereBetween('updated_at', [$startMonth, $endMonth])->where('updated_at', '<=', Carbon::now()->subDays(20)->toDateTimeString())->where('status', 2)->sum('amount');
    }
    public static function getTotalWithdraw() //withdraw by month
    {
        return Withdraw::where('status', 2)->sum('amount');
    }
    public static function getOutgoingAmount() //upcoming amount
    {
        $startMonth = Carbon::now()->startOfMonth()->subMonth();
        $endMonth = Carbon::now()->startOfMonth();
        $total = Order::whereBetween('updated_at', [$startMonth, $endMonth])->where('updated_at', '<=', Carbon::now()->subDays(20)->toDateTimeString())->where('status', 2)->sum('total_cost');
        $upcoming = Order::where('updated_at', '>=', Carbon::now()->subDays(20)->toDateTimeString())->where('status', 2)->sum('total_cost');
        return $upcoming - $total;
    }
}
