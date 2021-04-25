<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="../css/nav.css"/> -->

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/mbcsmbmcp.css" type="text/css" />
        <title>Bitek</title>
    </head>
    <body>
            <!-- <div id="nav">
                <ul>
                    <li><img src="../img/logo1.png"></li>
                    <li><a href="admin_pages/gesusr.php">Gestión Usuarios</a></li>
                    <li><a href="notificaciones.php">Gestión de Notificaciones</a></li>
                    <li><a href="admin_pages/consultas.php">Consultas</a></li>
                    <li><a href="admin_pages/gesreg.php">Gestión de Registros</a></li>
                    <li><a href="../php/session_destroy.php">Cerrar Sesión</a></li>
                </ul>
            </div> -->

            <div id="mbmcpebul_wrapper" style="max-width: 913px;">
                <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
                    <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1"></a></div></li>
                    <li><div class="buttonbg" style="width: 120px;"><a>Gestión Usuario</a></div></li>
                    <li><div class="buttonbg" style="width: 175px;"><a>Gestión de Notificaciones</a></div></li>
                    <li><div class="buttonbg" style="width: 87px;"><a>Consultas</a></div></li>
                    <li><div class="buttonbg" style="width: 147px;"><a>Gestión de Registros</a></div></li>
                    <li><div class="buttonbg"><a>Cerrar Sesión</a></div></li>
                </ul>
            </div>
        <div id="cuerpo">
            <?php 
                include("../php/conexion.php");
                session_start();

                if(!isset($_SESSION['tipo'])){
                    header("Location: ../index.php");
                }else{
                    if($_SESSION['tipo'] == 2){
                        $nombre = $_SESSION['nombre'];
                        $apellidos = $_SESSION['apellidos'];
                        echo "Bienvenido, ", $nombre, " ", $apellidos;
                    }else{
                        header("Location: inicio.php");
                    }
                }
            ?>
        </div>
        <!-- <iframe src="notificaciones.php" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe> -->
        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
    </body>
</html>