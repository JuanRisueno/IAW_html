<?php
    //var_dump($_SERVER);
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "Hola {$_POST['nombre']}";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nombre" id="nombre"/>
        <br/>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>