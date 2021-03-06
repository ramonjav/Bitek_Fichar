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
    <link rel="stylesheet" href="../css/fichar.css"/>
    <title>Bitek</title>
</head>
<body>
    <div id="mbmcpebul_wrapper" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <a class="button_1" href="fichar.php"><li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"></div></li></a>
            <li><div class="buttonbg" style="width: 120px;"><a href="fichar.php">Fichar</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="notificaciones_user.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="calendar_user.php">Consultar calendario</a></div></li>
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
            echo "<input class='btnin' type='submit' name='inicio' value='Inicio'></p>
            <input class='btnin' type='submit' name='final' value='Final'></p>";
        }else{
            echo "Estas de ", $_GET['especial'];
        }
        echo "</form>";

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

<?php 
   /* $sql = "SELECT * FROM `registro` WHERE `fecha` = '2021-04-27' ORDER BY `hora`";
    $result = mysqli_query($conexion, $sql); 
    $rows = mysqli_num_rows($result);
    $primer_registro = true;
    $correct = false;
    $count = 0;
    
    if($rows%2==0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            if($primer_registro == true && $row['accion'] == "final"){
                echo "Falta Información" ;
                break;
            }else{
                // echo "<p>".$row['fecha']. " " .$row['hora']."</p>";
                $primer_registro = false;
                $hora =  new DateTime($row['hora']);
                $horas[$count] = $hora;
                $count++;
                $correct = true;
            }
        }
    }else{
        echo "Falta información";
    }

    if($correct == true){
        $array_num = count($horas);
        for ($i = 0; $i < $array_num; ++$i){
            $no = $i+1;
            if($no >=2){
                break;
            }else{
                $intervalo = $horas[$i]->diff($horas[$i+1]);
                
            }
            
            echo $intervalo->format('%H Horas %i Minutos y %s Segundos');
        }       
    }*/
?> 