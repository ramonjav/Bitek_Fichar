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
            $sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_user = $reg_id");

	        if($row=mysqli_fetch_array($sql)){
                
                $FECHA=$row["fecha"];
                $HORA = $row["hora"];
                $ACCION=$row["accion"];
                $ACEMP=$row["nombre"];
                $ACEM=$row["apellidos"];
                $ESTADO=$row["estado"];
            }
        }else{
            echo "creando";
        }

    ?>

    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

<?php

?>