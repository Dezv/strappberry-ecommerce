<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
   public function store(){
    $validate = Validator::make($request->all(), [
        'products' => 'required',
        'total_cart' => 'required|decimal:2'
    ]);

    if($validate->fails()){
        return $this->response('error','¡Error de validación!',403,$validate->errors());   
    }

    $product = Product::create([
        'products' => $request->products,
        'total_cart' => $request->total_cart,
        'abandoned_cart' => false
    ]);

    return $this->response('success','Carrtio creado correctamento.',200,$product);   
   }
    
}