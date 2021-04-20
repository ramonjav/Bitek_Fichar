<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <title>Bitek</title>
</head>
<body>

<form action="php/login.php" method="post">

    <p>Correo: <input type="text" name="correo" /></p>
    <p>Contraseña: <input type="password" name="contrasena" /></p>
    <p><input type="submit" value="Acceder"/></p>

</form>
<!-- Prueba @ramonjav-->
<?php
if(isset($_GET['err'])){
    echo "<span style='background-color:#ffffff; padding:10px; margin-top:30px; border-radius:10px; color:black; border:solid 3px #960a0a;'><strong> Datos incorrectos</strong></span>";
}
?>
    <script src="js/jquery-3.6.0.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>