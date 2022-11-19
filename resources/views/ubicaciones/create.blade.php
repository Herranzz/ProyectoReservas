@extends('layouts.app')

@section('template_title')
    Create Ubicacion
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva Ubicación') }}</div>

                <!--si el codigo del usuario ya esxiste en la base de datos mostrar-->
                <div class="card-body">
                    <form method="POST" action="">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf

                          <div class="form-group row">
                            <label for="aula" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Aula') }}</label>

                            <div class="col-md-6">
                                <input id="aula" type="text" class="form-control " name="aula" value="{{ old('aula') }}" required autocomplete="aula" autofocus>

                                @error('aula')
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
                                <a href="{{ route('ubicaciones.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
