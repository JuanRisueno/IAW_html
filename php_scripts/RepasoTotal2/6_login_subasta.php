<?php
    session_name('subasta');
    session_start();
    $errores=[];
    $nombre='';
    $pass='';
    $incorrecto='';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre=trim($_POST['nombre'] ?? '');
        $pass= ($_POST['pass'] ?? '');

        if(empty($nombre)){
            $errores['nombre'] = "Error: Tienes que introducir un nombre";
        }else{
            $nombreBien = $nombre;
        }

        if(empty($pass)){
            $errores['pass'] = "Error: Tienes que introducir una contraseña";
        }else{
            $passBien = $pass;
        }

        if(empty($errores)){
            if(($nombreBien == "Goblin") && ($passBien == "oro")){
                $_SESSION['subasta'] = true;
                $_SESSION['nombre'] = $nombreBien;
                header('Location: 7_casa_subasta.php');
                exit;
            }else{
                $incorrecto = "No eres bien recibido aquí";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Subasta</title>
</head>
<body>
    <h1>Bienvenido a la subasta</h1>
    <h2>Logueate para entrar</h2>
    <form action="" method="POST">
        <label for="nombre">
            <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre" value="<?= htmlspecialchars($nombre ?? '') ?>">
            <p><?= $errores['nombre'] ?? '' ?></p>
        </label>
        <label for="pass">
            <p><input type="password" id="pass" name="pass" placeholder="Introduce tu contraseña"></p>
            <p><?= $errores['pass'] ?? '' ?></p>
        </label>

        <p><input type="submit" name="entrar" id="entrar" value="Entrar"></p>
    </form>

    <p><?= $incorrecto ?></p>
</body>
</html>