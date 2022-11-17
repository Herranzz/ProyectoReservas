@extends('layouts.app')

@section('template_title')
    {{ $equipo->name ?? 'Show Equipo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Equipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('equipos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numsobremesa:</strong>
                            {{ $equipo->numSobremesa }}
                        </div>
                        <div class="form-group">
                            <strong>Numportatil:</strong>
                            {{ $equipo->numPortatil }}
                        </div>
                        <div class="form-group">
                            <strong>Numtablets:</strong>
                            {{ $equipo->numTablets }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
