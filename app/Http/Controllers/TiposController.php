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

        $tipo = new Tipos();
        $tipo->id = $request->id;
        $tipo->tipo = $request->tipo;

        $tipo->save();
        
        return redirect()->to('/admin/gestion/tipos');
    }

    public function edit($id)
    {
        $tipo = Tipos::find($id);
        return view('tipos.edit', ['tipo' => $tipo]);
    }

    public function update(Request $request)
    {
        $tipo = Tipos::findOrFail($request->id);
        $tipo->id = $request->id;
        $tipo->tipo = $request->tipo;

        $tipo->save();
        
        return redirect()->to('/admin/gestion/tipos');
    }

    public function destroy(Request $request)
    {
        $tipo = Tipos::find($request->id);
        $tipo->delete();
        return redirect()->to('/admin/gestion/tipos');
    }

}
