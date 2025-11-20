<?php
    $telefono="";
    $errores=[];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $telefono=trim($_POST['telefono']);

        if(empty($telefono)){
            $errores['telefono'] = "Tienes que rellenar el campo telefono";
        }elseif (!preg_match("/^6\d{8}$/",$telefono)){
            $errores['telefono'] = "Tiene que introducir un número de teléfono de 9 dígitos y que empiece por 6";
        }

        if(empty($errores)){
            echo "Formulario enviado";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de un teléfono</title>
</head>
<body>
    <h1>Vamos a validar un teléfono</h1>
    <form method="POST" action="">
        Teléfono 
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono) ?? '' ?>">
        <?php echo $errores['telefono'] ?? '' ?>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>