@extends('layouts.app')

@section('template_title')
    {{ $reserva->name ?? 'Show Reserva' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reserva</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reservas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Codigoprofesor:</strong>
                            {{ $reserva->codigoProfesor }}
                        </div>
                        <div class="form-group">
                            <strong>Idequipo:</strong>
                            {{ $reserva->idEquipo }}
                        </div>
                        <div class="form-group">
                            <strong>Hora:</strong>
                            {{ $reserva->hora }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $reserva->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Horainicio:</strong>
                            {{ $reserva->horaInicio }}
                        </div>
                        <div class="form-group">
                            <strong>Horafin:</strong>
                            {{ $reserva->horaFin }}
                        </div>
                        <div class="form-group">
                            <strong>Fechareserva:</strong>
                            {{ $reserva->fechaReserva }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
