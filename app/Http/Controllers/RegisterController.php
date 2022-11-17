<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request) {

        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->codigo = $request->codigo;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();
        
        return redirect()->to('/admin/gestion/usuarios');
    }

    public function edit($codigo)
    {
        $user = User::find($codigo);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->codigo);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->codigo = $request->codigo;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();
        
        return redirect()->to('/admin/gestion/usuarios');
    }

    //funcion para eliminar un usuario
    public function destroy(Request $request)
    {
        $user = User::find($request->codigo);
        $user->delete();
        return redirect()->to('/admin/gestion/usuarios');
    }
}
