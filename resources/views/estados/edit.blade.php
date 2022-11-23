@extends('layouts.app')

@section('title', 'Editar Estado')

@section('content')

<!--lo de antes, pero con un alert cuando se actualiza-->

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Editar Estado') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('estados.update', $estado->id) }}">

                        @csrf

                        @method('PUT')

                        <div class="form-group row">
                                
                                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
    
                                    <div class="col-md-6">
    
                                        <input id="estado" type="text" class="form-control " name="estado" value="{{ $estado->estado }}" required autocomplete="estado" autofocus>
    
                                        @error('estado')
    
                                            <div class="alert alert-danger" role="alert"> {{ $message }} </div>
    
                                        @enderror
    
                                    </div>

                        </div>

                        <div class="form-group row">
                                
                                <div class="col-md-6 offset-md-4">
    
                                    <button type="submit" class="btn btn-primary">
    
                                        {{ __('Actualizar') }}
    
                                    </button>
    
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