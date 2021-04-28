<?php
$hostname = "localhost";
$usuariodb = "root";
$contrasenadb = "";
$dbname = "bitek_ddbb";
	
// Generar conexion con el servidor MySQl
$conexion = mysqli_connect($hostname, $usuariodb, $contrasenadb, $dbname);