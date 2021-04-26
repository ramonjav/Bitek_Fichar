<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <title>Bitek</title>
</head>
<body>
    <?php 
        include("../../php/funciones.php");
        include("../../php/conexion.php");
        session_start();

        if(!isset($_SESSION['tipo'])){
            header("Location: ../../index.php");
        }else{
            if(!$_SESSION['tipo'] == 2){
                header("Location: inicio.php");
            }
        }
        $table = getTable("usuarios");
    ?>
        <form action='crear_reg.php' method='post'>
            <!--FECHA -->
            <p><label for='name'>Fecha: </label>
            <input type='date' name='fecha'></p>

            <!-- HORA -->
            <p><label for='name'>Hora: </label>
            <input type='time' name='hora' step='1'></p>

            <!-- ACCION -->
            <p><label for='name'>Acción: </label>
            <select name='accion'>
                <option value='inicio' >Inicio</option> 
                <option value='final'>Final</option>
            </select></p></p></p>

            <!-- ACEP_EMPRESA 
            <p><label for='name'>Aceptado Empresa: </label>
            <select name='acep_emp'>
                <option value='0' >Pendiente</option> 
                <option value='1' >Aceptado</option>
                <option value='2' >Rechazado</option>
            </select></p>-->

            <!-- Estado 
            <p><label for='name'>Estado:</label>
            <select>
                <option value='trabajando' >Trabajando</option> 
                <option value='baja' >De Baja</option>
                <option value='vacaciones' >En Vacaciones</option>
            </select></p>-->

            <?php
                echo "<p>
                <label for='name'>Empleado:</label>
                <select name='empleado'>
                <option value='0' selected disabled hidden>Seleccione:</option>";
                  while ($valores = mysqli_fetch_array($table)) {
                        $id = $valores['id_user'];
                        $nombre = $valores['nombre']; 
                        $apellidos = $valores['apellidos']; 
                        echo "<option value='$id'>$nombre $apellidos</option>";
                    }
                echo  "</select></p>";
            ?>

            <input type='submit' name= 'guardar' value='Guardar'>

        </form>

    <p><a href="gesreg.php">Volver</a></p>
    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['guardar'])){
    if(!empty($_POST['fecha'])){
        if(!empty($_POST['hora'])){

            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $accion = $_POST['accion'];
            $estado = $_POST['estado'];
            $empleado = $_POST['empleado'];

            InsertRegistro($fecha, $hora, $accion, "0", "1", "trabajando", $empleado);
            header("Location: gesreg.php");
        }
    }
}

?>