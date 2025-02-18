<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Products;

class cart_item extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function items()
{
    return $this->hasMany(cart_item::class, 'cart_id');
}
}
