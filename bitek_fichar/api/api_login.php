<?php 
include("../php/conexion.php");

//if(!empty($_POST["correo"]) && !empty($_POST["contrasena"])){

    $email=$_POST['correo'];
	$pass=$_POST['contrasena'];
    
	$sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$email' and contrasena='$pass'");

	if($row=mysqli_fetch_array($sql)){

        if($row['usuario_activo'] == 'activo'){
            $response["success"] = 1;
            $response["message"] = "Bienvenido";

            $response["id_user"] = $row["id_user"];
            $response["dni"] = $row["dni"];
            $response["mail"] = $row["correo"];
            $response["pass"] = $row["contrasena"];
            $response["type"] = $row["tipo"];
            $response["name"] = $row["nombre"];
            $response["lname"] = $row["apellidos"];

            echo json_encode($response);
        }else{
            $response["success"] = 0;
            $response["message"] = "El usuario que seleccionó no esta activo. Contacta con tu administrador para activar este usuario";
            echo json_encode($response);
    
        }
 
	}else{
        $response["success"] = 0;
        $response["message"] = "Credenciales incorrectas";
        echo json_encode($response);

	}
/*}else{
    $response["success"] = 0;
    $response["message"] = "No puedes dejar campos vaciós";
    //secho json_encode($response);

}*/


?>