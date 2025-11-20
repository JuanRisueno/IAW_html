<?php
    $edad="";
    $errores=[];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $edad=filter_var($_POST['edad'],FILTER_SANITIZE_NUMBER_INT);

        if(empty($edad)){
            $errores['edad'] = "Tienes que introducir una edad";
        }elseif (filter_var($edad, FILTER_VALIDATE_INT) === false){
            $errores['edad'] = "La edad tiene que ser un número entero";
        }

        if(empty($errores)){
            $edad_bien=$edad;
            echo "Se ha enviado bien el formulario.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Edad</title>
</head>
<body>
    <h1>Vamos a validad un campo edad de un formulario</h1>
    <form method="POST" action="">
        Edad
        <input type="text" name="edad" placeholder="Introduce tu edad" value="<?php echo htmlspecialchars($edad) ?? ''?>">
        <?php echo $errores['edad'] ?? ''?>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>