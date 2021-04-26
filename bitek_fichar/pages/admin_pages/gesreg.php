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
    <title>Bitek</title>
</head>
<body>
    <div id="mbmcpebul_wrapper" style="max-width: 913px;" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1" href="../gestor.php"></a></div></li>
            <li><div class="buttonbg" style="width: 120px;"><a href="gesusr.php">Gestión Usuario</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="../notificaciones.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 87px;"><a href="consultas.php">Consultas</a></div></li>
            <li><div class="buttonbg" style="width: 147px;"><a href="gesreg.php">Gestión de Registros</a></div></li>
            <li><div class="buttonbg"><a href="../../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>
    <?php 
        include("../../php/conexion.php");
        session_start();

        if(!isset($_SESSION['tipo'])){
            header("Location: ../../index.php");
        }else{
            if(!$_SESSION['tipo'] == 2){
                header("Location: inicio.php");
            }
        }

        if(!empty($_GET['date']) && isset($_GET['opciones'])){
            $date = $_GET['date'];
            $JID = $_GET['opciones'];
            $sql = "SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario WHERE fecha = '$date' AND id_usuario = $JID ORDER BY `id_reg` DESC";
            echo "completo";
        }elseif(!empty($_GET['date'])){
            $date = $_GET['date'];
            $sql = "SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario WHERE fecha = '$date' ORDER BY `id_reg` DESC";

        }elseif(isset($_GET['opciones'])){
            $JID = $_GET['opciones'];
            $sql = "SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario WHERE id_usuario = $JID ORDER BY `id_reg` DESC";

        }else{
            $sql = "SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario ORDER BY `id_reg` DESC";
        }

        $sql_emp = "SELECT * FROM `usuarios`";
        $table_emp = mysqli_query($conexion, $sql_emp);

        echo "<form accion='POST'>
        <select id='opciones' name='opciones'>
        <option value='0' selected disabled hidden>Seleccione:</option>";
          while ($valores = mysqli_fetch_array($table_emp)) {
                $id = $valores['id_user'];
                $nombre = $valores['nombre']; 
                $apellidos = $valores['apellidos']; 
                echo "<option value='$id'>$nombre $apellidos</option>";
            }
        echo  "</select>
        <input type='date' name='date'>
        <input type='submit' name='buscar' value='Buscar'>
        </form>";

        
        $table = mysqli_query($conexion, $sql);
        $rows = mysqli_num_rows($table);

        if($rows > 0){
            echo "
                <table border=1 style='width:100%'>
                <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acción</th>
                <th>Aceptado Empleado</th>
                <th>Aceptado Empresa</th>
                <th>Empleado</th>
                <th>Estado</th>
                <th>Modificar</th>
                <th>Eliminar</th>
                </tr>";

            while($row = mysqli_fetch_array($table)){

                $id_reg = $row['id_reg'];
                $fecha  = $row['fecha'];
                $hora = $row['hora'];
                $accion = $row['accion'];
                $aceptado_trabajador = $row['aceptado_trabajador'];
                $aceptado_empresa = $row['aceptado_empresa'];
                $estado = $row['estado'];
                $nombre_emp =$row["nombre"]." ".$row["apellidos"];;

                echo "<tr><td>$id_reg</td>
                <td>$fecha</td>
                <td>$hora</td>
                <td>$accion</td>
                <td>$aceptado_trabajador</td>
                <td>$aceptado_empresa</td>
                <td>$nombre_emp</td>
                <td>$estado</td>
                <td><a href='crea-mod_reg.php?mod=$id_reg'>Modificiar</a></td>
                <td><a href='eliminar_registro.php?del=$id_reg'>Eliminar</a></td></tr>";
            }    
            echo "</table>";
        }
    ?> 
    <p><a href="crea-mod_reg.php">Crear registro nuevo</a></p>


    <!-- <script> 
        const select = document.querySelector('#opciones');
        const URL = window.location.pathname;

        const opcionCambiada = () => {
            const indice = select.value;
            const opcionSeleccionada = select.options[indice];
            window.location.href = URL + '?jid=' + indice;
        };

        select.addEventListener('change', opcionCambiada);
    </script>-->
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/mbjsmbmcp.js"></script>
</body>
</html>

<?php
    if(isset($_POST['guardar'])){
        if(isset($_GET['opciones'])){
            $jid = $_GET['opciones'];
            echo $jid;
        }

        if(isset($_GET['date'])){
            $date = $_GET['date'];
            echo $date;

        }

    }
?>