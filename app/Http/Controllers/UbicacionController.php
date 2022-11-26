<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = "";

        if($request->get("texto") != null){
            $texto = trim($request->get('texto'));
        }

        $builder = Ubicacion::orderBy('id');

        if($texto) {
            $builder->select('ubicaciones.*')
            ->where('id','LIKE','%'.$texto.'%')
            ->orWhere('aula','LIKE','%'.$texto.'%');
        }

        $ubicaciones = $builder->paginate(5);

        return view('ubicaciones.index',compact('ubicaciones','texto'));
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request) {
        //validar que el id y el aula no se repitan
        $request->validate([
            'id' => 'unique:ubicaciones',
            'aula' => 'unique:ubicaciones'
        ], [
            'id.unique' => 'El id ya existe',
            'aula.unique' => 'El aula ya existe'
    ]);


        $ubicacion = new Ubicacion();
        $ubicacion->id = $request->id;
        $ubicacion->aula = $request->aula;

        $ubicacion->save();
        
        return redirect()->to('/admin/gestion/ubicaciones')->with('message', 'Ubicacion creada correctamente');
    }

    public function edit($id)
    {
        $ubicacion = Ubicacion::find($id);
        return view('ubicaciones.edit', ['ubicacion' => $ubicacion]);
    }

    public function update(Request $request)
    {
        $ubicacion = Ubicacion::findOrFail($request->id);
        $ubicacion->id = $request->id;
        $ubicacion->aula = $request->aula;

        $ubicacion->save();
        
        return redirect()->to('/admin/gestion/ubicaciones')->with('message', 'Ubicacion actualizada correctamente');
    }

    //funcion para eliminar una ubicacion
    public function destroy(Request $request)
    {
        $ubicacion = Ubicacion::find($request->id);
        $ubicacion->delete();
        return redirect()->to('/admin/gestion/ubicaciones')->with('message', 'Ubicacion eliminada correctamente');
    }

    //funcion import csv
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file, 'r');

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $ubicacion = new Ubicacion();
            $ubicacion->id = $column[0];
            $ubicacion->aula = $column[1];
            $ubicacion->save();
        }

        return redirect()->to('/admin/gestion/ubicaciones')->with('message', 'Ubicaciones importadas correctamente');
    }
}
