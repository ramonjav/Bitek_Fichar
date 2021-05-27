<?php
$conexion=mysqli_connect("localhost", "root", "", "bitek_ddbb");
	if (mysqli_connect_errno()){
	    echo "Error de conexión: " . mysqli_connect_error();
	}
	mysqli_query($conexion, "SET NAMES UTF8");
?>