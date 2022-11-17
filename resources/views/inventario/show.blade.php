@extends('layouts.app')

@section('template_title')
    {{ $inventario->name ?? 'Show Inventario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Inventario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numinventario:</strong>
                            {{ $inventario->numInventario }}
                        </div>
                        <div class="form-group">
                            <strong>Ubicacion:</strong>
                            {{ $inventario->ubicacion }}
                        </div>
                        <div class="form-group">
                            <strong>Idequipo:</strong>
                            {{ $inventario->idEquipo }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $inventario->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $inventario->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
