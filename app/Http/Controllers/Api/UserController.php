<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        
        if (is_null($users->first())) {
            return $this->response('error','¡Áun no hay usuarios!',200);
        }

        return $this->response('success','¡Usuarios encontrados!',200,$users);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|'
        ]);

        if($validate->fails()){
            return $this->response('error','¡Error de validación!',403,$validate->errors());   
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);
        
        return $this->response('success','Usuario agregado correctamento.',200,$user);   
    }

    public function show($id)
    {
        $user = User::find($id);
  
        if (is_null($user)) {
            return $this->response('error','¡Usuario no encontrado!',200);   
        }
        $user['isAdmin'] = $user->hasRole('admin');
        return $this->response('success','¡Usuario encontrado.!',200,$user);   
    }
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if (is_null($user)) {
            return $this->response('error','¡Usuario no encontrado!',200);
        }

        $user->update($request->all());
        
        return $this->response('success','Usuario actualizado correctamente.',200, $user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
  
        if (is_null($user)) {
            return $this->response('error','Usuario no encontrado!',200);
        }

        User::destroy($id);
        return $this->response('success','Usuario eliminado correctamente.',200);
    }
    public function search($name)
    {
        $users = User::where('name', 'like', '%'.$name.'%')
            ->latest()->get();

        if (is_null($users->first())) {
            
            return $this->response('error','Usuario no encontrado!',200);

        }
        return $this->response('success','Usuarios encontrados.',200,$users);

    }
    
}