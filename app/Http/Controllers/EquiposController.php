<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;
use App\Models\Tipos;

class EquiposController extends Controller
{
    
    public function index(Request $request)
    {
        $equipos = Equipos::all();
        return view('equipos.index', ['equipos' => $equipos]);
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
        $request->validate([
            'numSerie' => 'unique:equipos'
        ], [
            'numSerie.unique' => 'El número de serie ya existe'
    ]);

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
}
