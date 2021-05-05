<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../css/mbcsmbmcp.css" type="text/css" />
    <link rel="stylesheet" href="../../css/gesusr.css" type="text/css"/>
    <title>Bitek</title>
</head>
<body>
    <div id="mbmcpebul_wrapper" style="max-width: 913px;" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1" href="../gestor.php"></a></div></li>
            <li><div class="buttonbg" style="width: 120px;"><a href="gesusr.php">Gestión Usuario</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="../notificaciones.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 87px;"><a href="../calendar.php">Calendario</a></div></li>
            <li><div class="buttonbg" style="width: 147px;"><a href="gesreg.php">Gestión de Registros</a></div></li>
            <li><div class="buttonbg"><a href="../../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>
    <?php 
        include("../../php/funciones.php");
        include("../../php/conexion.php");
        session_start();

        if(!isset($_SESSION['tipo'])){
            header("Location: ../../index.php");
        }else{
            if($_SESSION['tipo'] == 1){
                header("Location: ../fichar.php");
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

        echo "<div class='selector'><p><select id='opciones' name='opciones'>
        <option value='0' selected disabled hidden>Seleccione:</option>";
          while ($valores = mysqli_fetch_array($table)) {
                $id = $valores['id_user'];
                $nombre = $valores['nombre']; 
                $apellidos = $valores['apellidos']; 
                echo "<option value='$id'>$nombre $apellidos</option>";
            }
        echo  "</select></p></div>";
    ?>
    
    <div class="container">
        <div class="formu">
            <form action='gesusr.php' method='POST'>
                <!-- DNI/NIE-->
                <label for='name'>DNI/NIE</label>
                <input require type='name' name='dni' id="dni" value='<?php echo $JDNI; ?>'>

                <!-- Nombre -->
                <label for='name'>Nombre</label>
                <input type='name' name='nombre' value='<?php echo $JNOMBRE; ?>'>

                <!-- Apellidos -->
                <label for='name'>Apellidos</label>
                <input type='name' name='apellidos' value='<?php echo $JAPELLIDOS; ?>'>

                <!-- Correo -->
                <label for='name'>Correo</label>
                <input type='name' name='correo' value='<?php echo $JMAIL; ?>'>

                <!-- Contraseña -->
                <label for='name'>Contraseña</label>
                <input type='name' name='contrasena' value='<?php echo $JPASS; ?>'>

                <!-- Tipo -->
                <label for='name'>Tipo</label>
                <select id='tipo' name='tipo'>
                    <option value='1' <?php if($JTIPO == 1){ echo "selected";}?>>Empleado</option> 
                    <option value='2' <?php if($JTIPO == 2){ echo "selected";}?> >Administrador</option>
                </select>
            
                <div class="botones">
                    <div class="guar"><input type='submit' name= 'guardar' value='Guardar'></div>
                    <div class="elim"><input type='submit' name= 'eliminar' value='Eliminar'></div>
                    
                </div> 
            </form>
        </div>
    </div>
    <script>
        const select = document.querySelector('#opciones');
        const URL = window.location.pathname;

        const opcionCambiada = () => {
            const indice = select.value;
            const opcionSeleccionada = select.options[indice];
            window.location.href = URL + '?jid=' + indice;
        };

        select.addEventListener('change', opcionCambiada);
    </script>

    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/mbjsmbmcp.js"></script>
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
    $dni = $_POST['dni'];
    if(comprobarUsuario($dni)){
        DeleteUsuario($dni);
        header("Location: gesusr.php");
    }else{echo "Este usuario no existe";}
}
?>