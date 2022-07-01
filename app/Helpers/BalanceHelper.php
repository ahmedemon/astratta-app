<?php

namespace App\Helpers;

use App\Models\CurrentBalance;
use App\Models\OrderedItem;

class BalanceHelper
{
    public static function getBalance($balanceModel, $seller_id)
    {
        $balance = $balanceModel::select('credit_point', 'debit_point')->where('seller_id', $seller_id)->get();
        $totalCredit = $balance->sum('credit_point'); // total amount of deposit
        $totalDebit = $balance->sum('debit_point'); // total amount of withdraw

        if (CurrentBalance::class == $balanceModel) { // buyer request debited amount
            $purchased_product = OrderedItem::with('product')
                ->where('seller_id', $seller_id)
                ->orWhere('product', function ($query) {
                    $query->where('seller_id', $query->seller_id)->sum('product_price');
                })->get();
            $totalCredit -= $purchased_product;
        }
    }
}
