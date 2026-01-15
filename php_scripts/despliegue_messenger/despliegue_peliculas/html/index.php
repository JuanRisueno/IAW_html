<?php

    require_once 'conexion.php';
    require_once 'funciones.php';

    //Variables
    $username='';
    $pass='';
    $con='';
    $mensaje='';
    $rol='';

    session_start();
    
    //echo password_hash('oretania', PASSWORD_DEFAULT);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username=$_POST['username'];
        $pass=$_POST['pass'];

        //Aquí se validarían las variables

        //Conexion
        $con = conectar();

        if ($con === null)die('Error de conexión');

        //Comprobar Usuario

        $encontrarUsuario = encontrarUsuario($con,$username);
        //var_dump(password_verify($pass,$encontrarUsuario['password'])) ;
        if ($encontrarUsuario && password_verify($pass,$encontrarUsuario['password'])){ //ese password es el de la BBDD
            $_SESSION['usuario'] = $encontrarUsuario;
            unset($_SESSION['usuario']['password']); // Para no pasar la contraseña a la sesión    
            $rol = ($_SESSION['usuario']['rol']);

            if($rol === 'admin'){
                header('Location: series.php');
                exit;
            }else if($rol === 'user'){
                header('Location: favoritos.php');
                exit;
            }
        }else{
            $mensaje = 'Usuario o contraseña equivocados.';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>OretaFilms</title>
</head>
<body>
    <h1>OretaFilms</h1>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Nombre de Usuario">
        <br>
        <input type="text" name="pass" id="pass" placeholder="Contraseña">
        <br>
        <input type="submit" value="Entrar">
        <a href="nuevoUsuario.php">Registrar</a>
    </form>
    <?= $mensaje ?? '' ?>
</body>
</html>