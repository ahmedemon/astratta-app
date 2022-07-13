<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_id', 'reason_id'];

    public function order($id)
    {
        return Order::select('order_track_id')->where('id', $id)->distinct()->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reason()
    {
        return $this->hasOne(RefundReason::class, 'id', 'reason_id');
    }
}
