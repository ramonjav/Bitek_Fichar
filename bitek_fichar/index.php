<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/index.css" />
        <title>Bitek</title>
    </head>
    
    <body>
        <div class="inicio-caja">
            <img id="avatar" src="img/logo1.png">
            <h1>INICIO DE SESIÓN</h1>
            <form action="php/login.php" method="post">
                <label for="correo">Correo electrónico</label>
                <input type="text" name="correo" placeholder="Introduce tu correo electrónico"/>
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" placeholder="Introduce tu contraseña"/>
                <input type="submit" value="Acceder"/></p>
            </form>
        </div>
        <?php
            if(isset($_GET['err'])){
                echo "<span style='background-color:#ffffff; padding:10px; margin-top:30px; border-radius:10px; color:black; border:solid 3px #960a0a;'><strong> Datos incorrectos</strong></span>";
            }
        ?>
        <script src="js/jquery-3.6.0.slim.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>