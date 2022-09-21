<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'country',
        'state',
        'town_city',
        'street',
        'post_or_zip',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
