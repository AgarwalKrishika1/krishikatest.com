<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleSlider extends Model
{
    use HasFactory;

    protected $fillable = ['discount', 'category', 'link'];
}
