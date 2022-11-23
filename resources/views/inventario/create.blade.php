@extends('layouts.app')

@section('template_title', 'Añadir Equipo')

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

                        <div class="form-group row">
                            <label for="ubicacion" class="col-md-4 col-form-label text-md-right">{{ __('Ubicación') }}</label>
                            <div class="col-md-6">
                                <select id="ubicacion" type="text" class="form-control " name="ubicacion" value="{{ old('ubicacion') }}"
                                    required autocomplete="ubicacion" autofocus>
                                    @foreach ($ubicacion as $dato)
                                    <option value="{{ $dato->aula }}">{{ $dato->aula }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--traer el campo idEquipo de la tabla equipos-->
                        <div class="form-group row">
                            <label for="idEquipo" class="col-md-4 col-form-label text-md-right">{{ __('Equipo') }}</label>
                            <div class="col-md-6">
                                <select id="idEquipo" type="text" class="form-control " name="idEquipo" value="{{ old('idEquipo') }}"
                                    required autocomplete="idEquipo" autofocus>
                                    @foreach ($equipo as $dato)
                                    <option value="{{ $dato->id }}">{{ $dato->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control " name="descripcion" value="{{ old('descripcion') }}" autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <div class="alert alert-danger" role="alert"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                            <div class="col-md-6">
                                <select id="estado" type="text" class="form-control " name="estado" value="{{ old('estado') }}"
                                    required autocomplete="estado" autofocus>
                                    @foreach ($estado as $dato)
                                    <option value="{{ $dato->estado }}">{{ $dato->estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--boton registrar-->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                                <!--boton para cancelar-->
                                <a href="{{ route('inventario.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
