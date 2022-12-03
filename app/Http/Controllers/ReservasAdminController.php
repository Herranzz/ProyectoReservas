<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class ReservasAdminController extends Controller
{
    public function index(Request $request)
    {
        $texto = "";

        if($request->get("texto") != null){
            $texto = trim($request->get('texto'));
        }

        $builder = Reservas::orderBy('id');

        if($texto) {
            $builder->select('reservas.*')
            ->where('id','LIKE','%'.$texto.'%')
            ->orWhere('codigoProfesor','LIKE','%'.$texto.'%')
            ->orWhere('idEquipo','LIKE','%'.$texto.'%')
            ->orWhere('horaInicio','LIKE','%'.$texto.'%')
            ->orWhere('horaFin','LIKE','%'.$texto.'%')
            ->orWhere('fechaReserva','LIKE','%'.$texto.'%');
        }

        $reservas = $builder->paginate(10);

        return view('reservasAdmin.index', compact('reservas','texto'));
    }
}
