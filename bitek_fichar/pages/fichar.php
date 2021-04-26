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
    <div id="mbmcpebul_wrapper" style="max-width: 913px;" class="container">
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
        include("../php/funciones.php");
        session_start();

        $user_id = $_SESSION['id'];
        $fecha = date("Y-m-d");
        $fecha_ayer = date("Y-m-d", strtotime($fecha."- 1 days"));
        $hora = date("H:i:s");

        echo "<form action='../php/fichaje.php' method='post'>";
        if(!isset($_GET['especial'])){
            echo "<input type='submit' name='inicio' value='Inicio'></p>
            <input type='submit' name='final' value='Final'></p>";
        }else{
            echo "Estas de ", $_GET['especial'];
        }
        echo "</form>";
        echo "<a href='inicio.php'>Volver</a>";

        if(isset($_POST["volver"])){header("Location: inicio.php");}

        $sql = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' AND `fecha` = '$fecha' OR `fecha` = '$fecha_ayer'";
        $result = mysqli_query($conexion, $sql);

        echo "<table border=1 style='width:100%' >
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acción</th>
        </tr>
        ";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            if($row['estado'] == "vacaciones" || $row['estado'] == "baja"){
                echo "<td>", $row['fecha'], "</td><td>",  $row['estado'], "</td>" ;
            }else{
            echo "<td>", $row['fecha'], "</td><td>",  $row['hora'], "</td><td>", $row['accion'], "</td>" ;
            }
            echo "</tr>";
        }

        echo "</table>";

    ?>

    <script src="../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
</body>
</html>

    