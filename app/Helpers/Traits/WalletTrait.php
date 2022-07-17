<?php

namespace App\Helpers\Traits;

use App\Helpers\BalanceHelper as Balance;
use Illuminate\Support\Facades\Auth;

trait WalletTrait
{
    public function allWallets($seller_id)
    {
        $wallet['upcoming_balance']             = number_format(round(Balance::getUpcomingAmount($seller_id), 2), 2);

        $wallet['current_balance']              = number_format(round(Balance::getCurrentBalance($seller_id), 2), 2);
        $wallet['monthly_income_balance']       = number_format(round(Balance::getBalanceByMonth($seller_id), 2), 2);

        $wallet['current_order_quantity']       = Balance::getTotalCurrentOrderQuantity($seller_id);
        $wallet['finished_orders_quantity']     = Balance::getTotalFinishedOrderQuantity($seller_id);
        $wallet['current_order_data']           = Balance::getTotalCurrentOrderData($seller_id); //extra
        $wallet['finished_orders_data']         = Balance::getTotalFinishedOrderData($seller_id); //extra
        return $wallet;
    }

    public function getWalletNames()
    {
        $wallet_names['upcoming_balance'] = 'Upcoming Balance';

        $wallet_names['current_balance'] = 'Balance';
        $wallet_names['monthly_income_balance'] = 'Earning This Month';

        $wallet_names['current_order_quantity'] = 'Orders';
        $wallet_names['finished_orders_quantity'] = 'Finished Order';
        $wallet_names['current_order_data'] = 'Orders Data'; //extra
        $wallet_names['finished_orders_data'] = 'Finished Order Data'; //extra
        return $wallet_names;
    }
}
