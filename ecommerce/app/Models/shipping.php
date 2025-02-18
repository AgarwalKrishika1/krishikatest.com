<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;


    protected $fillable = [
        "order_id",
        'address',
        'city',
        'postal_code',
    ] ;
}
