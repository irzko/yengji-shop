<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'unit_price', 'image', 'sold', 'remaining', 'amount', 'description'];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
}
