<?php
    require_once '12_iniciar_sesion.php';
    $errores = [];
    $usuario = "";
    $pass = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = trim($_POST['usuario'] ?? '');
        $pass = ($_POST['pass'] ?? '');

        if(empty($usuario)){
            $errores['usuario'] = "Error: Tienes que introducir un usuario";
        }else{
            $usuarioBien = $usuario;
        }

        if(empty($pass)){
            $errores['pass'] = "Error: Tienes que introducir una contraseña";
        }elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$/",$pass)){
            $errores['pass'] = "Error: La contraseña tiene que tener al menos 1 letra, 1 número y mínimo 8 caracteres";
        }else{
            $passBien = $pass;
        }

        if((empty($errores)) && ($usuarioBien == 'Thrall') && ($passBien == 'f0rthehorde')){
            $_SESSION['usuario'] = $usuarioBien;
            header('Location: 12_panel.php');
            exit;
        }else{
            $errorCredenciales = "Credenciales Incorrectas";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística Kor'kron</title>
</head>
<body>
    <h1>Oficina del Intendente</h1>
    <h2>Cálculo de costes</h2>

    <form action="" method="POST">
        Validación de credenciales
        <p><label for="usuario">
            <input type="text" name="usuario" id="usuario" placeholder="Introduce tu Usuario" value="<?= htmlspecialchars($usuario ?? '') ?>">
        </label></p>
        <p><?= $errores['usuario'] ?? '' ?></p>
        <p><label for="pass">
            <input type="password" name="pass" id="pass" placeholder="Introduce tu contraseña">
        </label></p>
        <p><?= $errores['pass'] ?? '' ?></p>
        <p><input type="submit" name="enviar" id="enviar" value="Enviar"></p>
    </form>

    <?php if((isset($errorCredenciales))) echo "Credenciales Incorrectas" ?>
</body>
</html>