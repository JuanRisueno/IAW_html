<?php
    $email="";
    $errores= [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

        if(empty($email)){
            $errores['email'] = "Tienes que introducir un email";
        }elseif ($email = filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            $errores['email'] = "Tienesque introducir un email válido";
        }

        if(empty($errores)){
            echo "Formulario enviado correctamente";
            $email_valido=$email;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de un email</title>
</head>
<body>
    <h1>Vamos a Validar un email</h1>
    <form action="" method="POST">
        email
        <input type="email" name="email" placeholder="Introduce tu email" value="<?php echo htmlspecialchars($email) ?? ''?>">
        <?php echo $errores['email'] ?? ''  ?>
        <input type="submit" value="enviar">
    </form>
</body>
</html>