<?php
    require_once 'funciones.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        //var_dump($_POST); //Cuando mandamos algo, nos informa que se está mandando
        $tabla = $_POST['tabla'];
        $salida = tabla($tabla);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.4</title>
</head>
<body>
    <form action="" method="post">
        <label for="tabla">
            Tabla:
            <input type="text" name="tabla" id="tabla">
        </label>
        <br>
        <input type="submit" value="Mostrar">
    </form>
    <?php
        if(isset($salida)) echo $salida;
    ?>
</body>
</html>