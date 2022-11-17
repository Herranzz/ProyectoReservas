<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('codigoProfesor') }}
            {{ Form::text('codigoProfesor', $reserva->codigoProfesor, ['class' => 'form-control' . ($errors->has('codigoProfesor') ? ' is-invalid' : ''), 'placeholder' => 'Codigoprofesor']) }}
            {!! $errors->first('codigoProfesor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('idEquipo') }}
            {{ Form::text('idEquipo', $reserva->idEquipo, ['class' => 'form-control' . ($errors->has('idEquipo') ? ' is-invalid' : ''), 'placeholder' => 'Idequipo']) }}
            {!! $errors->first('idEquipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hora') }}
            {{ Form::text('hora', $reserva->hora, ['class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''), 'placeholder' => 'Hora']) }}
            {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $reserva->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('horaInicio') }}
            {{ Form::text('horaInicio', $reserva->horaInicio, ['class' => 'form-control' . ($errors->has('horaInicio') ? ' is-invalid' : ''), 'placeholder' => 'Horainicio']) }}
            {!! $errors->first('horaInicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('horaFin') }}
            {{ Form::text('horaFin', $reserva->horaFin, ['class' => 'form-control' . ($errors->has('horaFin') ? ' is-invalid' : ''), 'placeholder' => 'Horafin']) }}
            {!! $errors->first('horaFin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaReserva') }}
            {{ Form::text('fechaReserva', $reserva->fechaReserva, ['class' => 'form-control' . ($errors->has('fechaReserva') ? ' is-invalid' : ''), 'placeholder' => 'Fechareserva']) }}
            {!! $errors->first('fechaReserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>