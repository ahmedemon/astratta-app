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
        'email',
        'phone',
        'password',
        'paintings',
        'privacy_policy',
        'contact_agreement',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
