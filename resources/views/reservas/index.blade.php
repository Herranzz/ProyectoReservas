@extends('layouts.app')

@section('template_title', 'Reservas')

@section('content')

    <div class="container">
        <!--boton agregar reserva-->
        <div class="row">
            <div class="col-12">
                <a href="{{ route('reservas.create') }}" class="btn btn-success">Agregar Reserva</a>
            </div>
        </div>
    </div>

    <div id='calendar' onclick=""></div>

    <!-- Modal -->
    <div class="modal fade" id="reserva" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="">

                        <div class="form-group">
                            <label for="codigoProfesor">Código Profesor</label>
                            <!--el input tiene que aparecer el codigo del profesor de la sesion-->
                            <input type="text" class="form-control" name="codigoProfesor" id="codigoProfesor"
                                placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label for="horaInicio">Hora Inicio</label>
                            <input type="time" class="form-control" name="horaInicio" id="horaInicio"
                                aria-describedby="helpId" placeholder="" required>

                            <label for="horaInicio">Hora Fin</label>
                            <input type="time" class="form-control" name="horaFin" id="horaFin"
                                aria-describedby="helpId" placeholder="" required>
                            <br>
                            <label for="fechaReserva">Fecha de Reserva</label>
                            <input type="datetime" class="form-control" name="fechaReserva" required
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="tiposEquipos">Tipos de Equipos</label>
                            <select id="tipo" type="text" class="form-control " name="tipo"
                                value="{{ old('tipo') }}" required autocomplete="tipo" autofocus>

                            </select>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnGuardar" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            let formulario = document.querySelector("form");
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                locale: 'es',
                defaultView: 'month',

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                
                //mostrar las reservas del usuario
                events: [
                    @foreach($reservas as $reserva)
                    {
                        title: '{{$reserva->codigoProfesor}}',
                        start: '{{$reserva->horaInicio}}',
                        end: '{{$reserva->horaFin}}',
                        color: '{{$reserva->color}}',
                        textColor: 'white',
                        id: '{{$reserva->id}}',
                    },
                    @endforeach
                    {
                        title: "peeppepe",
                        start: "2022-12-10 18:00:00",
                        end: "2022-12-10 23:00:00",
                        color: "blue",
                    }
                ],

                //evento que al hacer click en el calendario, vaya a la vista reservas.create y pinte la fecha en el input horaInicio
                dayClick: function(date, jsEvent, view) {
                    alert('Clicked on: ' + date.format());
                    //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    //alert('Current view: ' + view.name);
                    // change the day's background color just for fun
                    //$(this).css('background-color', 'red');
                    window.location.href = "{{ route('reservas.create') }}";
                    $('#horaInicio').val(date.format());
                    //$('#horaFin').val(date.format());
                    //$('#fechaReserva').val(date.format());
                },


            });


            /*document.getElementById("btnGuardar").addEventListener("click", function() {
                let horaInicio = document.getElementById("horaInicio").value;
                let horaFin = document.getElementById("horaFin").value;
                if (horaInicio > horaFin) {
                    alert("La hora de inicio no puede ser mayor que la hora de fin");
                } else {
                    axios.post("http://localhost/ProyectoFinal/public/reservas/crear", datos).then(
                        (respuesta) => {
                            $("#reserva").modal("hide");
                        }
                    ).catch(
                        (error) => {
                            if (error.response) {
                                console.log(error.response.data);
                            }
                        }
                    );
                }
            });*/
        });
    </script>

    <!--boton para volver al home-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <form method="get" action="{{ route('admin.gestion') }}">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check row justify-content-center">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ __('Volver') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
