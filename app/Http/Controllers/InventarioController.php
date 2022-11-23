<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Ubicacion;
use App\Models\Equipos;
use App\Models\Estado;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $inventario = Inventario::all();
        return view('inventario.index', ['inventario' => $inventario]);
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
            'id' => 'unique:inventario'
        ], [
            'id.unique' => 'El número de inventario ya existe'
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

}