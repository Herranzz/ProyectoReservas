<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Ubicacion;
use App\Models\Equipos;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $texto = "";

        if($request->get("texto") != null){
            $texto = trim($request->get('texto'));
        }

        $builder = Inventario::orderBy('id');

        if($texto) {
            $builder->select('inventario.*')
            ->where('id','LIKE','%'.$texto.'%')
            ->orWhere('ubicacion','LIKE','%'.$texto.'%')
            ->orWhere('idEquipo','LIKE','%'.$texto.'%')
            ->orWhere('estado','LIKE','%'.$texto.'%');
        }

        $inventario = $builder->paginate(10);

        return view('inventario.index', compact('inventario','texto'));
    }

    public function create()
    {
        $inventario = new Inventario();

        $ubicacion = Ubicacion::all();
        $equipo = Equipos::all();
        $estado = Estado::all();
        return view('inventario.create', compact('inventario', 'ubicacion', 'equipo', 'estado'));
    }

    public function store(Request $request) {

        //validar que el id no se repita
        $request->validate([
            'id' => 'unique:inventario',
            'idEquipo' => 'unique:inventario'
        ], [
            'id.unique' => 'El número de inventario ya existe',
            'idEquipo.unique' => 'El id del equipo ya existe'
    ]);

        $inventario = new Inventario();
        $inventario->id = $request->id;
        $inventario->ubicacion = $request->ubicacion;
        $inventario->idEquipo = $request->idEquipo;
        $inventario->descripcion = $request->descripcion;
        $inventario->estado = $request->estado;

        $inventario->save();
        
        return redirect()->to('/admin/gestion/inventario')->with('message', 'Equipo añadido al inventario correctamente');
    }

    public function edit($id)
    {
        $ubicacion = Ubicacion::all();
        $equipo = Equipos::all();
        $estado = Estado::all();

        $inventario = Inventario::find($id);
        return view('inventario.edit', compact('inventario', 'ubicacion', 'equipo', 'estado'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'unique:inventario',
            //deje actualizar aunque el id sea el mismo
            'idEquipo' => 'unique:inventario,idEquipo,'.$request->id
        ], [
            'id.unique' => 'El número de inventario ya existe',
            'idEquipo.unique' => 'El id del equipo ya existe'
        ]);

        $inventario = Inventario::find($request->id);
        $inventario->ubicacion = $request->ubicacion;
        $inventario->idEquipo = $request->idEquipo;
        $inventario->descripcion = $request->descripcion;
        $inventario->estado = $request->estado;

        $inventario->save();

        return redirect()->to('/admin/gestion/inventario')->with('message', 'Equipo actualizado correctamente');
    }

    public function destroy($id)
    {
        $inventario = Inventario::find($id);
        $inventario->delete();

        return redirect()->to('/admin/gestion/inventario')->with('message', 'Equipo eliminado del inventario correctamente');
    }
    //funcion import csv
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file, 'r');

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            $inventario = new Inventario();
            $inventario->ubicacion = $column[0];
            $inventario->idEquipo = $column[1];
            $inventario->descripcion = $column[2];
            $inventario->estado = $column[3];

            $inventario->save();
        }

        return redirect()->to('/admin/gestion/inventario')->with('message', 'Inventario importado correctamente');
    }

}