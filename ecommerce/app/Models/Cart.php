<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Products;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'quantity'];

    // Define relationships (optional)
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
