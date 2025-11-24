<?php
    $precio="";
    $errores=[];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $precio=trim($_POST['precio']);

        if(empty($precio)){
            $errores['precio'] = "Tienes que rellear el campo precio";
        }elseif (!preg_match("/^\d+(\.\d{1,2})?$/",$precio)){
            $errores['precio'] = "El precio debe ser un número con máximo 2 decimales (usa el punto)";
        }

        if(empty($errores)){
            $precio_bien=$precio;
            echo "Se ha enviado bien el formulario. Precio: $precio_bien";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Precio</title>
</head>
<body>
    <h1>Vamos a validar un precio con 2 decimales</h1>
    <form method="POST" action="">
        Precio: 
        <input type="text" name="precio" value="<?php echo htmlspecialchars($precio) ?? '' ?>">
        <?php echo $errores['precio'] ?? '' ?>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>