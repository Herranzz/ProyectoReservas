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

                                    <input name="tipoEquipos" id="tipoEquipos" required hidden>
                                </div>

                                <!--input donde recojo el número de equipos que seleccione-->
                                <div class="col-md-3">
                                    <input id="numEquipos" type="text" class="form-control" value="" name="numEquipos"
                                        autocomplete="numEquipos" hidden>
                                </div>
                            </div class="form group row">
                                <!--lo uso para sacar el numero de equipos de cada tipo-->
                                <?php $conn = mysqli_connect('localhost', 'root', '', 'reservaequiposs'); ?>
                                <!--seelct con el numero de portatiles recogidos por la variable $portatiles de ReservasController-->
                                <select id="numPortatiles" name="numPortatiles" title="portatiles disponibles" hidden>
                                    <option value="" disabled></option>
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
                                    <option value="" disabled></option>
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
                                    <option value="" disabled></option>
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
                                    <option value="" disabled></option>
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
                                    <option value="" disabled></option>
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
                            //guardar el dia de hoy en una variable
                            $hoy = date("Y-m-d"); $primera = "08:30:00"; $segunda = "09:25:00";$tercera = "10:20:00";$cuarta = "11:40:00";$quinta = "12:35:00";$sexta = "13:30:00";
                            //consulta sql que sume el numEquipos de la tabla reservas dependiendo de la horaInicio
                            $sqlp = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $primera'";
                            $result = mysqli_query($conn, $sqlp);
                            //siendo int el tipo de dato que se quiere mostrar
                            $row = mysqli_fetch_array($result, MYSQLI_NUM);
                            //se guarda el valor en una variable
                            $total = $row[0];
                            //si el valor de $total es null se le asigna el valor 0
                            if ($total == null) {
                                $total = 0;
                            }
                            //se muestra el resultado en un input
                            echo "<input type='text' name='portatil1' id='portatil1' value='$total' hidden>";
                            
                            $sqlp2 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $segunda'";$result2 = mysqli_query($conn, $sqlp2);$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);$total = $row2[0];if ($total == null) {$total = 0;}echo "<input type='text' name='portatil2' id='portatil2' value='$total' hidden>";
                            $sqlp3 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $tercera'";$result3 = mysqli_query($conn, $sqlp3);$row3 = mysqli_fetch_array($result3, MYSQLI_NUM);$total = $row3[0];if ($total == null) {$total = 0;}echo "<input type='text' name='portatil3' id='portatil3' value='$total' hidden>";
                            $sqlp4 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $cuarta'";$result4 = mysqli_query($conn, $sqlp4);$row4 = mysqli_fetch_array($result4, MYSQLI_NUM);$total = $row4[0];if ($total == null) {$total = 0;}echo "<input type='text' name='portatil4' id='portatil4' value='$total' hidden>";
                            $sqlp5 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $quinta'";$result5 = mysqli_query($conn, $sqlp5);$row5 = mysqli_fetch_array($result5, MYSQLI_NUM);$total = $row5[0];if ($total == null) {$total = 0;}echo "<input type='text' name='portatil5' id='portatil5' value='$total' hidden>";
                            $sqlp6 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil' AND horaInicio='$hoy $sexta'";$result6 = mysqli_query($conn, $sqlp6);$row6 = mysqli_fetch_array($result6, MYSQLI_NUM);$total = $row6[0];if ($total == null) {$total = 0;}echo "<input type='text' name='portatil6' id='portatil6' value='$total' hidden>";
                            
                            $sqlpc1 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $primera'";$resultc1 = mysqli_query($conn, $sqlpc1);$rowc1 = mysqli_fetch_array($resultc1, MYSQLI_NUM);$totalc1 = $rowc1[0];if ($totalc1 == null) {$totalc1 = 0;}echo "<input type='text' name='portatilc1' id='portatilc1' value='$totalc1' hidden>";
                            $sqlpc2 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $segunda'";$resultc2 = mysqli_query($conn, $sqlpc2);$rowc2 = mysqli_fetch_array($resultc2, MYSQLI_NUM);$totalc2 = $rowc2[0];if ($totalc2 == null) {$totalc2 = 0;}echo "<input type='text' name='portatilc2' id='portatilc2' value='$totalc2' hidden>";
                            $sqlpc3 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $tercera'";$resultc3 = mysqli_query($conn, $sqlpc3);$rowc3 = mysqli_fetch_array($resultc3, MYSQLI_NUM);$totalc3 = $rowc3[0];if ($totalc3 == null) {$totalc3 = 0;}echo "<input type='text' name='portatilc3' id='portatilc3' value='$totalc3' hidden>";
                            $sqlpc4 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $cuarta'";$resultc4 = mysqli_query($conn, $sqlpc4);$rowc4 = mysqli_fetch_array($resultc4, MYSQLI_NUM);$totalc4 = $rowc4[0];if ($totalc4 == null) {$totalc4 = 0;}echo "<input type='text' name='portatilc4' id='portatilc4' value='$totalc4' hidden>";
                            $sqlpc5 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $quinta'";$resultc5 = mysqli_query($conn, $sqlpc5);$rowc5 = mysqli_fetch_array($resultc5, MYSQLI_NUM);$totalc5 = $rowc5[0];if ($totalc5 == null) {$totalc5 = 0;}echo "<input type='text' name='portatilc5' id='portatilc5' value='$totalc5' hidden>";
                            $sqlpc6 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='portatil convertible' AND horaInicio='$hoy $sexta'";$resultc6 = mysqli_query($conn, $sqlpc6);$rowc6 = mysqli_fetch_array($resultc6, MYSQLI_NUM);$totalc6 = $rowc6[0];if ($totalc6 == null) {$totalc6 = 0;}echo "<input type='text' name='portatilc6' id='portatilc6' value='$totalc6' hidden>";

                            $sqlt1 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $primera'";$resultt1 = mysqli_query($conn, $sqlt1);$rowt1 = mysqli_fetch_array($resultt1, MYSQLI_NUM);$totalt1 = $rowt1[0];if ($totalt1 == null) {$totalt1 = 0;}echo "<input type='text' name='tablet1' id='tablet1' value='$totalt1' hidden>";
                            $sqlt2 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $segunda'";$resultt2 = mysqli_query($conn, $sqlt2);$rowt2 = mysqli_fetch_array($resultt2, MYSQLI_NUM);$totalt2 = $rowt2[0];if ($totalt2 == null) {$totalt2 = 0;}echo "<input type='text' name='tablet2' id='tablet2' value='$totalt2' hidden>";
                            $sqlt3 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $tercera'";$resultt3 = mysqli_query($conn, $sqlt3);$rowt3 = mysqli_fetch_array($resultt3, MYSQLI_NUM);$totalt3 = $rowt3[0];if ($totalt3 == null) {$totalt3 = 0;}echo "<input type='text' name='tablet3' id='tablet3' value='$totalt3' hidden>";
                            $sqlt4 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $cuarta'";$resultt4 = mysqli_query($conn, $sqlt4);$rowt4 = mysqli_fetch_array($resultt4, MYSQLI_NUM);$totalt4 = $rowt4[0];if ($totalt4 == null) {$totalt4 = 0;}echo "<input type='text' name='tablet4' id='tablet4' value='$totalt4' hidden>";
                            $sqlt5 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $quinta'";$resultt5 = mysqli_query($conn, $sqlt5);$rowt5 = mysqli_fetch_array($resultt5, MYSQLI_NUM);$totalt5 = $rowt5[0];if ($totalt5 == null) {$totalt5 = 0;}echo "<input type='text' name='tablet5' id='tablet5' value='$totalt5' hidden>";
                            $sqlt6 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='tablet' AND horaInicio='$hoy $sexta'";$resultt6 = mysqli_query($conn, $sqlt6);$rowt6 = mysqli_fetch_array($resultt6, MYSQLI_NUM);$totalt6 = $rowt6[0];if ($totalt6 == null) {$totalt6 = 0;}echo "<input type='text' name='tablet6' id='tablet6' value='$totalt6' hidden>";


                            $sqltlfn1 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $primera'";$resulttlfn1 = mysqli_query($conn, $sqltlfn1);$rowtlfn1 = mysqli_fetch_array($resulttlfn1, MYSQLI_NUM);$totaltlfn1 = $rowtlfn1[0];if ($totaltlfn1 == null) {$totaltlfn1 = 0;}echo "<input type='text' name='telefono1' id='telefono1' value='$totaltlfn1' hidden>";
                            $sqltlfn2 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $segunda'";$resulttlfn2 = mysqli_query($conn, $sqltlfn2);$rowtlfn2 = mysqli_fetch_array($resulttlfn2, MYSQLI_NUM);$totaltlfn2 = $rowtlfn2[0];if ($totaltlfn2 == null) {$totaltlfn2 = 0;}echo "<input type='text' name='telefono2' id='telefono2' value='$totaltlfn2' hidden>";
                            $sqltlfn3 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $tercera'";$resulttlfn3 = mysqli_query($conn, $sqltlfn3);$rowtlfn3 = mysqli_fetch_array($resulttlfn3, MYSQLI_NUM);$totaltlfn3 = $rowtlfn3[0];if ($totaltlfn3 == null) {$totaltlfn3 = 0;}echo "<input type='text' name='telefono3' id='telefono3' value='$totaltlfn3' hidden>";
                            $sqltlfn4 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $cuarta'";$resulttlfn4 = mysqli_query($conn, $sqltlfn4);$rowtlfn4 = mysqli_fetch_array($resulttlfn4, MYSQLI_NUM);$totaltlfn4 = $rowtlfn4[0];if ($totaltlfn4 == null) {$totaltlfn4 = 0;}echo "<input type='text' name='telefono4' id='telefono4' value='$totaltlfn4' hidden>";
                            $sqltlfn5 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $quinta'";$resulttlfn5 = mysqli_query($conn, $sqltlfn5);$rowtlfn5 = mysqli_fetch_array($resulttlfn5, MYSQLI_NUM);$totaltlfn5 = $rowtlfn5[0];if ($totaltlfn5 == null) {$totaltlfn5 = 0;}echo "<input type='text' name='telefono5' id='telefono5' value='$totaltlfn5' hidden>";
                            $sqltlfn6 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='telefono movil' AND horaInicio='$hoy $sexta'";$resulttlfn6 = mysqli_query($conn, $sqltlfn6);$rowtlfn6 = mysqli_fetch_array($resulttlfn6, MYSQLI_NUM);$totaltlfn6 = $rowtlfn6[0];if ($totaltlfn6 == null) {$totaltlfn6 = 0;}echo "<input type='text' name='telefono6' id='telefono6' value='$totaltlfn6' hidden>";

                            $sqls1 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $primera'";$results1 = mysqli_query($conn, $sqls1);$rows1 = mysqli_fetch_array($results1, MYSQLI_NUM);$totals1 = $rows1[0];if ($totals1 == null) {$totals1 = 0;}echo "<input type='text' name='sobremesa1' id='sobremesa1' value='$totals1' hidden>";
                            $sqls2 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $segunda'";$results2 = mysqli_query($conn, $sqls2);$rows2 = mysqli_fetch_array($results2, MYSQLI_NUM);$totals2 = $rows2[0];if ($totals2 == null) {$totals2 = 0;}echo "<input type='text' name='sobremesa2' id='sobremesa2' value='$totals2' hidden>";
                            $sqls3 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $tercera'";$results3 = mysqli_query($conn, $sqls3);$rows3 = mysqli_fetch_array($results3, MYSQLI_NUM);$totals3 = $rows3[0];if ($totals3 == null) {$totals3 = 0;}echo "<input type='text' name='sobremesa3' id='sobremesa3' value='$totals3' hidden>";
                            $sqls4 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $cuarta'";$results4 = mysqli_query($conn, $sqls4);$rows4 = mysqli_fetch_array($results4, MYSQLI_NUM);$totals4 = $rows4[0];if ($totals4 == null) {$totals4 = 0;}echo "<input type='text' name='sobremesa4' id='sobremesa4' value='$totals4' hidden>";
                            $sqls5 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $quinta'";$results5 = mysqli_query($conn, $sqls5);$rows5 = mysqli_fetch_array($results5, MYSQLI_NUM);$totals5 = $rows5[0];if ($totals5 == null) {$totals5 = 0;}echo "<input type='text' name='sobremesa5' id='sobremesa5' value='$totals5' hidden>";
                            $sqls6 = "SELECT SUM(numEquipos) FROM reservas WHERE tipoEquipos='sobremesa' AND horaInicio='$hoy $sexta'";$results6 = mysqli_query($conn, $sqls6);$rows6 = mysqli_fetch_array($results6, MYSQLI_NUM);$totals6 = $rows6[0];if ($totals6 == null) {$totals6 = 0;}echo "<input type='text' name='sobremesa6' id='sobremesa6' value='$totals6' hidden>";

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
                                    <option value="13:30:00" title="13:30">6</option>
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
            //les dejo un margen para poder reservar de 30 minutos en la hora elegida para que no de error al enviar el formulario en las validaciones, porque si no está este parámetro, al enviar el formulario, la hora elegida ya habrá pasado y no dejará reservar en esa franja horaria seleccionada
            fechaHoraElegida.setMinutes(fechaHoraElegida.getMinutes() + 500);
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
            var numPortatiles = document.getElementById("numPortatiles");
            var numTablets = document.getElementById("numTablets");
            var numSobremesa = document.getElementById("numSobremesa");
            var numPortatilesConvertibles = document.getElementById("numPortatilesConvertibles");
            var numTelefonoMovil = document.getElementById("numTelefonoMovil");

            if (tipo == "portatil") {
                //quitar atributo hidden al select de portatiles
                numPortatiles.removeAttribute("hidden");
                //poner atributo hidden al select de tablets
                numTablets.setAttribute("hidden", "true");
                //poner atributo hidden al select de sobremesa
                numSobremesa.setAttribute("hidden", "true");
                //poner atributo hidden al select de portatiles convertibles
                numPortatilesConvertibles.setAttribute("hidden", "true");
                //poner atributo hidden al select de telefono movil
                numTelefonoMovil.setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = numPortatiles.value;
            } else if (tipo == "tablet") {
                numTablets.removeAttribute("hidden");
                numPortatiles.setAttribute("hidden", "true");
                numSobremesa.setAttribute("hidden", "true");
                numPortatilesConvertibles.setAttribute("hidden", "true");
                numTelefonoMovil.setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = numTablets.value;
            } else if (tipo == "sobremesa") {
                numSobremesa.removeAttribute("hidden");
                numPortatiles.setAttribute("hidden", "true");
                numTablets.setAttribute("hidden", "true");
                numPortatilesConvertibles.setAttribute("hidden", "true");
                numTelefonoMovil.setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = numSobremesa.value;
            } else if (tipo == "portatil convertible") {
                numPortatilesConvertibles.removeAttribute("hidden");
                numSobremesa.setAttribute("hidden", "true");
                numPortatiles.setAttribute("hidden", "true");
                numTablets.setAttribute("hidden", "true");
                numTelefonoMovil.setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = numPortatilesConvertibles.value;
            } else if (tipo == "telefono movil") {
                numTelefonoMovil.removeAttribute("hidden");
                numPortatiles.setAttribute("hidden", "true");
                numSobremesa.setAttribute("hidden", "true");
                numTablets.setAttribute("hidden", "true");
                numPortatilesConvertibles.setAttribute("hidden", "true");
                document.getElementById("numEquipos").value = numTelefonoMovil.value;
            }
        });

        //hacer que a medida que cambia el select con id numPortatiles pinte el value en el input con id numEquipos
        numPortatiles.addEventListener("change", function() {
            document.getElementById("numEquipos").value = numPortatiles.value;
        });
        //hacer que a medida que cambia el select con id numTablets pinte el value en el input con id numEquipos
        numTablets.addEventListener("change", function() {
            document.getElementById("numEquipos").value = numTablets.value;
        });
        //hacer que a medida que cambia el select con id numSobremesa pinte el value en el input con id numEquipos
        numSobremesa.addEventListener("change", function() {
            document.getElementById("numEquipos").value = numSobremesa.value;
        });
        //hacer que a medida que cambia el select con id numPortatilesConvertibles pinte el value en el input con id numEquipos
        numPortatilesConvertibles.addEventListener("change", function() {
            document.getElementById("numEquipos").value = numPortatilesConvertibles.value;
        });
        //hacer que a medida que cambia el select con id numTelefonoMovil pinte el value en el input con id numEquipos
        numTelefonoMovil.addEventListener("change", function() {
            document.getElementById("numEquipos").value = numTelefonoMovil.value;
        });
        //hacer que a medida que cambia el select con id tipos pinte el value en el input con id tiposEquipos
        document.getElementById("tipos").addEventListener("change", function() {
            document.getElementById("tipoEquipos").value = document.getElementById("tipos").value;
        });


    </script>
@endsection