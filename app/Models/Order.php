<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    use HasFactory, HasUlids;
    protected $fillable = [
        'cart_id',
        'total_cart',
        'total_ship',
        'total_order'
    ];
    public function cart(){
        return $this->hasOne(Cart::class);
    }
}
