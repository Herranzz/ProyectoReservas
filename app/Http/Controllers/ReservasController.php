<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Equipos;
use App\Models\User;
use App\Models\Inventario;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservas::all();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        

        $reserva = new Reservas();
        $equipos = Equipos::all();
        $users = User::all();
        $inventarios = Inventario::all();
        return view('reservas.create', compact('reserva', 'equipos', 'users'));
    }

    public function store(Request $request)
    {
        $reserva = new Reservas();
        $reserva->codigoProfesor = $request->codigoProfesor;
        $reserva->idEquipo = $request->idEquipo;
        $reserva->horaInicio = $request->horaInicio;
        $reserva->horaFin = $request->horaFin;
        $reserva->fechaReserva = $request->fechaReserva;

        $reserva->save();

        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reservado con éxito');
    }

    public function edit($id)
    {
        $reserva = Reservas::findOrFail($id);
        $equipos = Equipos::all();
        $users = User::all();
        return view('reservas.edit', compact('reserva', 'equipos', 'users'));
    }

    public function update(Request $request)
    {
        $reserva = Reservas::findOrFail($request->id);
        $reserva->codigoProfesor = $request->codigoProfesor;
        $reserva->idEquipo = $request->idEquipo;
        $reserva->horaInicio = $request->horaInicio;
        $reserva->horaFin = $request->horaFin;
        $reserva->fechaReserva = $request->fechaReserva;
        $reserva->save();
        
        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reserva actualizada correctamente');
    }

    public function destroy(Request $request)
    {
        $reserva = Reservas::findOrFail($request->id);
        $reserva->delete();
        return redirect()->to('/admin/gestion/reservas')->with('message', 'Reserva eliminada correctamente');
    }
}
