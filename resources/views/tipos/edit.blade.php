@extends('layouts.app')

@section('title', 'Editar Tipo')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Editar Tipo') }}</div>

                <!--si el codigo del usuario ya esxiste en la base de datos mostrar-->

                <div class="card-body">

                    <form method="POST" action="{{ route('tipos.update', $tipo->id) }}">

                        <!--Por motivos de seguridad se añade el siguiente @-->

                        @csrf

                        @method('PUT')

                        <div class="form-group row">
    
                                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
    
                                <div class="col-md-6">
    
                                    <input id="tipo" type="text" class="form-control " name="tipo" value="{{ $tipo->tipo }}" required autocomplete="tipo" autofocus>
    
                                    @error('tipo')
    
                                        <div class="alert alert-danger" role="alert"> {{ $message }} </div>
    
                                    @enderror
    
                                </div>

                        </div>

                        <!--boton registrar-->

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Actualizar') }}

                                </button>

                                <!--boton para cancelar-->

                                <a href="{{ route('tipos.index') }}" class="btn btn-danger">Cancelar</a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection