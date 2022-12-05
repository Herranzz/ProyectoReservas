<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Tipos;
use App\Models\User;
use App\Models\Inventario;

class ReservasController extends Controller
{
    public function index()
    {
        //mostrar las reservas del usuario de la sesion
        $reservas = Reservas::where('codigoProfesor', auth()->user()->codigo)->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        //obtener mediante una consulta el numero de portatiles libres
        $portatiles = Inventario::orderBy('id');

        //select count(*) from inventario where estado = 'libre' and idEquipo in (select id from equipos where tipo = 'portatil');

        $portatiles->where('estado', 'libre')->where('idEquipo', 'in', function($query) {
            $query->select('id')->from('equipos')->where('tipo', 'portatil');
        })->count();
        

        //obtener mediante una consulta el numero de sobremesa libres
        $builder2 = Inventario::orderBy('id');

        $builder2->select('inventario.*')
        ->join('equipos', 'inventario.idEquipo', '=', 'equipos.id')
        ->join('tipos', 'equipos.tipo', '=', 'tipos.id')
        ->where('tipos.tipo', '=', 'Sobremesa')
        ->where('inventario.estado', '=', 'Libre')
        ->count();

        $sobremesas = $builder2->get();

        //obtener mediante una consulta el numero de tablets libres
        $builder3 = Inventario::orderBy('id');

        $builder3->select('inventario.*')
        ->join('equipos', 'inventario.idEquipo', '=', 'equipos.id')
        ->join('tipos', 'equipos.tipo', '=', 'tipos.id')
        ->where('tipos.tipo', '=', 'Tablet')
        ->where('inventario.estado', '=', 'Libre')
        ->count();

        $tablets = $builder3->get();

        $reserva = new Reservas();

        $users = User::all();
        $inventario = Inventario::all();
        $tipos = Tipos::all();
        return view('reservas.create', compact('reserva', 'users', 'inventario', 'tipos', 'portatiles', 'sobremesas', 'tablets'));
    }

    public function store(Request $request)
    {
        $reserva = new Reservas();
        $reserva->codigoProfesor = $request->codigoProfesor;
        $reserva->numEquipos = $request->numEquipos;
        $reserva->horaInicio = $request->horaInicio;
        $reserva->color = $request->color;

        $reserva->save();

        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reservado con éxito');
    }

    public function edit($id)
    {
        $reserva = Reservas::findOrFail($id);
        $users = User::all();
        return view('reservas.edit', compact('reserva', 'users'));
    }

    public function update(Request $request)
    {
        $reserva = Reservas::findOrFail($request->id);
        $reserva->codigoProfesor = $request->codigoProfesor;
        $reserva->numEquipos = $request->numEquipos;
        $reserva->horaInicio = $request->horaInicio;
        $reserva->color = $request->color;

        $reserva->save();
        
        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reserva actualizada correctamente');
    }

    public function show(Reservas $reserva)
    {
        $reserva = Reservas::all();
        return response()->json($reserva);
    }

    public function destroy(Request $request)
    {
        $reserva = Reservas::findOrFail($request->id);
        $reserva->delete();
        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reserva eliminada correctamente');
    }
}
