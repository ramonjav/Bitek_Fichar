<?php 

if(isset($_GET['del'])){
    include("../../php/funciones.php");
    DeleteRegistro($_GET['del']);
    header("Location: gesreg.php");

}


?>