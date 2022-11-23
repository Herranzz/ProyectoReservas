@extends('layouts.app')

@section('title', 'Ubicaciones')

@section('content')
    <!--tabla responsive-->

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-9">

                <div class="card">

                    <div class="card-header">{{ __('Ubicaciones') }}</div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>
                                            <form method="get" action="{{ route('ubicaciones.create') }}">
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
                                        <!--campo para argregar un archivo csv-->
                                        <form method="post" action="#" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row" style="width: 80%;">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check row justify-content-center">
                                                        <input type="file" name="file" class="form-control">
                                                    </div>
                                                </div>
                                                <!--icono de importar dentro de un boton-->
                                                <button class="btn btn-success" type="submit">
                                                    <i class="fas fa-file-import"></i>
                                                </button>
                                                <!--boton para resetear el archivo que hay en el input-->
                                                <button type="reset" class="btn btn-dark">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </tr>
                                    <tr>

                                        <th scope="col">Id</th>

                                        <th scope="col">Aula</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($ubicaciones as $dato)
                                        <tr>

                                            <td>{{ $dato->id }}</td>

                                            <td>{{ $dato->aula }}</td>

                                            <td>

                                                <form action="{{ route('ubicaciones.destroy', $dato->id) }}" id="delform"
                                                    method="POST">

                                                    <a class="btn btn-primary"
                                                        href="{{ route('ubicaciones.edit', $dato->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    @csrf

                                                    {{ method_field('DELETE') }}


                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

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
        @endsection
