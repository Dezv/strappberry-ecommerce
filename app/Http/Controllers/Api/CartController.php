<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Validator;

class CartController extends Controller
{
   public function store(Request $request){
    $validate = Validator::make($request->all(), [
        'products' => 'required'
    ]);
    if($validate->fails()){
        return $this->response('error','¡Error de validación!',403,$validate->errors());   
    }
    
    $total_cart = Product::find($request->products)->sum('price');
    $cart = Cart::create([
        'products' => json_encode($request->products),
        'total_cart' => $total_cart,
        'abandoned_cart' => false,
        'sale' => false
    ]);

    return $this->response('success','Carrtio creado correctamento.',200,$cart);   
   }
   public function show($id)
   {
       $cart = Cart::find($id);
 
       if (is_null($cart)) {
           return $this->response('error','Carrito no encontrado!',200);   
       }
       
       return $this->response('success','Carrito encontrado.!',200,$cart);   
   }
    
}