<?php 
include("../php/conexion.php");

if(!empty($_GET["correo"]) && !empty($_GET["contrasena"])){

    $email=strip_tags(mysqli_real_escape_string($conexion,$_GET['correo']));
	$pass=strip_tags(mysqli_real_escape_string($conexion,$_GET['contrasena']));
    
	$sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$email' and contrasena='$pass'");

	if($row=mysqli_fetch_array($sql)){

        if($row['usuario_activo'] == 'activo'){
            $response["success"] = 1;
            $response["message"] = "Bienvenido";

            $response["id_user"] = $row["id_user"];
            $response["mail"] = $row["correo"];
            $response["pass"] = $row["contrasena"];
            $response["type"] = $row["tipo"];
            $response["name"] = $row["nombre"];
            $response["lname"] = $row["apellidos"];

            die(json_encode($response));
        }else{
            $response["success"] = 0;
            $response["message"] = "El usuario que seleccionó no esta activo. Contacta con tu administrador para activar este usuario";
            die(json_encode($response));
    
        }
 
	}else{
        $response["success"] = 0;
        $response["message"] = "Credenciales incorrectas";
        die(json_encode($response));

	}
}else{
    $response["success"] = 0;
    $response["message"] = "No puedes dejar campos vaciós";
    die(json_encode($response));

}


?>