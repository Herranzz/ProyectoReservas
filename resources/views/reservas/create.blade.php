@extends('layouts.app')

@section('title', 'Reservar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="alert alert-warning" id="alert" hidden>
                        <strong>Cuidado!</strong> Ten en cuenta que tienes que elegir una hora que aún esté disponible en el
                        día de hoy.
                    </div>
                    <!--alert no hay telefonos moviles-->
                    <div class="alert alert-danger" id="tlfnoAlert" hidden>
                        No hay teléfonos móviles disponibles en esta hora.
                    </div>
                    <!--alert no hay portatiles-->
                    <div class="alert alert-danger" id="portatilAlert" hidden>
                        No hay portátiles disponibles en esta hora.
                    </div>
                    <!--alert no hay portatiles convertibles-->
                    <div class="alert alert-danger" id="portatilConvertibleAlert" hidden>
                        No hay portátiles convertibles disponibles en esta hora.
                    </div>
                    <!--alert no hay ordenadores de sobremesa-->
                    <div class="alert alert-danger" id="ordenadorSobremesaAlert" hidden>
                        No hay ordenadores de sobremesa disponibles en esta hora.
                    </div>
                    <!--alert no hay tablets-->
                    <div class="alert alert-danger" id="tabletAlert" hidden>
                        No hay tablets disponibles en esta hora.
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Reservar') }}</div>
                    <div class="card-body">
                        <form method="POST" id="form1" action="">
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
                                <div class="col-md-4">
                                    <select id="tipos" type="text" class="form-control " name="tipo"
                                        value="tipos" required autocomplete="tipo">
                                        <option value="">----</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>

                                    <input name="tipoEquipos" id="tipoEquipos" required hidden>
                                </div>

                                <!--lo uso para sacar el numero de equipos de cada tipo IMPORTANTE-->
                                <!--IMPORTANTE-->
                                <!--IMPORTANTE-->
                                <!--IMPORTANTE-->
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
                                    //numero total de portátiles que hay libres en este momento
                                    echo "<input  name='totalPortatiles' id='totalPortatiles' value='$total' hidden>"
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
                                    echo "<input  name='totalPortatilesConvertibles' id='totalPortatilesConvertibles' value='$total' hidden>"
                                    ?>
                                </select>

                                <select id="numTelefonoMovil" name="numTelefonoMovil" title="telefonos disponibles" hidden>
                                    <option value="" disabled selected>Nº</option>
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
                                    echo "<input  name='totalTelefonoMovil' id='totalTelefonoMovil' value='$total' hidden>"
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
                                    echo "<input  name='totalSobremesa' id='totalSobremesa' value='$total' hidden>"
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
                                    echo "<input  name='totalTablets' id='totalTablets' value='$total' hidden>"
                                    ?>
                                </select>

                                <!--input donde recojo el número de equipos que seleccione-->
                                <input id="numEquipos" type="text" class="form-control" value="" name="numEquipos"
                                        autocomplete="numEquipos" required hidden>
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
                                <select id="hora" name="hora" title="horas del día" autofocus required>
                                    <option value="">Hora</option>
                                    <option value="08:30:00" title="08:30-09:20">1</option>
                                    <option value="09:25:00" title="09:25-10:15">2</option>
                                    <option value="10:20:00" title="10:20-11:10">3</option>
                                    <option value="11:40:00" title="11:40-12:30">4</option>
                                    <option value="12:35:00" title="12:35-13:25">5</option>
                                    <option value="13:30:00" title="13:30-14:20">6</option>
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
        var selHora = document.getElementById("hora");
        var selP = document.getElementById('numPortatiles');
        var selectPortatiles = document.getElementById('numPortatiles').options.length-1;
        var selPC = document.getElementById('numPortatilesConvertibles');
        var selectPortatilesConvertibles = document.getElementById('numPortatilesConvertibles').options.length-1;
        var selTM = document.getElementById('numTelefonoMovil');
        var selectTelefonoMovil = document.getElementById('numTelefonoMovil').options.length-1;
        var selS = document.getElementById('numSobremesa');
        var selectSobremesa = document.getElementById('numSobremesa').options.length-1;
        var selT = document.getElementById('numTablets');
        var selectTablets = document.getElementById('numTablets').options.length-1;
        var totalTlfn = document.getElementById('totalTelefonoMovil').value;
        var totalP = document.getElementById('totalPortatiles').value;
        var totalPC = document.getElementById('totalPortatilesConvertibles').value;
        var totalS = document.getElementById('totalSobremesa').value;
        var totalT = document.getElementById('totalTablets').value;


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
            fechaHoraElegida.setMinutes(fechaHoraElegida.getMinutes() + 30);
            //mostrar el alert con id alert solo cuando se seleccione un option en el select, no mostrarlo al cargar la pagina
            if (document.getElementById("hora").value != "") {
                if (fechaHoraElegida < fechaHoraActual) {
                    document.getElementById("alert").removeAttribute("hidden");
                    document.getElementById("hora").value = "";
                } else {
                    document.getElementById("alert").setAttribute("hidden", "true");
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


        //al cargar la pagina ponga el select con id tipos disabled
        document.getElementById("tipos").setAttribute("disabled", "true");
        //mientras el seelct con id hora esté con la opcion con valor nulo (no se haya seleccionado ninguna hora), desabilitar el select con id tipos
        document.getElementById("hora").addEventListener("change", function() {
            if (document.getElementById("hora").value == "") {
                document.getElementById("tipos").setAttribute("disabled", "true");
                document.getElementById("tipos").value = "";
                selP.setAttribute("hidden", "true");
                selT.setAttribute("hidden", "true");
                selS.setAttribute("hidden", "true");
                selPC.setAttribute("hidden", "true");
                selTM.setAttribute("hidden", "true");
            } else {
                document.getElementById("tipos").removeAttribute("disabled");
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

        //muestra los campos option ocultos de selectPortatiles
        function desocultarOptionsPortatil() {
            //desocultar los campos del select numPortatiles
            for (var i = selectPortatiles; i > 0; i--) {
                document.getElementById('numPortatiles').options[i].removeAttribute("hidden");
            }
        }
        //muestra los campos option ocultos de selectPortatilesConvertibles
        function desocultarOptionsPortatilConvertible() {
            //desocultar los campos del select numPortatilesConvertibles
            for (var i = selectPortatilesConvertibles; i > 0; i--) {
                document.getElementById('numPortatilesConvertibles').options[i].removeAttribute("hidden");
            }
        }
        //muestra los campos option ocultos de selectSobremesa
        function desocultarOptionsSobremesa() {
            //desocultar los campos del select numSobremesa
            for (var i = selectSobremesa; i > 0; i--) {
                document.getElementById('numSobremesa').options[i].removeAttribute("hidden");
            }
        }
        //muestra los campos option ocultos de selectTablets
        function desocultarOptionsTablets() {
            //desocultar los campos del select numTablets
            for (var i = selectTablets; i > 0; i--) {
                document.getElementById('numTablets').options[i].removeAttribute("hidden");
            }
        }
        //muestra los campos option ocultos de selectTelefonoMovil
        function desocultarOptionsTelefonoMovil() {
            //desocultar los campos del select numTelefonoMovil
            for (var i = selectTelefonoMovil; i > 0; i--) {
                document.getElementById('numTelefonoMovil').options[i].removeAttribute("hidden");
            }
        }


        //fijandose en el option del select hora saque el numPortatiles que hay que quitar del select numPortatiles y lo quite
        selHora.addEventListener("change", function() {
            if (selHora.value == "08:30:00") {
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p1 = selectPortatiles - parseInt(document.getElementById("portatil1").value);
                var pc1 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc1").value);
                var s1 = selectSobremesa - parseInt(document.getElementById("sobremesa1").value);
                var t1 = selectTablets - parseInt(document.getElementById("tablet1").value);
                var tm1 = selectTelefonoMovil - parseInt(document.getElementById("telefono1").value);

                //ocultar los options de portatiles reservados
                for (var i = selectPortatiles; i > p1; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc1; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s1; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t1; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm1; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }
                
            } else if (selHora.value == "09:25:00"){
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p2 = selectPortatiles - parseInt(document.getElementById("portatil2").value);
                var pc2 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc2").value);
                var s2 = selectSobremesa - parseInt(document.getElementById("sobremesa2").value);
                var t2 = selectTablets - parseInt(document.getElementById("tablet2").value);
                var tm2 = selectTelefonoMovil - parseInt(document.getElementById("telefono2").value);

                //ocultar los options de portatiles reservados
                for (var i = selectPortatiles; i > p2; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc2; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s2; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t2; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm2; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }

            } else if (selHora.value == "10:20:00"){
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p3 = selectPortatiles - parseInt(document.getElementById("portatil3").value);
                var pc3 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc3").value);
                var s3 = selectSobremesa - parseInt(document.getElementById("sobremesa3").value);
                var t3 = selectTablets - parseInt(document.getElementById("tablet3").value);
                var tm3 = selectTelefonoMovil - parseInt(document.getElementById("telefono3").value);

                //ocultar los options portatiles reservados
                for (var i = selectPortatiles; i > p3; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc3; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s3; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t3; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm3; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }

            } else if (selHora.value == "11:40:00"){
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p4 = selectPortatiles - parseInt(document.getElementById("portatil4").value);
                var pc4 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc4").value);
                var s4 = selectSobremesa - parseInt(document.getElementById("sobremesa4").value);
                var t4 = selectTablets - parseInt(document.getElementById("tablet4").value);
                var tm4 = selectTelefonoMovil - parseInt(document.getElementById("telefono4").value);

                //ocultar los options de portatiles reservados
                for (var i = selectPortatiles; i > p4; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc4; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s4; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t4; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm4; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }

            } else if (selHora.value == "12:35:00"){
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p5 = selectPortatiles - parseInt(document.getElementById("portatil5").value);
                var pc5 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc5").value);
                var s5 = selectSobremesa - parseInt(document.getElementById("sobremesa5").value);
                var t5 = selectTablets - parseInt(document.getElementById("tablet5").value);
                var tm5 = selectTelefonoMovil - parseInt(document.getElementById("telefono5").value);

                //ocultar los options de portatiles reservados
                for (var i = selectPortatiles; i > p5; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc5; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s5; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t5; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm5; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }

            } else if (selHora.value == "13:30:00"){
                desocultarOptionsPortatil()
                desocultarOptionsPortatilConvertible()
                desocultarOptionsSobremesa()
                desocultarOptionsTablets()
                desocultarOptionsTelefonoMovil()

                var p6 = selectPortatiles - parseInt(document.getElementById("portatil6").value);
                var pc6 = selectPortatilesConvertibles - parseInt(document.getElementById("portatilc6").value);
                var s6 = selectSobremesa - parseInt(document.getElementById("sobremesa6").value);
                var t6 = selectTablets - parseInt(document.getElementById("tablet6").value);
                var tm6 = selectTelefonoMovil - parseInt(document.getElementById("telefono6").value);

                //ocultar los options de portatiles reservados
                for (var i = selectPortatiles; i > p6; i--) {
                    document.getElementById('numPortatiles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de portatiles convertibles reservados
                for (var i = selectPortatilesConvertibles; i > pc6; i--) {
                    document.getElementById('numPortatilesConvertibles').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de sobremesa reservados
                for (var i = selectSobremesa; i > s6; i--) {
                    document.getElementById('numSobremesa').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de tablets reservados
                for (var i = selectTablets; i > t6; i--) {
                    document.getElementById('numTablets').options[i].setAttribute("hidden", "true");
                }
                //ocultar los options de telefono movil reservados
                for (var i = selectTelefonoMovil; i > tm6; i--) {
                    document.getElementById('numTelefonoMovil').options[i].setAttribute("hidden", "true");
                }
            } 
        });
    </script>
@endsection