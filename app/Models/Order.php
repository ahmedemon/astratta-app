<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_track_id', 'order_date', 'total_cost', 'method_id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function billing()
    {
        return $this->hasOne(BillingDetail::class);
    }
    public function shipping()
    {
        return $this->hasOne(ShippingDetail::class);
    }
}
