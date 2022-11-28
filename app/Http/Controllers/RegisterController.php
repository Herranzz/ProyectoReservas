<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $texto = "";
        
        if($request->get("texto") != null){
            $texto = trim($request->get('texto'));
        }

        $builder = User::orderBy('codigo');

        if($texto) {
            $builder->select('users.*')
            ->where('nombre','LIKE','%'.$texto.'%')
            ->orWhere('apellido','LIKE','%'.$texto.'%')
            ->orWhere('codigo','LIKE','%'.$texto.'%')
            ->orWhere('email','LIKE','%'.$texto.'%')
            ->orWhere('role','LIKE','%'.$texto.'%');
        }

        $users = $builder->paginate(5);

        return view('users.index',compact('users','texto'));

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request) {
        //validar que el codigo y el email no se repita
        $request->validate([
            'codigo' => 'unique:users',
            'email' => 'unique:users'
        ], [
            'codigo.unique' => 'El codigo ya existe',
            'email.unique' => 'El email ya existe'
    ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->codigo = $request->codigo;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();
        
        return redirect()->to('/admin/gestion/usuarios')->with('message', 'Profesor creado correctamente');
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
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
        
        return redirect()->to('/admin/gestion/usuarios')->with('message', 'Profesor actualizado correctamente');
    }

    //funcion para eliminar un usuario
    public function destroy(Request $request)
    {
        $user = User::find($request->codigo);
        $user->delete();
        return redirect()->to('/admin/gestion/usuarios')->with('message', 'Profesor eliminado correctamente');
    }

    //funcion import csv
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file, 'r');

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $user = new User();
            $user->nombre = $column[0];
            $user->apellido = $column[1];
            $user->codigo = $column[2];
            $user->email = $column[3];
            $user->password = $column[4];
            $user->role = $column[5];
            $user->save();
        }

        return redirect()->to('/admin/gestion/usuarios')->with('message', 'Profesores importados correctamente');
    }
}