<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = ['name', 'price', 'description', 'category', 'image'];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
