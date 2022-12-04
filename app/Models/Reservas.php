<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'codigoProfesor',
        'idEquipo',
        'horaInicio',
        'horaFin',
        'color',
        'fechaReserva'
    ];
}
