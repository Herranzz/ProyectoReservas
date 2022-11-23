@extends('layouts.app')

@section('title', 'Crear Estado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nuevo Estado') }}</div>

                <!--si el codigo del usuario ya esxiste en la base de datos mostrar-->
                <div class="card-body">
                    <form method="POST" action="">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf

                          <div class="form-group row">

                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control " name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                    <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                                @enderror

                            </div>

                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                            <div class="col-md-6">
                                <input id="estado" type="text" class="form-control " name="estado" value="{{ old('estado') }}" required autocomplete="estado" autofocus>

                                @error('estado')
                                    <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                                @enderror

                            </div>
                            
                        </div>

                        <!--boton registrar-->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                                <!--boton para cancelar-->
                                <a href="{{ route('estados.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection