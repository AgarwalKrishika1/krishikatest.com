<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\cart_item;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];
    public function items()
    {
        return $this->hasMany(cart_item::class);
    }
}
