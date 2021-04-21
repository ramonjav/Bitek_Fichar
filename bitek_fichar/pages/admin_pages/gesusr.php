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

        if(isset($_GET['jid'])){
            $JID = $_GET['jid'];
            $sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE id_user = $JID");

	        if($row=mysqli_fetch_array($sql)){
                $JDNI=$row["dni"];
                $JMAIL=$row["correo"];
                $JPASS = $row["contrasena"];
                $JTIPO=$row["tipo"];
                $JNOMBRE=$row["nombre"];
                $JAPELLIDOS=$row["apellidos"];

            }
        }else{
            $JDNI='';
            $JMAIL='';
            $JPASS ='';
            $JTIPO='';
            $JNOMBRE='';
            $JAPELLIDOS='';
        }

        echo "<select id='opciones' name='opciones'>
        <option value='0' selected disabled hidden>Seleccione:</option>";
          while ($valores = mysqli_fetch_array($table)) {
                $nombre = $valores['nombre']; 
                $apellidos = $valores['apellidos']; 
                echo "<option value=>$nombre $apellidos</option>";
            }
        echo  "</select>";
        
    
    echo "<form action='gesusr.php' method='post'>
        <!-- DNI/NIE-->
        <p><label for='name'>DNI/NIE: </label>
        <input type='name' name='dni' id='dni' value='$JDNI'></p>

        <!-- Nombre -->
        <p><label for='name'>Nombre: </label>
        <input type='name' name='nombre' value='$JNOMBRE'></p>

        <!-- Apellidos -->
        <p><label for='name'>Apellidos: </label>
        <input type='name' name='apellidos' value='$JAPELLIDOS'></p>

        <!-- Correo -->
        <p><label for='name'>Correo: </label>
        <input type='name' name='correo' value='$JMAIL'></P>

        <!-- Contraseña -->
        <p><label for='name'>Contraseña: </label>
        <input type='name' name='contrasena' value='$JPASS'></p>

        <!-- Tipo -->
        <p><label for='name'>Tipo:</label>
        <select id='tipo' name='tipo'>";
            if($JTIPO == 2){
                echo "<option value='1'>Empleado</option> 
                <option value='2' selected >Administrador</option>";
            }else{
                echo "<option value='1' selected>Empleado</option> 
                <option value='2' >Administrador</option>";
            }
        echo"</select></p>
    
        <input type='submit' name= 'guardar' value='Guardar'>
        <input type='submit' name= 'eliminar' value='Eliminar'>
        <input type='submit' name= 'nuevo' value='Nuevo Usuario'>
        
    </form>
    <p><a href='../gestor.php'>Volver</a></p>

    <script>
        const select = document.querySelector('#opciones');
        const URL = window.location.pathname;

        const opcionCambiada = () => {
            const indice = select.selectedIndex;
            const opcionSeleccionada = select.options[indice];
            window.location.href = URL + '?jid=' + indice;
        };

        select.addEventListener('change', opcionCambiada);
    </script>";

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
                            header("Location: gesusr.php");
                            
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
            header("Location: gesusr.php");
        }else{echo "Este usuario no existe";}
    }else{echo "No puedes dejar el DNI/NIE en blanco";}
}
?>