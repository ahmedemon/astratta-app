<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'seller_id', 'product_id', 'order_track_id', 'order_date', 'total_cost', 'method_id'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
