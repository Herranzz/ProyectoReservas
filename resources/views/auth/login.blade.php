@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- formulario de login-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf

                        <div class="form-group row">
                            <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código Profesor') }}</label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control " name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        @error('message')
                            <div class="alert alert-danger" role="alert">Codigo o password incorrectos, inténtelo de nuevo</div>
                        @enderror

                        <!-- boton para iniciar sesión -->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check row justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection