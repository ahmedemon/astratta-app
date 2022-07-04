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
        //     $order = Order::with('product')->where('seller_id', $seller_id)->sum('total_cost');
        //     return $totalCredit -= $totalDebit;
        // }
        return $totalCredit -= $totalDebit;
    }
    public static function getTotalCurrentOrderQuantity($seller_id) //processing
    {
        return Order::where('seller_id', $seller_id)->whereIn('status', [0, 1])->count();
    }
    public static function getTotalFinishedOrderQuantity($seller_id) //completed
    {
        return Order::where('seller_id', $seller_id)->where('status', 2)->count();
    }
    public static function getTotalCurrentOrderData($seller_id) //processing
    {
        return Order::where('seller_id', $seller_id)->where('status', 0)->get();
    }
    public static function getTotalFinishedOrderData($seller_id) //processing
    {
        return Order::where('seller_id', $seller_id)->where('status', 2)->get();
    }

    public static function getCurrentBalance($seller_id)
    {
        //how to get data after waiting 20 days
        $order = Order::where('seller_id', $seller_id)->where('status', 2);
        $current_blance = CurrentBalance::where('seller_id', $seller_id);

        $credit_amount = $order->sum('total_cost');
        $debit_amount = $current_blance->sum('debit_amount');
        return $credit_amount -= $debit_amount;
    }
    public static function getBalanceByMonth($seller_id) //completed
    {
        return Order::where('seller_id', $seller_id)->where('status', 2)->sum('total_cost');
    }
}
