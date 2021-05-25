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
        <div id="cuerpo" class="container-fluid">
            <?php 
                include("../php/conexion.php");
                session_start();

                if(!isset($_SESSION['tipo'])){
                    header("Location: ../index.php");
                }else{
                    if($_SESSION['tipo'] == 2){
                        $nombre = $_SESSION['nombre'];
                        $apellidos = $_SESSION['apellidos'];
                        echo "<div class='titulo'><p>Bienvenido, <br>", $nombre, " ", $apellidos,"</p></div>";
                    }else{
                        header("Location: fichar.php");
                    }
                }
            ?>
            <div style="text-align:center;padding:1em 0;">
                <h2>
                    <a style="text-decoration:none;" href="#">
                    <span style="color:gray;">Hora actual en</span>
                    <br/>Donostia - San Sebastián, País Vasco</a>
                </h2>
                <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=large&timezone=Europe%2FMadrid" width="100%" height="140" frameborder="0" seamless></iframe>
            </div>
        </div>
        <!-- <iframe src="notificaciones.php" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe> -->
        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
    </body>
</html>
<!-- CSS FOR WALTER YOEL RAMOS LUQUEZ -->