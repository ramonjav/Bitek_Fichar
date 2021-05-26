<?php
include("../php/conexion.php");
include("../php/funciones.php");

$id_regs = $_POST['id_reg'];
$accion = $_POST['ac'];

if($accion == '1'){
    UpdateNotificacion("trabajador", $id_regs, "1");
    echo "aceptado";
}else{
    UpdateNotificacion("trabajador", $id_regs, "2");
    echo "rechazado";
}
