<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
    
    public function create()
    {
        return view('users.create');
    }

}
