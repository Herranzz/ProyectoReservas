@extends('layouts.app')

@section('title', 'ADMIN')

<!--panel de control de administrador, que tenga cards de registro, profesores, reservas, ubicaciones, equipos-->
@section('content')
    <div class="container" id="page-content" margin-top="30px">
        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFVhtP7hkZKr0mvYRJXBHtU6kUBk68ki65rQ&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="profesores">
                    <div class="card-body" style="height: 33%; background-color:#fdebd0;">
                        <h5 class="card-title ">Profesores</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('users.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbPAZRywkfYAAXrpGAFruN6DWO81k1lbG1Og&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color: #f9e79f;">
                        <h5 class="card-title ">Ubicaciones</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('ubicaciones.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ40h3bQY2oGNr0quqLHrhWB_RbH02SyTor-w&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color:#DAF7A6;">
                        <h5 class="card-title">Equipos</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('equipos.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9nyWWXLtdQzQf8xeP43HkcIceKHQzslUM-Q&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color:#DAF7A6;">
                        <h5 class="card-title">Tipos de Equipos</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('tipos.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ40h3bQY2oGNr0quqLHrhWB_RbH02SyTor-w&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color: #a6b1f7;">
                        <h5 class="card-title ">Inventario de Equipos</h5>
                        <a href="{{ route('inventario.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkJ2e-Bh9DKBWHvUK9J1J6GBZpg_fYKDNNcA&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color: #a6daf7;">
                        <h5 class="card-title ">Estados</h5>
                        <a href="{{ route('estados.index') }}" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem; height: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ40h3bQY2oGNr0quqLHrhWB_RbH02SyTor-w&usqp=CAU"
                        style="height: 62%;" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 33%; background-color: #a6daf7;">
                        <h5 class="card-title ">Reservas</h5>
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--boton para volver al index de admin-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <form method="get" action="{{ route('admin.index') }}">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check row justify-content-center">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Volver') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
