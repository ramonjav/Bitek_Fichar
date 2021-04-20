<?php 

function InsertRegistro($fecha, $hora, $accion, $acept, $acepe, $estado, $user_id){
    include("conexion.php");
    $sql="INSERT INTO registro (fecha, hora, accion, aceptado_trabajador, aceptado_empresa, estado, id_usuario) VALUES ('$fecha', '$hora', '$accion', '$acept', '$acepe', '$estado', '$user_id')";

    if (mysqli_query($conexion, $sql)) {
        echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function getLastReg($user_id){
    include("conexion.php");
    $sqlCom = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' ORDER by `id_reg` DESC LIMIT 1";
        
    $resultcom = mysqli_query($conexion, $sqlCom);

    $row = mysqli_fetch_array($resultcom);

    return $row;

}

function InsertUsuario($dni, $nombre, $apellidos, $correo, $contrasena, $tipo){
    include("conexion.php");
    $sql="INSERT INTO usuarios (nombre, apellidos, dni, correo, tipo, contrasena) VALUES ('$nombre', '$apellidos', '$dni', '$correo', '$tipo', '$contrasena')";

    if (mysqli_query($conexion, $sql)) {
        echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function UpdateUsuario($dni, $nombre, $apellidos, $correo, $contrasena, $tipo){
    include("conexion.php");
    $sql = "UPDATE `usuarios` SET `nombre`='$nombre',`apellidos`='$apellidos',`dni`='$dni',`correo`='$correo',`tipo`='$tipo',`contrasena`='$contrasena' WHERE dni = '$dni'";

    if (mysqli_query($conexion, $sql)) {
        echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function DeleteUsuario($dni){
    include("conexion.php");
    $sql = "DELETE FROM `usuarios` WHERE `dni` = '$dni'";

    if (mysqli_query($conexion, $sql)) {
        echo "New record deleted successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

function getTable($tabla){

    include("conexion.php");
    $sqlCom = "SELECT * FROM `$tabla`";
        
    $resultcom = mysqli_query($conexion, $sqlCom);

    return $resultcom;
}

function comprobarUsuario($dni){

    include("conexion.php");
    $sqlCom = "SELECT * FROM `usuarios` WHERE `dni` = '$dni'";
        
    $table = mysqli_query($conexion, $sqlCom);
    $rows = mysqli_num_rows($table);

    if($rows > 0){
        $com = true;
    }else{
        $com = false;
    }
    return $com;
}


?> 