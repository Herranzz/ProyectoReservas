<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function gestion()
    {
        return view('admin.gestion');
    }

    public function profesores()
    {
        return view('admin.gestion.profesores');
    }
}
