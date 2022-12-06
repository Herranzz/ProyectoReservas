@extends('layouts.app')

@section('title', 'Reservar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="alert alert-warning" id="alert">
                        <strong>Cuidado!</strong> Ten en cuenta que tienes que elegir una hora que aún esté disponible en el
                        día de hoy.
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Reservar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <!--Por motivos de seguridad se añade el siguiente @-->
                            @csrf

                            <div class="form-group row">
                                <!--codigo profesor-->
                                <!--el input tiene que aparecer el codigo del profesor de la sesion-->
                                <input type="text" class="form-control" name="codigoProfesor" id="codigoProfesor"
                                    value='{{ auth()->user()->codigo }}' placeholder="" hidden>

                            </div>

                            <!--traer los tipos de la tabla externa tipos y pintarlo en un options-->
                            <div class="form-group row">
                                <label for="tipo"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                <div class="col-md-3">
                                    <select id="tipos" type="text" class="form-control " name="tipo"
                                        value="tipos" required autocomplete="tipo" autofocus>
                                        <option value="">----</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>

                                    <input name="tipoEquipos" id="tipoEquipos" hidden>
                                </div>

                                <!--input donde recojo el número de equipos que seleccione-->
                                <div class="col-md-3">
                                    <input id="numEquipos" type="text" class="form-control" value="" name="numEquipos"
                                        autocomplete="numEquipos">
                                </div>
                            </div class="form group row">
                                <!--lo uso para sacar el numero de equipos de cada tipo-->
                                <?php $conn = mysqli_connect('localhost', 'root', '', 'reservaequiposs'); ?>
                                <!--seelct con el numero de portatiles recogidos por la variable $portatiles de ReservasController-->
                                <select id="numPortatiles" name="numPortatiles" title="portatiles disponibles" hidden>
                                    <option value="">Nº Portátiles</option>
                                    <!--codigo php que haga una consulta sql-->
                                    <?php
                                    //consulta sql que cuente el numero de portatiles libres que hay en la tabla inventario y lo pinte en el select
                                    $sql = "SELECT COUNT(*) FROM inventario WHERE estado='libre' AND idEquipo in (SELECT id FROM equipos WHERE tipo='portatil')";
                                    
                                    //ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                
                                    //bucle que pinta el numero de portatiles disponibles en el select
                                    for ($i = 1; $i <= $total; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>

                                <select id="numPortatilesConvertibles" name="numPortatilesConvertibles" title="portatiles convertibles disponibles" hidden>
                                    <option value="">Nº de Portátiles Convertibles</option>
                                    <!--codigo php que haga una consulta sql-->
                                    <?php
                                    //consulta sql que cuente el numero de portatiles convertibles libres que hay en la tabla inventario y lo pinte en el select
                                    $sql = "SELECT COUNT(*) FROM inventario WHERE estado='libre' AND idEquipo in (SELECT id FROM equipos WHERE tipo='portatil convertible')";
                                    
                                    //ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    
                                    //bucle que pinta el numero de portatiles convertibles disponibles en el select
                                    for ($i = 1; $i <= $total; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>

                                <select id="numTelefonoMovil" name="numTelefonoMovil" title="telefonos disponibles" hidden>
                                    <option value="">Nº de Teléfonos</option>
                                    <!--codigo php que haga una consulta sql-->
                                    <?php
                                    //consulta sql que cuente el numero de telefonos moviles libres que hay en la tabla inventario y lo pinte en el select
                                    $sql = "SELECT COUNT(*) FROM inventario WHERE estado='libre' AND idEquipo in (SELECT id FROM equipos WHERE tipo='telefono movil')";

                                    //ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];

                                    //bucle que pinta el numero de telefonos moviles disponibles en el select
                                    for ($i = 1; $i <= $total; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>

                                <select id="numSobremesa" name="numSobremesa" title="sobremesa disponibles" hidden>
                                    <option value="">Nº de Sobremesa</option>
                                    <!--codigo php que haga una consulta sql-->
                                    <?php
                                    //consulta sql que cuente el numero de portatiles libres que hay en la tabla inventario y lo pinte en el select
                                    $sql = "SELECT COUNT(*) FROM inventario WHERE estado='libre' AND idEquipo in (SELECT id FROM equipos WHERE tipo='sobremesa')";
                                    
                                    //ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    
                                    //bucle que pinta el numero de sobremesa disponibles en el select
                                    for ($i = 1; $i <= $total; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>

                                <select id="numTablets" name="numTablets" title="tablets disponibles"  hidden>
                                    <option value="">Nº de Tablets</option>
                                    <!--codigo php que haga una consulta sql-->
                                    <?php
                                    //consulta sql que cuente el numero de portatiles libres que hay en la tabla inventario y lo pinte en el select
                                    $sql = "SELECT COUNT(*) FROM inventario WHERE estado='libre' AND idEquipo in (SELECT id FROM equipos WHERE tipo='tablet')";
                                    
                                    //ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    
                                    //bucle que pinta el numero de tablets disponibles en el select
                                    for ($i = 1; $i <= $total; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>


                            </div>
                            
                            <!--consulta sql que muestre el numero de equipos que hay reservados en la hora seleccionada-->
                            <?php
                            //consulta sql que sume el numEquipos de la tabla reservas dependiendo de la horaInicio
                            $sql = "SELECT SUM(numEquipos) FROM reservas WHERE horaInicio='2022-12-06 08:00:00'";
                            $result = mysqli_query($conn, $sql);
                            //siendo int el tipo de dato que se quiere mostrar
                            $row = mysqli_fetch_array($result, MYSQLI_NUM);
                            //se guarda el valor en una variable
                            $total = $row[0];
                            //se muestra el resultado
                            echo $total;

                            ?>

                            <div class="form-group row">
                                <label for="horaInicio"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Fecha y Hora') }}</label>

                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="fecha" id="fecha" min="08:00"
                                        max="22:00" value="<?php echo date('Y-m-d'); ?>" disabled required>
                                </div>

                                <!--select con 6 options cuyo valor son las horas de 8:00:00 a 14:00:00-->
                                <select id="hora" name="hora" title="horas del día" required>
                                    <option value="" selected>Seleccionar</option>
                                    <option value="08:30:00" title="08:30">1</option>
                                    <option value="09:25:00" title="09:25">2</option>
                                    <option value="10:20:00" title="10:20">3</option>
                                    <option value="11:40:00" title="11:40">4</option>
                                    <option value="12:35:00" title="12:35">5</option>
                                    <option value="23:50:00" title="13:30">6</option>
                                </select>

                                <input type="horaInicio" class="form-control" name="horaInicio" id="horaInicio"
                                    value="" autocomplete="horaInicio" autofocus hidden>
                            </div>

                            <!--campo color-->
                            <div class="form-group row">
                                <label for="color"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                <div class="col-md-2">
                                    <input type="color" class="form-control" name="color" id="color" value="#3baebc"
                                        required>
                                </div>
                            </div>

                            <!--boton registrar-->
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btnReservar" class="btn btn-primary">
                                        {{ __('Reservar') }}
                                    </button>
                                    <!--boton para cancelar-->
                                    <a href="{{ route('reservas.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //pintar la fecha y la hora seleccionada en el input horaInicio (la hora de forma dinamica)
        var fecha = document.getElementById("fecha").value;

        //actualizar el valor del input horaInicio a la vez que se elige otro option en el select hora
        document.getElementById("hora").addEventListener("change", function() {
            var hora = document.getElementById("hora").value;
            document.getElementById("horaInicio").value = fecha + " " + hora;
        });

        //no dejar reservar si la hora elegida en el select ya ha pasado
        document.getElementById("hora").addEventListener("change", function() {
            var hora = document.getElementById("hora").value;
            var fecha = document.getElementById("fecha").value;
            var fechaHora = fecha + " " + hora;
            var fechaHoraActual = new Date();
            var fechaHoraElegida = new Date(fechaHora);
            //mostrar el alert con id alert solo cuando se seleccione un option en el select, no mostrarlo al cargar la pagina
            if (document.getElementById("hora").value != "") {
                if (fechaHoraElegida < fechaHoraActual) {
                    document.getElementById("alert").style.display = "block";
                    document.getElementById("hora").value = "";
                } else {
                    document.getElementById("alert").style.display = "none";
                }
            }
        });
        //según el tipo de equipo que elija, mostrar el select que corresponda a ese tipo de equipo
        document.getElementById("tipos").addEventListener("change", function() {
            var tipo = document.getElementById("tipos").value;

            if (tipo == "portatil") {
                //quitar atributo hidden al select de portatiles
                document.getElementById("numPortatiles").removeAttribute("hidden");
                //poner atributo hidden al select de tablets
                document.getElementById("numTablets").setAttribute("hidden", "true");
                //poner atributo hidden al select de sobremesa
                document.getElementById("numSobremesa").setAttribute("hidden", "true");
                //poner atributo hidden al select de portatiles convertibles
                document.getElementById("numPortatilesConvertibles").setAttribute("hidden", "true");
                //poner atributo hidden al select de telefono movil
                document.getElementById("numTelefonoMovil").setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = document.getElementById("numPortatiles").value;
            } else if (tipo == "tablet") {
                document.getElementById("numTablets").removeAttribute("hidden");
                document.getElementById("numPortatiles").setAttribute("hidden", "true");
                document.getElementById("numSobremesa").setAttribute("hidden", "true");
                document.getElementById("numPortatilesConvertibles").setAttribute("hidden", "true");
                document.getElementById("numTelefonoMovil").setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = document.getElementById("numTablets").value;
            } else if (tipo == "sobremesa") {
                document.getElementById("numSobremesa").removeAttribute("hidden");
                document.getElementById("numPortatiles").setAttribute("hidden", "true");
                document.getElementById("numTablets").setAttribute("hidden", "true");
                document.getElementById("numPortatilesConvertibles").setAttribute("hidden", "true");
                document.getElementById("numTelefonoMovil").setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = document.getElementById("numTablets").value;
            } else if (tipo == "portatil convertible") {
                document.getElementById("numPortatilesConvertibles").removeAttribute("hidden");
                document.getElementById("numSobremesa").setAttribute("hidden", "true");
                document.getElementById("numPortatiles").setAttribute("hidden", "true");
                document.getElementById("numTablets").setAttribute("hidden", "true");
                document.getElementById("numTelefonoMovil").setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = document.getElementById("numPortatilesConvertibles").value;
            } else if (tipo == "telefono movil") {
                document.getElementById("numTelefonoMovil").removeAttribute("hidden");
                document.getElementById("numPortatiles").setAttribute("hidden", "true");
                document.getElementById("numSobremesa").setAttribute("hidden", "true");
                document.getElementById("numTablets").setAttribute("hidden", "true");
                document.getElementById("numPortatilesConvertibles").setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = document.getElementById("numTelefonoMovil").value;
            }
        });

        //actualizar el valor del input numEquipos a la vez que se elige otro option en el select numEquipos


        //hacer que a medida que cambia el select con id tipos pinte el value en el input con id tiposEquipos
        document.getElementById("tipos").addEventListener("change", function() {
            document.getElementById("tipoEquipos").value = document.getElementById("tipos").value;
        });
    </script>
@endsection