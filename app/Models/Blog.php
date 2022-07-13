<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'topic', 'category_id', 'paint_category', 'title', 'description', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
