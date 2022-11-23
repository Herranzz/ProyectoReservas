@extends('layouts.app')

@section('title', 'Añadir Equipos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Añadir Equipo') }}</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf

                        <!--traer los tipos de la tabla externa tipos y pintarlo en un options-->
                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-md-6">
                                <select id="tipo" type="text" class="form-control " name="tipo" value="{{ old('tipo') }}"
                                    required autocomplete="tipo" autofocus>
                                    @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control " name="marca" value="{{ old('marca') }}" required autocomplete="marca" autofocus>

                                @error('marca')
                                    <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                            <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control " name="modelo" value="{{ old('modelo') }}" required autocomplete="modelo" autofocus>

                                @error('modelo')
                                    <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="numSerie" class="col-md-4 col-form-label text-md-right">{{ __('Serial') }}</label>

                            <div class="col-md-6">
                                <input id="numSerie" type="text" class="form-control " name="numSerie" value="{{ old('numSerie') }}" required autocomplete="numSerie" autofocus>

                                @error('numSerie')
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
                                <a href="{{ route('equipos.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
