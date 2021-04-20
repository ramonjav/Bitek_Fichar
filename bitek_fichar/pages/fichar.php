<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <title>Bitek</title>
</head>
<body>
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
</body>
</html>

    