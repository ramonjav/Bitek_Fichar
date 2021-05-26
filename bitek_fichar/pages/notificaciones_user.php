<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/mbcsmbmcp.css" type="text/css" />
        <title>Bitek</title>
    </head>
    <body>
    <div id="mbmcpebul_wrapper" class="container">
        <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu">
            <a class="button_1" href="fichar.php"><li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"></div></li></a>
            <li><div class="buttonbg" style="width: 120px;"><a href="fichar.php">Fichar</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="notificaciones_user.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="calendar_user.php">Consultar calendario</a></div></li>
            <li><div class="buttonbg"><a href="../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>

    
    <form method='POST'>
    

        <?php
            include("../php/conexion.php");
            include_once("../php/funciones.php");
            session_start();

            $user_id = $_SESSION['id'];
            $user_tipo = $_SESSION['tipo'];
            if($user_tipo == 2){
                $sql = "SELECT * FROM `registro` WHERE `aceptado_empresa` = '0'";
            }else{
                $sql = "SELECT * FROM `registro` WHERE `id_usuario` = '$user_id' AND `aceptado_trabajador` = '0'";
            }
            $result = mysqli_query($conexion, $sql);
            $rows = mysqli_num_rows($result);

            if($rows > 0){
                /*<p><input type='checkbox' onClick='toggle(this)'>Seleccionar todo</p>*/
                echo "
                    <table border=1 style='width:100%'>
                    <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acción</th>
                    <th>Aceptado Empleado</th>
                    <th>Aceptado Empresa</th>
                    <th>Estado</th>
                    <th>Select</th>
                    </tr>";

                while($row = mysqli_fetch_array($result)){

                    echo "<tr>";
                    echo "<td>". $row['id_reg'] ."</td>";
                    echo "<td>". $row['fecha'] ."</td>";
                    echo "<td>". $row['hora'] ."</td>";
                    echo "<td>". $row['accion'] ."</td>";
                    echo "<td>". $row['aceptado_trabajador'] ."</td>";
                    echo "<td>". $row['aceptado_empresa'] ."</td>";
                    echo "<td>". $row['estado'] ."</td>";
                    echo "<td><input type='checkbox' name='check[]' value='".$row['id_reg']."'></td>";
                    echo "</tr>";
                }    
                echo "</table>";
                echo "<input type='submit' name='aceptar' value='Aceptar'>
                    <input type='submit' name='rechazar' value='Rechazar'>";
            }else{
                echo "No tienes notificaciones :C";
            }
        ?>
        </form>
            
        <!-- <script> 
            function toggle(source) {
                checkboxes = document.getElementsByName('check[]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>-->
        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
    </body>
</html>
<!-- g -->
<?php
    if(isset($_POST['aceptar'])){
        if (isset($_POST['check'])){
            $selected = $_POST['check'];
            if($user_tipo == 2){
                foreach ($selected as $checks=>$value) {
                    UpdateNotificacion("empresa", $value, "1");
                } 
            }else{
                foreach ($selected as $checks=>$value) {
                    UpdateNotificacion("trabajador", $value, "1");
                } 
            }
             
        }
        header("Location: notificaciones.php");
    }

    if(isset($_POST['rechazar'])){
        if (isset($_POST['check'])){
            $selected = $_POST['check'];
            if($user_tipo == 2){
                foreach ($selected as $checks=>$value) {
                    UpdateNotificacion("empresa", $value, "2");
                } 
            }else{
                foreach ($selected as $checks=>$value) {
                    UpdateNotificacion("trabajador", $value, "2");
                } 
            }
            
        }
        header("Location: notificaciones.php");
    }
?>