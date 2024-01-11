<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        
        if (is_null($orders->first())) {
            return $this->response('error','¡Áun no hay productos!',200);
        }

        return $this->response('success','¡Productos encontrados!',200,$orders);
    }
   public function store(Request $request){
    $validate = Validator::make($request->all(), [
        'id_cart' => 'required'
    ]);
    if($validate->fails()){
        return $this->response('error','¡Error de validación!',403,$validate->errors());   
    }
    $cart = Cart::find($request->id_cart);
    $cart = Order::create([
        'cart_id' => $request->id_cart,
        'total_cart' => $cart->total_cart,
        'total_ship' => 123,
        'total_order' => ($cart->total_cart + 123),
    ]);

    $cart->update([
        'sale' => true, 
        'abandoned_cart' => false
    ]);

    return $this->response('success','Orden creada correctamento.',200,$cart);   
   }
   public function show($id)
   {
       $cart = Order::find($id);
 
       if (is_null($cart)) {
           return $this->response('error','Orden no encontrada!',200);   
       }
       
       return $this->response('success','Orden encontrada.!',200,$cart);   
   }

    
}