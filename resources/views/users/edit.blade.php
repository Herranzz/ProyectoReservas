@extends('layouts.app')

@section('title', 'Editar Profesor')

@section('content')
    <!-- formulario de registro codigo, email, password, nombre y apellido-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Actualizar') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->codigo) }}">
                            <!--Por motivos de seguridad se añade el siguiente @-->
                            @csrf
                            @method('PUT')
                              <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
    
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control " name="nombre" value="{{ $user->nombre }}" required autocomplete="nombre" autofocus>
    
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
    
                                <div class="col-md-6">
                                    <input id="apellido" type="text" class="form-control " name="apellido" value="{{ $user->apellido }}" required autocomplete="apellido" autofocus>
    
                                </div>
                            </div>
    
                            <div class="form-group row">                         
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control " name="email" value="{{ $user->email }}" required autocomplete="email">

                                </div>
                            </div>
    
                            <!--boton registrar-->
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                    <!--boton para cancelar-->
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
