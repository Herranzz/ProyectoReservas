<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'equipos';

    protected $fillable = [
        'id',
        'tipo',
        'marca',
        'modelo',
        'numSerie',
    ];
}
