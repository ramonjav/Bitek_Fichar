<?php
include("../php/conexion.php");
include("../php/funciones.php");

#0 = deny
#1 = success
#2 = confirm

$user_id = $_GET['id'];
$fecha = $_GET['date'];
$hora = $_GET['hour'];
$confirm = $_GET['confirm'];

    if ($_GET["accion"] == 'inicio') {

        $ultimoRegistro =  getLastReg($user_id);

        if($ultimoRegistro['accion'] == "inicio" && $confirm == '0'){
            $response["success"] = 2;
            $response["message"] = "Confirmar";

            echo json_encode($response);
        }else{
            
            try {
                InsertRegistro($fecha, $hora, "inicio", 1, 0, "trabajando", $user_id);
                $response["success"] = 1;
                $response["message"] = "Cool";

            } catch (\Throwable $th) {
                $response["success"] = 0;
                $response["message"] = "Problems";
            }
            echo json_encode($response);
        }
    }

    if ($_GET["accion"] == 'final') {
        $ultimoRegistro =  getLastReg($user_id);

        if($ultimoRegistro['accion'] == "final" && $confirm == '0'){
            $response["success"] = 2;
            $response["message"] = "Confirmar";

            echo json_encode($response);
        }else{
            try {
                InsertRegistro($fecha, $hora, "final", 1, 0, "trabajando", $user_id);
                $response["success"] = 1;
                $response["message"] = "Cool";

            } catch (\Throwable $th) {
                $response["success"] = 0;
                $response["message"] = "Problems";
            }

            echo json_encode($response);
        }
    }

    /*if(isset($_POST["aceptar"])){
        if(isset($_GET["iniciar"])){
            InsertRegistro($fecha, $hora, "inicio", 1, 0, "trabajando", $user_id);

        }else{
            InsertRegistro($fecha, $hora, "final", 1, 0, "trabajando", $user_id);
        }
        header("Location: ../pages/fichar.php");
    }*/
?>