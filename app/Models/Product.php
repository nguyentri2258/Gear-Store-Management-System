<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
        'category_id',
        'information',
        'description',
        'note',
        'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart_items(){
        return $this->hasMany(CartItem::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
