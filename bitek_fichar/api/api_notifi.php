<?php

    include("../php/conexion.php");

    $user_id = $_POST["id_user"];
    
    $sql = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' AND `aceptado_trabajador` = '0'";
    $query = $conexion->query($sql);
    
    $datos = array();
    
    while($resultado = $query->fetch_assoc()) {
        $datos[] = $resultado;
    }
    
    //echo json_encode($datos);
    echo json_encode(array("Usuarios" => $datos));
?>