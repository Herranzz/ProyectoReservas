<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;
use App\Models\Tipos;
use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = "";

        if($request->get("texto") != null){
            $texto = trim($request->get('texto'));
        }

        $builder = Equipos::orderBy('id');

        if($texto) {
            $builder->select('equipos.*')
            ->where('id','LIKE','%'.$texto.'%')
            ->orWhere('tipo','LIKE','%'.$texto.'%')
            ->orWhere('marca','LIKE','%'.$texto.'%')
            ->orWhere('modelo','LIKE','%'.$texto.'%')
            ->orWhere('numSerie','LIKE','%'.$texto.'%');
        }

        $equipos = $builder->paginate(10);

        return view('equipos.index', compact('equipos','texto'));
    }

    public function create()
    {
        $equipo = new Equipos();

        $tipos = Tipos::all();
        return view('equipos.create', compact('equipo', 'tipos'));

    }

    public function store(Request $request) {

        //validar que el numSerie no se repita
        $request->validate([
            'numSerie' => 'unique:equipos'
        ], [
            'numSerie.unique' => 'El número de serie ya existe'
    ]);

        $equipo = new Equipos();
        $equipo->tipo = $request->tipo;
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->numSerie = $request->numSerie;

        $equipo->save();
        
        return redirect()->to('/admin/gestion/equipos')->with('message', 'Equipo añadido correctamente');
    }

    public function edit($id)
    {
        $tipos = Tipos::all();

        $equipo = Equipos::find($id);
        return view('equipos.edit', compact('equipo', 'tipos'));
    }

    public function update(Request $request)
    {
        /*$request->validate([
            'numSerie' => 'unique:equipos'
        ], [
            'numSerie.unique' => 'El número de serie ya existe'
    ]);*/

        $equipo = Equipos::findOrFail($request->id);
        $equipo->tipo = $request->tipo;
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->numSerie = $request->numSerie;

        $equipo->save();
        
        return redirect()->to('/admin/gestion/equipos')->with('message', 'Equipo actualizado correctamente');
    }

    //funcion para eliminar un equipo
    public function destroy(Request $request)
    {
        $equipo = Equipos::findOrFail($request->id);
        $equipo->delete();
        return redirect()->to('/admin/gestion/equipos')->with('message', 'Equipo eliminado correctamente');
    }

    //funcion import csv
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file, 'r');

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $equipo = new Equipos();
            $equipo->tipo = $column[0];
            $equipo->marca = $column[1];
            $equipo->modelo = $column[2];
            $equipo->numSerie = $column[3];

            $equipo->save();
        }

        return redirect()->to('/admin/gestion/equipos')->with('message', 'Equipos importados correctamente');
    }
}
