<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Tipos;
use App\Models\User;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function index()
    {
        //mostrar todas las reservas del usuario de la sesion una vez cargue la vista
        $reservas = Reservas::where('codigoProfesor', auth()->user()->codigo)->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        //select count(*) from inventario where estado = 'libre' and idEquipo in (select id from equipos where tipo = 'portatil');
        $portatiles = DB::table('inventario')
            ->where('estado', 'libre')
            ->where('idEquipo', DB::table('equipos')->where('tipo', 'portatil')->value('id'))
            ->count();
        $sobremesa = DB::table('inventario')
            ->where('estado', 'libre')
            ->where('idEquipo', DB::table('equipos')->where('tipo', 'sobremesa')->value('id'))
            ->count();
        $tablets = DB::table('inventario')
            ->where('estado', 'libre')
            ->where('idEquipo', DB::table('equipos')->where('tipo', 'tablet')->value('id'))
            ->count();  

        $reserva = new Reservas();

        $users = User::all();
        $inventario = Inventario::all();
        $tipos = Tipos::all();
        return view('reservas.create', compact('reserva', 'users', 'inventario', 'tipos', 'portatiles', 'sobremesa', 'tablets'));
    }

    public function store(Request $request)
    {
        $reserva = new Reservas();
        $reserva->codigoProfesor = $request->codigoProfesor;
        $reserva->tipoEquipos = $request->tipoEquipos;
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
        $reserva->tipoEquipos = $request->tipoEquipos;
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
