@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reservas') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('reservasAdmin.index') }}" method="get">
                                <div class="form-row">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="texto"
                                            value="{{ $texto }}" placeholder="Buscar...">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-info" value="Buscar">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <th scope="col">Código Profesor</th>
                                        <th scope="col">Nº Equipos</th>
                                        <th scope="col">Fecha y Hora de Reserva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($reservas) <= 0)
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <!--alerta de que no hay datos-->
                                                <div class="alert alert-danger" role="alert">
                                                    No hay registros de la búsqueda...
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($reservas as $dato)
                                            <tr>
                                                <td>{{ $dato->codigoProfesor }}</td>
                                                <td>{{ $dato->numEquipos }}</td>
                                                <td>{{ $dato->horaInicio }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!--paginacion de bootstrap-->
                            <div class="d-flex justify-content-end">
                                {{ $reservas->links() }}
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
                            <form method="get" action="{{ route('admin.gestion') }}">
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
            </div>
        @endsection