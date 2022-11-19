@extends('layouts.app')

@section('template_title')
    Update Ubicacione
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ubicaciones.update', $ubicacion->id) }}">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf
                        @method('PUT')
                          <div class="form-group row">
                            <label for="aula" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Aula') }}</label>

                            <div class="col-md-6">
                                <input id="aula" type="text" class="form-control " name="aula" value="{{ $ubicacion->aula }}" required autocomplete="aula" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('IdAula') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control " name="id" value="{{ $ubicacion->id }}" required autocomplete="id" readonly>

                            </div>
                        </div>

                        <!--boton registrar-->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
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
