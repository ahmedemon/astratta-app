<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewPainting extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id', 'image'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
