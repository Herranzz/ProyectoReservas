@extends('layouts.app')

@section('title', 'Reservar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reservar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <!--Por motivos de seguridad se añade el siguiente @-->
                            @csrf

                            <div class="form-group row">
                                <!--codigo profesor-->
                                <!--el input tiene que aparecer el codigo del profesor de la sesion-->
                                <input type="text" class="form-control" name="codigoProfesor" id="codigoProfesor"
                                    value='{{ auth()->user()->codigo }}' placeholder="" hidden>

                            </div>

                            <!--seelct con los equipos libres-->
                            <div class="form-group row">
                                <label for="idEquipo">Equipos</label>
                                <input type="text" class="form-control" name="idEquipo" id="idEquipo"
                                    placeholder="" required>
                            </div>

                            <!--traer los tipos de la tabla externa tipos y pintarlo en un options-->
                            <div class="form-group row">
                                <label for="tipo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                <div class="col-md-6">
                                    <select id="tipo" type="text" class="form-control " name="tipo"
                                        value="{{ old('tipo') }}" required autocomplete="tipo" autofocus>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>
                                    <!--numero de portatiles-->
                                    <label for="numeroPortatiles"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Numero de portatiles') }}</label>
                                    <select id="numeroPortatiles" name="numeroPortatiles">
                                        <!--meter la siguiente consulta sql en el option: select count(*) from inventario where estado = 'libre' and idEquipo in (select id from equipos where tipo = 'portatil');-->
                                        <?php
                                        $portatiles = DB::table('inventario')
                                            ->where('estado', '=', 'libre')
                                            ->where('idEquipo', 'in', function ($query) {
                                                $query
                                                    ->select('id')
                                                    ->from('equipos')
                                                    ->where('tipo', 'portatil');
                                            })
                                            ->count();
                                        
                                        ?>

                                            <option value="{{ $portatiles }}">{{ $portatiles }}</option>
                                        
                                    </select>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="horaInicio"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Hora Inicio') }}</label>

                                <div class="col-md-6">
                                    <input type="datetime" class="form-control" name="horaInicio" id="horaInicio"
                                        min="08:00" max="22:00" value="<?php echo date('Y-m-d H:i:s'); ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="horaFin"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Hora Fin') }}</label>

                                <div class="col-md-6">
                                    <input type="datetime" class="form-control" name="horaFin" id="horaFin" min="08:00"
                                        max="22:00" value="<?php echo date('Y-m-d H:i:s'); ?>" required>
                                </div>
                            </div>

                            <!--campo color-->
                            <div class="form-group row">
                                <label for="color"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                <div class="col-md-2">
                                    <input type="color" class="form-control" name="color" id="color" value="#ff0000"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row" hidden>
                                <label for="fechaReserva"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Fecha Reserva') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="fechaReserva" id="fechaReserva"
                                        value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <!--boton registrar-->
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reservar') }}
                                    </button>
                                    <!--boton para cancelar-->
                                    <a href="{{ route('reservas.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
