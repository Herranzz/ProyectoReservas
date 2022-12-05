@extends('layouts.app')

@section('title', 'Reservar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="alert alert-warning" id="alert">
                      <strong>Cuidado!</strong> Ten en cuenta que tienes que elegir una hora que aún esté disponible en el día de hoy.
                    </div>
                  </div>
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

                            <!--traer los tipos de la tabla externa tipos y pintarlo en un options-->
                            <div class="form-group row">
                                <label for="tipo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                <div class="col-md-3">
                                    <select id="tipo" type="text" class="form-control " name="tipo"
                                        value="{{ old('tipo') }}" required autocomplete="tipo" autofocus>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <select id="numEquipos" name="numEquipos" title="equipos disponibles" required>
                                    
                                </select>
                            </div>

                            <div class="form-group row">
                                <label for="horaInicio"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Fecha y Hora') }}</label>

                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="fecha" id="fecha"
                                        min="08:00" max="22:00" value="<?php echo date('Y-m-d'); ?>" disabled required>
                                </div>

                                <!--select con 6 options cuyo valor son las horas de 8:00:00 a 14:00:00-->
                                <select id="hora" name="hora" title="horas del día" required>
                                    <option value="23:00:00">Seleccionar</option>
                                    <option value="08:00:00">1</option>
                                    <option value="09:00:00">2</option>
                                    <option value="10:00:00">3</option>
                                    <option value="11:00:00">4</option>
                                    <option value="12:00:00">5</option>
                                    <option value="21:00:00">6</option>
                                </select>

                                <input type="horaInicio" class="form-control" name="horaInicio" id="horaInicio"
                                    value=""  autocomplete="horaInicio" autofocus hidden>
                            </div>



                            <!--campo color-->
                            <div class="form-group row">
                                <label for="color"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                <div class="col-md-2">
                                    <input type="color" class="form-control" name="color" id="color" value="#3baebc"
                                        required>
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
        //pintar la fecha y la hora seleccionada en el input horaInicio (la hora de forma dinamica)
        var fecha = document.getElementById("fecha").value;

        //actualizar el valor del input horaInicio a la vez que se elige otro option en el select hora
        document.getElementById("hora").addEventListener("change", function () {
            var hora = document.getElementById("hora").value;
            document.getElementById("horaInicio").value = fecha + " " + hora;
        });

        //no dejar reservar si la hora elegida en el select ya ha pasado
        document.getElementById("hora").addEventListener("change", function () {
            var hora = document.getElementById("hora").value;
            var fecha = document.getElementById("fecha").value;
            var fechaHora = fecha + " " + hora;
            var fechaHoraActual = new Date();
            var fechaHoraElegida = new Date(fechaHora);
                //mostrar el alert con id alert solo cuando se seleccione un option en el select, no mostrarlo al cargar la pagina
                if (document.getElementById("hora").value != "23:00:00") {
                    if (fechaHoraElegida < fechaHoraActual) {
                        document.getElementById("alert").style.display = "block";
                        document.getElementById("hora").value = "23:00:00";
                    } else {
                        document.getElementById("alert").style.display = "none";
                    }
                }
        });

    </script>
@endsection
