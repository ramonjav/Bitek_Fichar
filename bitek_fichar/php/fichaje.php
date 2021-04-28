<?php 

include("../php/funciones.php");
session_start();

$user_id = $_SESSION['id'];
$fecha = date("Y-m-d");
$fecha_ayer = date("Y-m-d", strtotime($fecha."- 1 days"));
$hora = date("H:i:s");

if (isset($_POST["inicio"])) {

    $ultimoRegistro =  getLastReg($user_id);

    if($ultimoRegistro['accion'] == "inicio"){
        echo "<form action='fichaje.php?iniciar=true' method='post'>
        <p><label>Tu ultimo registro tiene como acción iniciar, ¿Estas seguro que quieres volver a selecionar iniciar?</label>
        <input type='submit' name='aceptar' value='Aceptar'>
        <input type='submit' name='cancelar' value='Cancelar'>
        </form>";
    }else{
        InsertRegistro($fecha, $hora, "inicio", 1, 0, "trabajando", $user_id);
        header("Location: ../pages/fichar.php");
    }
}


if (isset($_POST["final"])) {
    $ultimoRegistro =  getLastReg($user_id);

    if($ultimoRegistro['accion'] == "final"){
        echo "<form action='fichaje.php?final=true' method='post'>
        <p><label>Tu ultimo registro tiene como acción final, ¿Estas seguro que quieres volver a selecionar final?</label>
        <input type='submit' name='aceptar' value='Aceptar'>
        <input type='submit' name='cancelar' value='Cancelar'>
        </form>";
    }else{
        InsertRegistro($fecha, $hora, "final", 1, 0, "trabajando", $user_id);
        header("Location: ../pages/fichar.php");
    }
}

if(isset($_POST["aceptar"])){
    if(isset($_GET["iniciar"])){
        InsertRegistro($fecha, $hora, "inicio", 1, 0, "trabajando", $user_id);
        
    }else{
        InsertRegistro($fecha, $hora, "final", 1, 0, "trabajando", $user_id);
    }
    header("Location: ../pages/fichar.php");
}

if(isset($_POST["cancelar"])){
    header("Location: ../pages/fichar.php");
}
?>