<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
        
        public function index(Request $request)
        {
            $estados = Estado::all();
            return view('estados.index', ['estados' => $estados]);
        }
    
        public function create()
        {
            return view('estados.create');
        }
    
        public function store(Request $request) {
    
            //validar que el id no se repita
            $request->validate([
                'id' => 'unique:estados',
                'estado' => 'unique:estados'
            ], [
                'id.unique' => 'El id ya existe',
                'estado.unique' => 'El estado ya existe'
        ]);

            $estado = new Estado();
            $estado->id = $request->id;
            $estado->estado = $request->estado;
    
            $estado->save();
            
            return redirect()->to('/admin/gestion/estados')->with('message', 'Estado creado correctamente');
        }
    
        public function edit($id)
        {
            $estado = Estado::find($id);
            return view('estados.edit', ['estado' => $estado]);
        }
    
        public function update(Request $request)
        {
            $request->validate([
                'estado' => 'unique:estados'
            ], [
                'estado.unique' => 'El estado ya existe'
        ]);

            $estado = Estado::findOrFail($request->id);
            $estado->id = $request->id;
            $estado->estado = $request->estado;
    
            $estado->save();
            
            return redirect()->to('/admin/gestion/estados')->with('message', 'Estado actualizado correctamente');
        }
    
        //funcion para eliminar un estado
        public function destroy(Request $request)
        {
            $estado = Estado::find($request->id);
            $estado->delete();
            return redirect()->to('/admin/gestion/estados')->with('message', 'Estado eliminado correctamente');
        }
}
