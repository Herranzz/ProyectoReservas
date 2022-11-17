@extends('layouts.app')

@section('template_title')
    {{ $ubicacione->name ?? 'Show Ubicacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Ubicacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ubicaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Aula:</strong>
                            {{ $ubicacione->aula }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
