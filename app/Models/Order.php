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


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
