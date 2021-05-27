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
            <li><div class="icon_1 with_img_200 buttonbg" style="width: 230px;"><a class="button_1" href="gestor.php"></a></div></li>
            <li><div class="buttonbg" style="width: 120px;"><a href="admin_pages/gesusr.php">Gestión Usuario</a></div></li>
            <li><div class="buttonbg" style="width: 175px;"><a href="notificaciones.php">Gestión de Notificaciones</a></div></li>
            <li><div class="buttonbg" style="width: 87px;"><a href="calendar.php">Calendario</a></div></li>
            <li><div class="buttonbg" style="width: 147px;"><a href="admin_pages/gesreg.php">Gestión de Registros</a></div></li>
            <li><div class="buttonbg"><a href="../php/session_destroy.php">Cerrar Sesión</a></div></li>
        </ul>
    </div>

        <?php
        include("../php/conexion.php");
        include_once("../php/funciones.php");
        session_start();
        if(!isset($_SESSION['tipo'])){
            header("Location: ../../index.php");
        }else{
            if($_SESSION['tipo'] == 1){
                header("Location: ../fichar.php");
            }
        }
        $user_id = $_SESSION['id'];
        $user_tipo = $_SESSION['tipo'];

        echo "
        <form accion='notificaciones.php' method='POST'>";
        /*<input type='checkbox' onClick='toggle(this)'>
        Seleccionar todo*/
        echo "<input type='submit' name='aceptar' value='Aceptar'>
        <input type='submit' name='rechazar' value='Rechazar'>";
            
            $sql = "SELECT * FROM `registro` WHERE `aceptado_empresa` = '0'";
           
            $result = mysqli_query($conexion, $sql);
            $rows = mysqli_num_rows($result);

           // if($rows > 0){
                echo "
                <p></p>
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
                    $num = 0;
                    while($row = mysqli_fetch_array($result)){
                        $num++;
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
               
            /*}else{
                echo "No tienes notificaciones :C";
            }*/

            $conexion->close();

            echo " </form>";

            if(isset($_POST['aceptar'])){
                if (isset($_POST['check'])){
                    $selected = $_POST['check'];
                    if($user_tipo == 2){
                        foreach ($selected as $checks=>$value) {
                            UpdateNotificacion("empresa", $value, "1");
                        } 
                        
                        header("Location: notificaciones.php");
                    }
                }
            }
        
            if(isset($_POST['rechazar'])){
                if (isset($_POST['check'])){
                    $selected = $_POST['check'];
                    if($user_tipo == 2){
                        foreach ($selected as $checks=>$value) {
                            UpdateNotificacion("empresa", $value, "2");
                        } 
                        header("Location: notificaciones.php");
                    }
                }
            }
        ?>
       
        <script src="../js/jquery-3.6.0.slim.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/mbjsmbmcp.js"></script>
       <!-- <script> 
            function toggle(source) {
                checkboxes = document.getElementsByName('check[]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>-->

        
    </body>
</html>
<!-- g -->
