<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'note', 'trnx_id', 'seller_id', 'method_id', 'account_number'];

    public function withdrawMethod()
    {
        return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }
}
