@extends('layouts.app')

@section('title', 'Tipos de Estados')

@section('content')
    <!--tabla responsive-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Tipos de Estados') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <form method="get" action="{{ route('estados.create') }}">
                                                <!--Por motivos de seguridad se añade el siguiente @-->
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check row justify-content-center">
                                                            <button type="submit" class="btn btn-success">
                                                                <!--icono de agregar-->
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Estados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estados as $dato)
                                        <tr>
                                            <td>{{ $dato->id }}</td>
                                            <td>{{ $dato->estado }}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('estados.edit', $dato->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!--boton que lanza el modal-->
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modal-delete-{{ $dato->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @include('estados.delete')
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
        @endsection
