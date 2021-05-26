
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
        <link rel="stylesheet" href="../css/gestor.css"/>
        <title>Bitek</title>
    </head>
<body>
    <div id="mbmcpebul_wrapper" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1" href="inicio.php"></a></div></li>
            <li><div class="buttonbg" style="width: 120px;"><a href="admin_pages/gesusr.php"></a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="notificaciones.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="admin_pages/consultas.php">Consultar calendario</a></div></li>
            <li><div class="buttonbg"><a href="../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>
    <?php 
        include("../php/conexion.php");
        session_start();

        if(!isset($_SESSION['tipo'])){
            header("Location: ../index.php");
        }else{
            if($_SESSION['tipo'] == 1 ){

                $nombre = $_SESSION['nombre'];
                $apellidos = $_SESSION['apellidos'];
    
                echo "Bienvenido, ", $nombre, " ", $apellidos;
    
            }else{
                 header("Location:  gestor.php");
            }
        }

    ?>

    <!-- <form action='#' method='post'>

        <input type="submit" name="fichar" value="Fichar"></p>
        <input type="submit" name="notificaciones" value="Gestor de Notificaciones"></p>
        <input type="submit" name="consultar" value="Consultar Calendario"></p>
        <input type="submit" name="cerrar" value="Cerrar Sesión"></p>
    
    </form> -->

    <?php

        $user_id = $_SESSION['id'];
        $fecha = date("Y-m-d");

        if (isset($_POST["fichar"])){
            $sql = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' AND `fecha` = '$fecha' AND `estado` IN ('vacaciones', 'baja')";
            $result = mysqli_query($conexion, $sql);

            if ($row = mysqli_fetch_array($result)){
                $especial = $row['estado'];
                header("Location: fichar.php?especial=$especial");
            }else{
                header("Location: fichar.php");
            }
     
        }

        if (isset($_POST["notificaciones"])) {
            header("Location: notificaciones.php");
        }

        if (isset($_POST["cerrar"])) {
            header("Location: ../php/session_destroy.php");
        }
    ?>
    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
</body>
</html>

          