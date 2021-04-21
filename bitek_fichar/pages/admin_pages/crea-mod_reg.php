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

        if(isset($_GET['mod'])){
            $reg_id = $_GET['mod'];
            $sql=mysqli_query($conexion,"SELECT * FROM registro WHERE id_reg = '$reg_id'");

	        if($row=mysqli_fetch_array($sql)){
                
                $FECHA=$row["fecha"];
                $HORA = $row["hora"];
                $ACCION=$row["accion"];
                $ACEMP=$row["aceptado_trabajador"];
                $ACEM=$row["aceptado_empresa"];
                $ESTADO=$row["estado"];
            }
        }else{
            $FECHA='';
            $HORA='';
            $ACCION='';
            $ACEMP='';
            $ACEM='';
            $ESTADO='';
        }

        echo"
        <form action='crea-mod_reg.php' method='post'>
            <!--FECHA -->
            <p><label for='name'>Fecha: </label>
            <input type='name' name='fecha' value='$FECHA'></p>

            <!-- HORA -->
            <p><label for='name'>Hora: </label>
            <input type='name' name='hora' value='$HORA'></p>

            <!-- ACCION -->
            <p><label for='name'>Acción: </label>
            <input type='name' name='accion' value='$ACCION'></p>

            <!-- ACEP_EMPLEADO -->
            <p><label for='name'>Aceptado empleado: </label>
            <input type='name' name='acemp' value='$ACEMP'></P>

            <!-- ACEP_EMPRESA -->
            <p><label for='name'>Aceptado Empresa: </label>
            <input type='name' name='acem' value='$ACEM'></p>

            <!-- Tipo -->
            <p><label for='name'>Estado:</label>
            <input type='name' name='estado' value='$ESTADO'></p>

            <!-- Tipo -->
            <p><label for='name'>Estado:</label>
            <input type='name' name='estado' value='$ESTADO'></p>
        
            <input type='submit' name= 'guardar' value='Guardar'>
            <input type='submit' name= 'eliminar' value='Eliminar'>
            <input type='submit' name= 'nuevo' value='Nuevo Registro'>
        
        </form>";

    ?>

    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

<?php

?>