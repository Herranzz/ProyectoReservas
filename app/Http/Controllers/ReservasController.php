<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservas::all();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        return view('reservas.create');
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
        return redirect()->route('reservas.index');
    }

    public function edit($id)
    {
        $reserva = Reservas::find($id);
        return view('reservas.edit', compact('reserva'));
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
        return redirect()->route('reservas.index');
    }

    public function destroy($id)
    {
        $reserva = Reservas::find($id);
        $reserva->delete();
        return redirect()->route('reservas.index');
    }
}
