<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/nav.css"/>

        <title>Bitek</title>
    </head>
    <body>
        <div id="nav-prin">
            <div id="logo">
                <ul id="nav">
                    <li><img src="../img/logo1.png"></li>
                </ul>
            </div>
            <div id="nav">
                <ul>
                    <li><a href="admin_pages/gesusr.php">Gestión Usuarios</a></li>
                    <li><a href="notificaciones.php">Gestión de Notificaciones</a></li>
                    <li><a href="admin_pages/consultas.php">Consultas</a></li>
                    <li><a href="admin_pages/gesreg.php">Gestión de Registros</a></li>
                    <li><a href="../php/session_destroy.php">Cerrar Sesión</a></li>
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
        </div>
        <!-- <iframe src="notificaciones.php" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe> -->
        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>