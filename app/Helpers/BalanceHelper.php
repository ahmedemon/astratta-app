<?php

namespace App\Helpers;

use App\Models\CurrentBalance;
use App\Models\Order;
use App\Models\Seller;
use Carbon\Carbon;

class BalanceHelper
{
    public static function getBalance($balanceModel, $seller_id)
    {
        $balance = $balanceModel::select('credit_amount', 'debit_amount')->where('seller_id', $seller_id)->get();
        $totalCredit = $balance->sum('credit_amount'); // total amount of deposit
        $totalDebit = $balance->sum('debit_amount'); // total amount of withdraw

        // if (CurrentBalance::class == $balanceModel) { // buyer request debited amount
        //     $order = Order::with('product')->where('seller_id', $seller_id)->whereIn('status', [0, 1, 2])->get();
        //     $total_order_amount = $order->sum('total_cost');
        //     return $totalCredit -= $total_order_amount;
        // }
        return $totalCredit -= $totalDebit;
    }
    public static function getTotalCurrentOrderQuantity($seller_id) //processing
    {
        return Order::where('seller_id', $seller_id)->where('status', 0)->count();
    }
    public static function getTotalFinishedOrderQuantity($seller_id) //completed
    {
        return Order::where('seller_id', $seller_id)->where('status', 2)->count();
    }
    public static function getTotalCurrentOrderData($seller_id) //processing
    {
        return Order::where('seller_id', $seller_id)->where('status', 0)->get();
    }
    public static function getTotalFinishedOrderData($seller_id) //completed
    {
        return Order::where('seller_id', $seller_id)->where('status', 2)->get();
    }

    public static function getCurrentBalance($seller_id)
    {
        return (float) self::getBalance(CurrentBalance::class, $seller_id);
    }
    public static function getBalanceByMonth($seller_id) //completed
    {
        return CurrentBalance::where('seller_id', $seller_id)->whereMonth('created_at', Carbon::now()->month)->sum('debit_amount');
    }
}
