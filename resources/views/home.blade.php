@extends('layouts.app')

@section('title', 'Home')

@section('content')
        
    <!--conjunto de cards, de tres en tres-->
    <div class="container" id="page-content" margin-top="30px">
        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6A2LW-aNxKnowp1bElXht7j0JOBNpuvSdwg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Reserva de equipos</h5>
                        <p class="card-text">Aplicación para reservar los equipos del centro disponibles.</p>
                        <!--ruta a la vista fullcalender-->
                        <a href="#" class="btn btn-primary">Reservar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" hidden>
                <div class="card" style="width: 18rem;">
                    <img src="https://www.iesriberadecastilla.com/wp-content/uploads/2019/09/Logo-IES-Ribera-de-Castilla-1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title ">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" hidden>
                <div class="card" style="width: 18rem;">
                    <img src="https://www.iesriberadecastilla.com/wp-content/uploads/2019/09/Logo-IES-Ribera-de-Castilla-1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection