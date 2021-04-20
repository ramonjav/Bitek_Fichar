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
            $sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_user = $JID");

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

if(isset($_POST['guardar'])){
    if(!empty($_POST['dni'])){
        if(!empty($_POST['nombre'])){
            if(!empty($_POST['apellidos'])){
                if(!empty($_POST['correo'])){
                    if(!empty($_POST['contrasena'])){
                        if(!empty($_POST['tipo'])){

                            $dni = $_POST['dni'];
                            $nombre = $_POST['nombre'];
                            $apellidos = $_POST['apellidos'];
                            $correo = $_POST['correo'];
                            $contrasena = $_POST['contrasena'];
                            $tipo = $_POST['tipo'];

                            if(comprobarUsuario($dni)){
                                UpdateUsuario($dni, $nombre, $apellidos, $correo, $contrasena, $tipo);
                            }else{
                                InsertUsuario($dni, $nombre, $apellidos, $correo, $contrasena, $tipo);
                            }
                            
                        }else{ echo "No puedes dejar el tipo en blanco";}
                    }else{echo "No puedes dejar la contraseña en blanco";}
                }else{echo "No puedes dejar el correo en blanco";}
            }else{echo "No puedes dejar los apellidos en blanco";}
        }else{echo "No puedes dejar el nombre en blanco";} 
    }else{echo "No puedes dejar el DNI/NIE en blanco";}
}


if(isset($_POST['eliminar'])){
    if(!empty($_POST['dni'])){
        $dni = $_POST['dni'];
        if(comprobarUsuario($dni)){
            DeleteUsuario($dni);
        }else{echo "Este usuario no existe";}
    }else{echo "No puedes dejar el DNI/NIE en blanco";}
}
?>