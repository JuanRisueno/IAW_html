<?php
    $pass="";
    $errores=[];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $pass=trim($_POST['pass']);

        if(empty($pass)){
            $errores['pass'] = "Tienes que introducir una contraseña";
        }elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{8,}$/",$pass)) {
            $errores['pass'] = "La contraseña debe tener al menos 8 caracteres, una letra y un número";
        }

        if(empty($errores)){
            echo "Se ha enviado bien el formulario";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Contraseña</title>
</head>
<body>
    <h1>Vamos a validar una contraseña</h1>
    <form method="POST" action="">
        Contraseña 
        <input type="password" name="pass">
        <?php echo $errores['pass'] ?? ''?>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>