@extends('layouts.app')

@section('template_title')
    Update User
@endsection

@section('content')
    <!-- formulario de registro codigo, email, password, nombre y apellido-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrar') }}</div>
    
                    <div class="card-body">
                        <form method="PUT" action="{{ route('users.update', $user->codigo) }}">
                            <!--Por motivos de seguridad se añade el siguiente @-->
                            @csrf
    
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
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código Profesor') }}</label>
    
                                <div class="col-md-6">
                                    <input id="codigo" type="text" class="form-control " name="codigo" value="{{ $user->codigo }}" autocomplete="codigo" readonly>
    
                                </div>
                            </div>
    
                            <div class="form-group row">                         
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control " name="email" value="{{ $user->email }}" required autocomplete="email">

                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
    
                                <div class="col-md-6">
                                    <select id="role" type="text" class="form-control " name="role" value="{{ $user->role }}" required autocomplete="role" autofocus>
                                        <option value="profesor">Profesor</option>
                                        <option value="admin">Admin</option>
                                    </select>
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
