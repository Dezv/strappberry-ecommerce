<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Cart extends Model
{
    use HasFactory, HasUlids;
    protected $fillable = [
        'products',
        'total_cart',
        'abandoned_cart'
    ];
}
