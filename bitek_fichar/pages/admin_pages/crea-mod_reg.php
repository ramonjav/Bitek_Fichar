<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <title>Bitek</title>
</head>
<body>
    <?php 
        include("../../php/funciones.php");
        include("../../php/conexion.php");
        session_start();

        if(!isset($_SESSION['tipo'])){
            header("Location: ../../index.php");
        }else{
            if($_SESSION['tipo'] == 1){
                header("Location: ../fichar.php");
            }
        }

        if(isset($_GET['mod'])){
            $reg_id = $_GET['mod'];
            $sql=mysqli_query($conexion,"SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario WHERE id_reg = '$reg_id'");

	        if($row=mysqli_fetch_array($sql)){
                $ID_mod = $_GET['mod'];
                $FECHA=$row["fecha"];
                $HORA = $row["hora"];
                $ACCION=$row["accion"];
                $ACEMP=$row["aceptado_trabajador"];
                $ACEM=$row["aceptado_empresa"];
                $ESTADO=$row["estado"];
                $IDUSER=$row["id_usuario"];
                $EMPLEADO = $row["nombre"]." ".$row["apellidos"];
            }
        }else{
            $FECHA='';
            $HORA='';
            $ACCION='';
            $ACEMP='';
            $ACEM='';
            $ESTADO='';
            $EMPLEADO='';
        }  
    ?>
        
        <form action='crea-mod_reg.php?id_mod=<?php echo $ID_mod; ?>' method='post'>
            <!--FECHA -->
            <p><label for='name'>Fecha: </label>
            <input type='date' name='fecha' value=<?php echo $FECHA; ?> ></p>

            <!-- HORA -->
            <p><label for='name'>Hora: </label>
            <input type='time' name='hora' value='<?php echo $HORA; ?>'></p>

            <!-- ACCION -->
            <p><label for='name'>Acción: </label>
            <select name='accion'>
                <option value='inicio' <?php  if($ACCION == "inicio"){echo "selected";} ?> >Inicio</option> 
                <option value='final' <?php  if($ACCION == "final"){echo "selected";} ?>>Final</option>
            </select></p></p>

            <!-- ACEP_EMPRESA -->
            <p><label for='name'>Aceptado Empresa: </label>
            <select name='acep_emp'>
                <option value='0' <?php  if($ACEM == 0){echo "selected";} ?> >Pendiente</option> 
                <option value='1' <?php  if($ACEM == 1){echo "selected";} ?>>Aceptado</option>
                <option value='2' <?php  if($ACEM == 2){echo "selected";} ?>>Rechazado</option>
            </select></p>

            <!-- Estado -->
            <p><label for='name'>Estado:</label>
            <select name='estado'>
                <option value='trabajando' <?php if($ESTADO == "trabajando"){ echo "selected"; } ?>>Trabajando</option> 
                <option value='baja' <?php if($ESTADO == "baja"){ echo "selected"; } ?>>De Baja</option>
                <option value='vacaciones' <?php if($ESTADO == "vacaciones"){ echo "selected"; } ?>>En Vacaciones</option>
            </select></P></p>

            <input type='submit' name= 'guardar' value='Guardar'>

        </form>

    <p><a href="gesreg.php">Volver</a></p>
    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['guardar'])){
    if(isset($_GET['id_mod'])){
        if(!empty($_POST['fecha'])){
            if(!empty($_POST['hora'])){
                $id_reg = $_GET['id_mod'];
                $fecha = $_POST['fecha'];
                $hora = $_POST['hora'];
                $accion = $_POST['accion'];
                $acep_emp = $_POST['acep_emp'];
                $estado = $_POST['estado'];
    
                UpdateRegistro($id_reg, $fecha, $hora, $accion, $acep_emp, $estado);
                header("Location: gesreg.php");
            }
        }
    }
}

?>