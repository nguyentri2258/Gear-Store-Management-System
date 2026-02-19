<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'category_id',
        'description',
        'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
