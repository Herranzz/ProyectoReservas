<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos;

class TiposController extends Controller
{
 
    public function index(Request $request)
    {
        $tipos = Tipos::all();
        return view('tipos.index', ['tipos' => $tipos]);
    }

    public function create()
    {
        return view('tipos.create');
    }

    public function store(Request $request) {

        //validar que el id y el tipo no se repita
        $request->validate([
            'id' => 'unique:tipos',
            'tipo' => 'unique:tipos'
        ], [
            'id.unique' => 'El id ya existe',
            'tipo.unique' => 'El tipo ya existe'
    ]);

        $tipo = new Tipos();
        $tipo->id = $request->id;
        $tipo->tipo = $request->tipo;

        $tipo->save();
        
        return redirect()->to('/admin/gestion/tipos')->with('message', 'Tipo creado correctamente');
    }

    public function edit($id)
    {
        $tipo = Tipos::find($id);
        return view('tipos.edit', ['tipo' => $tipo]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'tipo' => 'unique:tipos'
        ], [
            'tipo.unique' => 'El tipo ya existe'
    ]);

        $tipo = Tipos::findOrFail($request->id);
        $tipo->id = $request->id;
        $tipo->tipo = $request->tipo;

        $tipo->save();
        
        return redirect()->to('/admin/gestion/tipos')->with('message', 'Tipo actualizado correctamente');
    }

    public function destroy(Request $request)
    {
        $tipo = Tipos::find($request->id);
        $tipo->delete();
        return redirect()->to('/admin/gestion/tipos')->with('message', 'Tipo eliminado correctamente');
    }

}
