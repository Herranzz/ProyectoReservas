@section('volver')

<!--boton volver, que redirija al index de admin-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Volver') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.index') }}">
                        <!--Por motivos de seguridad se añade el siguiente @-->
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check row justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Volver') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection