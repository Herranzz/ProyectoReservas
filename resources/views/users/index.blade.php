@extends('layouts.app')

@section('title', 'Profesores')

@section('content')

<!--tabla responsive-->

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Profesores') }}</div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>
                                        <form method="get" action="{{ route('users.create') }}">
                                            <!--Por motivos de seguridad se añade el siguiente @-->
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check row justify-content-center">
                                                        <button type="submit" class="btn btn-success">
                                                            {{ __('Registrar') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </th>
                                </tr>
                                <tr>

                                    <th scope="col">Nombre</th>

                                    <th scope="col">Apellido</th>

                                    <th scope="col">Código</th>

                                    <th scope="col">Email</th>

                                    <th scope="col">Role</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($users as $dato)

                                    <tr>

                                        <td>{{ $dato->nombre }}</td>

                                        <td>{{ $dato->apellido }}</td>

                                        <td>{{ $dato->codigo }}</td>

                                        <td>{{ $dato->email }}</td>

                                        <td>{{ $dato->role }}</td>

                                        <td>

                                            <form action="{{ route('users.destroy', $dato->codigo) }}" method="POST">

                                                <a class="btn btn-primary" href="{{ route('users.edit', $dato->codigo) }}">Editar</a>

                                                @csrf

                                                {{ method_field('DELETE') }}
                                        

                                                <button type="submit" class="btn btn-danger">Eliminar</button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

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

    <!--codigo js que pida confirmación al pulsar el boton eliminar una vez borrado saque un alert de exito con un modal de bootstrap-->


@endsection
