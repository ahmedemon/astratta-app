<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Seller extends User
{
    use HasFactory;
    protected $fillable = [
        'username',
        'stripe_id',
        'paypal_id',
        'email',
        'phone',
        'password',
        'card_number',
        'privacy_policy',
        'contact_agreement',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function review_paintings()
    {
        return $this->hasMany(ReviewPainting::class);
    }
}
