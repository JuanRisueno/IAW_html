<?php
    require_once 'conexion.php';
    require_once 'bd.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];

        $con = conectar();

        if($con === null)die('Error de conexión');

        if(findUsuario($con,$user) === false){
            if(insertUsuario($con,$user,$pass,$name)){
                $mensaje = "Usuario registrado";
            }else{
                $mensaje = "Error al registrar el usuario.";
            }
        }else{
            $mensaje = "El usuario ya existe";
        }

        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OretaMessenger</title>
</head>
<body>
    <h1>Página de Registro</h1>
    <form action="" method="POST">
        <input type="text" id="user" name="user" placeholder="Nombre de usuario">
        <br>
        <input type="text" id="pass" name="pass" placeholder="Contraseña">
        <br>
        <input type="text" id="name" name="name" placeholder="Nombre Completo">
        <br>
        <input type="submit" value="Registrar">
    </form>
    <a href="index.php">¿Ya tienes un usuario? Inicia Sesion</a>
    <?= $mensaje ?? '' ?>
</body>
</html>