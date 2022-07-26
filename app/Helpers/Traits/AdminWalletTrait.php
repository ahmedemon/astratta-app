<?php

namespace App\Helpers\Traits;

use App\Helpers\AdminBalanceHelper as Balance;
use Illuminate\Support\Facades\Auth;

trait AdminWalletTrait
{
    public function allWallets()
    {
        $wallet['outgoing_balance']             = number_format(round(Balance::getOutgoingAmount(), 2), 2);
        $wallet['monthly_ongoing_balance']       = number_format(round(Balance::getBalanceByMonth(), 2), 2);
        $wallet['withdraw_amount_by_month']       = number_format(round(Balance::getTotalWithdrawByMonth(), 2), 2);
        $wallet['total_withdraw_amount']       = number_format(round(Balance::getTotalWithdraw(), 2), 2);

        $wallet['current_order_quantity']       = Balance::getTotalCurrentOrderQuantity();
        $wallet['finished_orders_quantity']     = Balance::getTotalFinishedOrderQuantity();
        // $wallet['current_order_data']           = Balance::getTotalCurrentOrderData(); //extra
        // $wallet['finished_orders_data']         = Balance::getTotalFinishedOrderData(); //extra
        return $wallet;
    }

    public function getWalletNames()
    {
        $wallet_names['outgoing_balance'] = 'Outgoing Balance';
        $wallet_names['monthly_ongoing_balance'] = 'Given This Month';
        $wallet_names['withdraw_amount_by_month'] = 'Withdraw This Month';
        $wallet_names['total_withdraw_amount'] = 'Total Withdraws';

        $wallet_names['current_order_quantity'] = 'Orders';
        $wallet_names['finished_orders_quantity'] = 'Finished Order';
        // $wallet_names['current_order_data'] = 'Orders Data'; //extra
        // $wallet_names['finished_orders_data'] = 'Finished Order Data'; //extra
        return $wallet_names;
    }
}
