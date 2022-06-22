<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Vendor extends User
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
}
