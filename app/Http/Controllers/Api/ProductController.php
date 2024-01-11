<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->selectRaw("*,CONCAT('http://localhost:8000/images/', image) AS image")->get();
        
        if (is_null($products->first())) {
            return $this->response('error','¡Áun no hay productos!',200);
        }

        return $this->response('success','¡Productos encontrados!',200,$products);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'price' => 'required|decimal:2',
            'category_id' => 'required',
            'description' => 'required|string|',
            'image' => 'required',
            'user_id' => 'required'
        ]);

        if($validate->fails()){
            return $this->response('error','¡Error de validación!',403,$validate->errors());   
        }

        $product = Product::create($request->all());

        return $this->response('success','Producto agregado correctamento.',200,$product);   
    }

    public function show($id)
    {
        $product = Product::find($id);
  
        if (is_null($product)) {
            return $this->response('error','¡Producto no encontrado!',200);   
        }
        
        return $this->response('success','¡Producto encontrado.!',200,$product);   
    }
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if (is_null($product)) {
            return $this->response('error','¡Product no encontrado!',200);
        }

        $product->update($request->all());
        
        return $this->response('success','Producto actualizado correctamente.',200, $product);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
  
        if (is_null($product)) {
            return $this->response('error','Producto no encontrado!',200);
        }

        Product::destroy($id);
        return $this->response('success','Producto eliminado correctamente.',200);
    }
    public function search($name)
    {
        $products = Product::where('name', 'like', '%'.$name.'%')
            ->latest()->get();

        if (is_null($products->first())) {
            
            return $this->response('error','Producto no encontrado!',200);

        }
        return $this->response('success','Productos encontrados.',200,$products);

    }
}