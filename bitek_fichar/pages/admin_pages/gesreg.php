<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <title>Bitek</title>
</head>
<body>
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

        $sql = "SELECT * FROM `registro` ORDER BY `id_reg` DESC";
        
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

                echo "<tr><td>$id_reg</td>
                <td>$fecha</td>
                <td>$hora</td>
                <td>$accion</td>
                <td>$aceptado_trabajador</td>
                <td>$aceptado_empresa</td>
                <td>$estado</td>
                <td><a href='crea-mod_reg.php?mod=$id_reg'>Modificiar</a></td>
                <td><a href='eliminar_registro.php?del=$id_reg'>Eliminar</a></td></tr>";
            }    
            echo "</table>";
        }
    ?> 
    <p><a href="crea-mod_reg.php">Crear registro nuevo</a></p>
    <p><a href="../gestor.php">Volver</a></p>

    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>