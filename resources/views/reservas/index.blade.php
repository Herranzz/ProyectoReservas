@extends('layouts.app')

@section('template_title', 'Reservas')

@section('content')

    <div id='calendar'></div>

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
                            <input type="text" class="form-control" name="codigoProfesor" id="codigoProfesor" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label for="horaInicio">Hora Inicio</label>
                            <input type="time" class="form-control" name="horaInicio" id="horaInicio" aria-describedby="helpId" placeholder="" required>
                            
                            <label for="horaInicio">Hora Fin</label>
                            <input type="time" class="form-control" name="horaFin" id="horaFin" aria-describedby="helpId" placeholder="" required>
                            <br>
                            <label for="fechaReserva">Fecha de Reserva</label>
                            <input type="datetime" class="form-control" name="fechaReserva"  required value="<?php echo date("Y-m-d");?>">
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
                defaultView: 'agendaWeek',

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

                //al pulsar una celda del calendario sacar el modal
                dayClick: function(date, jsEvent, view) {
                    $('#reserva').modal('show');
                },
            });

            document.getElementById("btnGuardar").addEventListener("click", function(){
                let horaInicio = document.getElementById("horaInicio").value;
                let horaFin = document.getElementById("horaFin").value;
                if (horaInicio > horaFin) {
                    alert("La hora de inicio no puede ser mayor que la hora de fin");
                } else {
                    $('#reserva').modal('hide');
                    console.log(formulario.horaInicio.value);
                }
            });
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
