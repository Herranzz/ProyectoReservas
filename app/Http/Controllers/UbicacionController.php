<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    
    public function index(Request $request)
    {
        $ubicaciones = Ubicacion::all();
        return view('ubicaciones.index', ['ubicaciones' => $ubicaciones]);
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request) {

        $ubicacion = new Ubicacion();
        $ubicacion->id = $request->id;
        $ubicacion->aula = $request->aula;

        $ubicacion->save();
        
        return redirect()->to('/admin/gestion/ubicaciones');
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
        
        return redirect()->to('/admin/gestion/ubicaciones');
    }

    //funcion para eliminar una ubicacion
    public function destroy(Request $request)
    {
        $ubicacion = Ubicacion::find($request->id);
        $ubicacion->delete();
        return redirect()->to('/admin/gestion/ubicaciones');
    }
}
