<?php 
include("conexion.php");

if(!empty($_POST["correo"]) && !empty($_POST["contrasena"])){

    $email=strip_tags(mysqli_real_escape_string($conexion,$_POST['correo']));
	$pass=strip_tags(mysqli_real_escape_string($conexion,$_POST['contrasena']));
    
	$sql=mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$email' and contrasena='$pass'");

	if($row=mysqli_fetch_array($sql)){

		session_start();
        $_SESSION['id']=$row["id_user"];
		$_SESSION['email']=$row["correo"];
		$_SESSION['pass'] = $row["contrasena"];
		$_SESSION['tipo']=$row["tipo"];
        $_SESSION['nombre']=$row["nombre"];
        $_SESSION['apellidos']=$row["apellidos"];

		if($_SESSION['tipo']==1){
			header("Location: ../pages/inicio.php");
		} else{
			header("Location: ../pages/gestor.php");
		}
	} else {
		header("Location: ../index.php?err=true");
	}
}else{
    echo "empy";
}


?>