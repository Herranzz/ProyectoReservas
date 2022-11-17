<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('numSobremesa') }}
            {{ Form::text('numSobremesa', $equipo->numSobremesa, ['class' => 'form-control' . ($errors->has('numSobremesa') ? ' is-invalid' : ''), 'placeholder' => 'Numsobremesa']) }}
            {!! $errors->first('numSobremesa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numPortatil') }}
            {{ Form::text('numPortatil', $equipo->numPortatil, ['class' => 'form-control' . ($errors->has('numPortatil') ? ' is-invalid' : ''), 'placeholder' => 'Numportatil']) }}
            {!! $errors->first('numPortatil', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numTablets') }}
            {{ Form::text('numTablets', $equipo->numTablets, ['class' => 'form-control' . ($errors->has('numTablets') ? ' is-invalid' : ''), 'placeholder' => 'Numtablets']) }}
            {!! $errors->first('numTablets', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>