<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/mbcsmbmcp.css" type="text/css" />
        <title>Bitek</title>
    </head>
    <body>
    <div id="mbmcpebul_wrapper" style="max-width: 913px;" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1" href="gestor.php"></a></div></li>
            <li><div class="buttonbg" style="width: 120px;"><a href="admin_pages/gesusr.php">Gestión Usuario</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="notificaciones.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 87px;"><a href="admin_pages/consultas.php">Consultas</a></div></li>
            <li><div class="buttonbg" style="width: 147px;"><a href="admin_pages/gesreg.php">Gestión de Registros</a></div></li>
            <li><div class="buttonbg"><a href="../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>
    <form>
        <?php 
            include("../php/conexion.php");
            session_start();

            $user_id = $_SESSION['id'];
            $user_tipo = $_SESSION['tipo'];
            if($user_tipo == 2){
                $sql = "SELECT * FROM `registro` WHERE `aceptado_empresa` = '0'";
            }else{
                $sql = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' AND `aceptado_trabajador` = '0'";
            }
            $result = mysqli_query($conexion, $sql);
            $rows = mysqli_num_rows($result);

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
                    <th>Estado</th>
                    <th>Select</th>
                    </tr>";

                while($row = mysqli_fetch_array($result)){
                    $id_reg = $row['id_reg'];
                    $fecha = $row['fecha'];
                    $hora = $row['hora'];
                    $accion = $row['accion'];
                    $aceptado_tra = $row['aceptado_trabajador'];
                    $aceptado_emp = $row['aceptado_empresa'];
                    $estado = $row['estado'];
        
                    echo "<tr><td>$id_reg</td>
                    <td>$fecha</td>
                    <td>$hora</td>
                    <td>$accion</td>
                    <td>$aceptado_tra</td>
                    <td>$aceptado_emp</td>
                    <td>$estado</td>
                    <td><input type='checkbox' value='$id_reg'></td></tr>";
                }    
                echo "</table>";

            }else{
                echo "No tienes notificaciones :C";
            }

        ?>
        <input type="submit" name="aceptar" value="Aceptar">
        <input type="submit" name="rechazar" value="Rechazar">
        </form>

        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
    </body>
</html>


<?php
    if(isset($_GET['aceptar'])){
      
    }

    if(isset($_GET['rechazar'])){
        
    }
?>
