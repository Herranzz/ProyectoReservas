<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;

class EquiposController extends Controller
{
    
    public function index(Request $request)
    {
        $equipos = Equipos::all();
        return view('equipos.index', ['equipos' => $equipos]);
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request) {

        $equipo = new Equipos();
        $equipo->tipo = $request->tipo;
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->numSerie = $request->numSerie;

        $equipo->save();
        
        return redirect()->to('/admin/gestion/equipos');
    }

    public function edit($id)
    {
        $equipo = Equipos::find($id);
        return view('equipos.edit', ['equipo' => $equipo]);
    }

    public function update(Request $request)
    {
        $equipo = Equipos::findOrFail($request->id);
        $equipo->tipo = $request->tipo;
        $equipo->marca = $request->marca;
        $equipo->modelo = $request->modelo;
        $equipo->numSerie = $request->numSerie;

        $equipo->save();
        
        return redirect()->to('/admin/gestion/equipos');
    }

    //funcion para eliminar un equipo
    public function destroy(Request $request)
    {
        $equipo = Equipos::findOrFail($request->id);
        $equipo->delete();
        return redirect()->to('/admin/gestion/equipos');
    }
}
