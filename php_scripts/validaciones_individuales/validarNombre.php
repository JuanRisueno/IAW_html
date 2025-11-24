<?php
    $nombre = "";
    $errores= [];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);

        if(empty($nombre)){
            $errores['nombre'] = "El campo nombre debe de rellenarse";
        }

        if(empty($errores)){
            $nombre_bien=$nombre;
            echo "El formulario se ha enviado fatisfactoriamente. Nombre: $nombre_bien";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ValidarNombre</title>
</head>
<body>
    <h1>Vamos a validar el nombre de un formulario</h1>
    <form action="" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre) ?? ''?>">
        <?php echo $errores['nombre'] ?? '' ?>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>