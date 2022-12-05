<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>@yield('title') - Reserva Equipos</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Font Awesome link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <!--Full Calendar cdn core/main.js y daygrid/main.js de nodemodules-->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        

    </head>
    <!-- body con color de fondo rojo-->
    <body style="background-color: #fff5f5" class="d-flex flex-column">
        <!-- navbar -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
              <img src="https://pbs.twimg.com/media/FgAOVmTX0AAXmzk.jpg" alt="Logo" style="width:70px; height: 70px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav ml-auto">
                @if(auth()->check())
                  <li class="nav-item">
                    <p class="nav-link">Hola <b>{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}<b></p>
                  </li>
                  <li class="nav-item">
                      <a class="btn btn-danger" href=" {{ route('login.destroy')}}" >
                        <i class="fas fa-sign-out-alt"></i>
                      </a>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href=" {{ route('login.index')}}" >Login</a>
                  </li>
                @endif
              </ul>
            </div>  
          </nav>

        @include('components.flash_alerts')
        @yield('content')

        <!--footer simple anclado abajo-->
          <footer class="footer">
            <div class="footer-bottom text-center py-5">
              <p class="text-muted">© 2022 JHG <a href="http://iesriberadecastilla.centros.educa.jcyl.es/sitio/" target="_blank">--IES Ribera de Castilla--</a></p>
            </div>
          </footer>

          <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale/es.js'></script>
          <!--cdn interaction-->
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/gcal.js'></script>
          <!--cdn interaction-->
          <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.1.0/interaction/main.js'></script>
          
          
          <script type="text/javascript" src="./js/app.js"></script>
    </body>
</html>