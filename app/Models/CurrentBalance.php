<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentBalance extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id', 'credit_amount', 'debit_amount', 'note', 'trnx_id'];
}
