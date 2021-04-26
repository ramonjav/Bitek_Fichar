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
            if(!$_SESSION['tipo'] == 2){
                header("Location: inicio.php");
            }
        }

        if(isset($_GET['mod'])){
            $reg_id = $_GET['mod'];
            $sql=mysqli_query($conexion,"SELECT * FROM `registro` INNER JOIN `usuarios` ON usuarios.id_user = registro.id_usuario WHERE id_reg = '$reg_id'");

	        if($row=mysqli_fetch_array($sql)){
                
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
        
        <form action='crea-mod_reg.php' method='post'>
            <!--FECHA -->
            <p><label for='name'>Fecha: </label>
            <input type='date' name='fecha' value=<?php echo $FECHA; ?> ></p>

            <!-- HORA -->
            <p><label for='name'>Hora: </label>
            <input type='time' name='hora' value='<?php echo $HORA; ?>'></p>

            <!-- ACCION -->
            <p><label for='name'>Acción: </label>
            <input type='name' name='accion' value='<?php echo $ACCION; ?>'></p>

            <!-- ACEP_EMPRESA -->
            <p><label for='name'>Aceptado Empresa: </label>
            <select name='acep_emp'>
                <option value='0' <?php  if($ACEM == 0){echo "selected";} ?> >Pendiente</option> 
                <option value='1' <?php  if($ACEM == 1){echo "selected";} ?>>Aceptado</option>
                <option value='2' <?php  if($ACEM == 2){echo "selected";} ?>>Rechazado</option>
            </select></p>

            <!-- Estado -->
            <p><label for='name'>Estado:</label>
            <select>
            <option value='0' selected>
                <option value='0' <?php if($ESTADO == "trabajando"){ echo "selected"; } ?>>Trabajando</option> 
                <option value='1' <?php if($ESTADO == "baja"){ echo "selected"; } ?>>De Baja</option>
                <option value='2' <?php if($ESTADO == "vacaciones"){ echo "selected"; } ?>>En Vacaciones</option>
            </select></P></p>

            <!-- Empleado 
            <p><label for='name'>Empleado:</label>
            <select name="empleados" id="">
            <option value='0' disabled hidden>Seleccione:</option>
              
            </select></p>-->

            <input type='submit' name= 'guardar' value='Guardar'>
            <input type='submit' name= 'eliminar' value='Eliminar'>

        </form>

    <p><a href="gesreg.php">Volver</a></p>
    <script src="../../js/jquery-3.6.0.slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['guardar'])){

    

}

?>