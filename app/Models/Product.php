<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Product extends Model
{
    use HasFactory, HasUlids;
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'image',
        'user_id'
    ];

    public function category(){
        return $this->hasOne(Category::class);
    }
}
